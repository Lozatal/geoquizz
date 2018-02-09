<?php
  //Démarrage de la session utilisateur
  session_start();

  //Configuration pour Daniel
  if($_SERVER['HTTP_HOST']=='localhost'){
    $_SERVER['HTTP_HOST']='localhost/html/geoquizz/backend/backoffice';
  }

  require_once __DIR__ . '/../src/vendor/autoload.php';

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;
  use \DavidePastore\Slim\Validation\Validation as Validation;
  use \Respect\Validation\Validator as Validator;
  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  /* Appel des contrôleurs */

  use \geoquizz\control\PhotoController as Photos;
  use \geoquizz\control\CompteController as Comptes;
  use \geoquizz\control\SerieController as Series;
  use \geoquizz\control\IndexController as Index;

  /* Appel des utilitaires */

  use \geoquizz\utils\Writer as writer;

  /* Configuration de la BDD */

  $config=parse_ini_file("../src/config/geoquizz.db.conf.ini");
  $db = new Illuminate\Database\Capsule\Manager();
  $db->addConnection($config);
  $db->setAsGlobal();
  $db->bootEloquent();

  /* Appel et configuration de twig */
  $loader = new Twig_Loader_Filesystem('../src/view/template');
  $twig = new Twig_Environment($loader, array(
      'cache' => false
  ));

  //Création et configuration du container
  $configuration=[
    'settings'=>[
      'displayErrorDetails'=>true,
      'production' => false,
      'tmpl_dir' => __DIR__ . '/../src/view/template'
    ],
    'view'=>function($c){
      return new \Slim\Views\Twig(
        $c['settings']['tmpl_dir'],
        ['debug'=>true]
      );
    }
  ];

  $errors = require_once __DIR__ . '/../src/config/api_errors.php';

  $c=new \Slim\Container(array_merge( $configuration, $errors) );
  $app=new \Slim\App($c);
  $c = $app->getContainer();

  //Initialisation du conteneur pour le writer
  new writer($c);

  //Middleware

  function afficheError(Response $resp, $location, $errors){
  	$resp=$resp->withHeader('Content-Type','application/json')
  	->withStatus(400)
  	->withHeader('Location', $location);
  	$resp->getBody()->write(json_encode($errors));
  	return $resp;
  }

  function checkLogin(Request $req, Response $resp, callable $next){
    if(isset($_SESSION['user_login'])){
      return $next($req, $resp);
    }else{
      //$redirect=$this->get('router')->pathFor('loginPost');
      $redirect='/';
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
      return $next($req, $resp);
    }
  }
  //======================================================
  //======================================================
  //======================================================
  //                    Application
  //======================================================
  //======================================================
  //======================================================


  //======================================================
  //======================================================
  //                Routes pour comptes
  //======================================================
  //======================================================

  //======================================================
  //                Création de compte
  //======================================================

  // Page de création de compte
  $app->get('/creerCompte',
    function(Request $req, Response $resp, $args){
      $ctrl=new Comptes($this);
      return $ctrl->getComptesCreation($req,$resp,$args);
    }
  )->setName("comptesCreationGet");

  $validators = [
      'nom' => Validator::stringType()->alnum(),
      'email' => Validator::email(),
      'password' => Validator::stringType()->alnum(),
      'password_rep' => Validator::stringType()->alnum()
  ];

  $app->post('/creerCompte',
    function(Request $req, Response $resp, $args){
      if($req->getAttribute('has_errors')){
        $errors = $req->getAttribute('errors');
        return afficheError($resp, '/parties/nouvelle', $errors);
      }else{
        $ctrl=new Comptes($this);
        return $ctrl->postCompte($req,$resp,$args);
      }
    }
  )->setName("comptesPost")->add(new Validation($validators));

  //======================================================
  //                Connexion au compte
  //======================================================

  // Page de connexion au compte
  $app->get('/',
    function(Request $req, Response $resp, $args){
      $ctrl=new Comptes($this);
      return $ctrl->getComptesConnexion($req,$resp,$args);
    }
  )->setName("comptesConnexionGet");

  $validators = [
      'email' => Validator::StringType(),
      'password' => Validator::StringType()
  ];

  $app->post('/',
    function(Request $req, Response $resp, $args){
      if($req->getAttribute('has_errors')){
        $errors = $req->getAttribute('errors');
        return afficheError($resp, '/parties/nouvelle', $errors);
      }else{
        $ctrl=new Comptes($this);
        return $ctrl->loginCompte($req,$resp,$args);
      }
    }
  )->setName("loginPost")->add(new Validation($validators));

  //======================================================
  //       Visualisation/modification et déconnexion
  //======================================================

  // Page de visualisation du compte
  $app->get('/compte',
    function(Request $req, Response $resp, $args){
      $ctrl=new Comptes($this);
      return $ctrl->getComptes($req,$resp,$args);
    }
  )->setName("compteGet")->add('checkLogin');

  // Page de de déconnexion
  $app->post('/compte',
    function(Request $req, Response $resp, $args){
      if($req->getAttribute('has_errors')){
        $errors = $req->getAttribute('errors');
        return afficheError($resp, '/parties/nouvelle', $errors);
      }else{
        $ctrl=new Comptes($this);
        return $ctrl->putCompte($req,$resp,$args);
      }
    }
  )->setName("modifierCompte")->add('checkLogin');

  // Page de de déconnexion
  $app->get('/logout',
    function(Request $req, Response $resp, $args){
      if($req->getAttribute('has_errors')){
        $errors = $req->getAttribute('errors');
        return afficheError($resp, '/parties/nouvelle', $errors);
      }else{
        $ctrl=new Comptes($this);
        return $ctrl->logoutCompte($req,$resp,$args);
      }
    }
  )->setName("logout")->add('checkLogin');


  //======================================================
  //======================================================
  //                Routes pour Photos
  //======================================================
  //======================================================


  //======================================================
  //                Création de photos
  //======================================================

  // Page de création de photo
  $app->get('/creerPhoto/{idSerie}',
    function(Request $req, Response $resp, $args){
      $ctrl=new Photos($this);
      return $ctrl->getPhotoCreation($req,$resp,$args);
    }
  )->setName("photoCreationGet")->add('checkLogin');

  $validators = [
      'description' => Validator::StringType(),
      'url' => Validator::StringType(),
      'position_long' => Validator::numeric(),
      'position_lat' =>Validator::numeric()
  ];

  $app->post('/photos/{id}/{idSerie}',
    function(Request $req, Response $resp, $args){
      if($req->getAttribute('has_errors')){
        $errors = $req->getAttribute('errors');
        return afficheError($resp, '/parties/nouvelle', $errors);
      }else{
        $ctrl=new Photos($this);
        return $ctrl->putPhotosID($req,$resp,$args);
      }
    }
  )->setName("photosPut")->add(new Validation($validators))->add('checkLogin');

  //======================================================
  //                Modification de photo
  //======================================================

  // Page de modification d'une photo
  $app->get('/modifierPhoto/{id}/{idSerie}',
    function(Request $req, Response $resp, $args){
      $ctrl=new Photos($this);
      return $ctrl->getPhotoModification($req,$resp,$args);
    }
  )->setName("photoModificationGet")->add('checkLogin');

  $validators = [
      'description' => Validator::StringType(),
      'url' => Validator::StringType(),
      'position_long' => Validator::numeric(),
      'position_lat' =>Validator::numeric()
  ];

  $app->post('/photos/{idSerie}',
    function(Request $req, Response $resp, $args){
      if($req->getAttribute('has_errors')){
        $errors = $req->getAttribute('errors');
        return afficheError($resp, '/parties/nouvelle', $errors);
      }else{
        $ctrl=new Photos($this);
        return $ctrl->postPhotos($req,$resp,$args);
      }
    }
  )->setName("photosPost")->add(new Validation($validators))->add('checkLogin');

  //======================================================
  //                Suppression de photo
  //======================================================

  // Page de suppression de photo
  $app->get('/supprimerPhoto/{id}/{idSerie}',
    function(Request $req, Response $resp, $args){
      $ctrl=new Photos($this);
      return $ctrl->getPhotoSuppresion($req,$resp,$args);
    }
  )->setName("photoSuppressionGet")->add('checkLogin');


//======================================================
//======================================================
//                Routes pour les Series
//======================================================
//======================================================


//======================================================
//                Affichage des séries
//======================================================

// Page d'index
$app->get('/backoffice',
  function(Request $req, Response $resp, $args){
    $ctrl=new Index($this);
    return $ctrl->getIndex($req,$resp,$args);
  }
)->setName("index")->add('checkLogin');

// Page de d'affichage d'une série
$app->get('/afficherSerie/{idSerie}',
  function(Request $req, Response $resp, $args){
    $ctrl=new Series($this);
    return $ctrl->getSerieAfficherPhotos($req,$resp,$args);
  }
)->setName("serieAfficherGet")->add('checkLogin');

//======================================================
//            Création d'une série
//======================================================

// Page de création de série
$app->get('/creerSerie',
  function(Request $req, Response $resp, $args){
    $ctrl=new Series($this);
    return $ctrl->getSerieCreation($req,$resp,$args);
  }
)->setName("serieCreationGet")->add('checkLogin');

$validators = [
    'ville' => Validator::StringType(),
    'map_refs' => Validator::StringType(),
    'dist' => Validator::numeric()
];
// création de la série Twig
$app->post('/creerSerie',
  function(Request $req, Response $resp, $args){
    $ctrl=new Series($this);
    return $ctrl->getSeriesPost($req,$resp,$args);
  }
)->setName("getSeriesPost")->add('checkLogin');

//======================================================
//            Modification d'une série
//======================================================

// Page de modification d'une série
$app->get('/modifierSerie/{id}',
  function(Request $req, Response $resp, $args){
    $ctrl=new Series($this);
    return $ctrl->getSerieModification($req,$resp,$args);
  }
)->setName("serieModificationGet")->add('checkLogin');

$validators = [
    'ville' => Validator::StringType(),
    'map_refs' => Validator::StringType(),
    'dist' => Validator::numeric()
];
// Modification de la série Twig
$app->post('/modifierSerie/{id}',
  function(Request $req, Response $resp, $args){
    $ctrl=new Series($this);
    return $ctrl->getSeriesPut($req,$resp,$args);
  }
)->setName("getSeriesPut")->add('checkLogin');

//======================================================
//            Suppression d'une série
//======================================================

// Page de suppression d'une série
$app->get('/supprimerSerie/{id}',
  function(Request $req, Response $resp, $args){
    $ctrl=new Series($this);
    return $ctrl->getSerieSuppression($req,$resp,$args);
  }
)->setName("serieSuppressionGet")->add('checkLogin');

  $app->run();
?>
