<?php
  require_once __DIR__ . '/../src/vendor/autoload.php';
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;
  use \DavidePastore\Slim\Validation\Validation as Validation;
  use \Respect\Validation\Validator as Validator;
  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  /* Appel des contrôleurs */

  use \geoquizz\control\PartieController as Partie;

  /* Appel des modèles */

  use \geoquizz\model\Partie as partieModel;

  /* Appel des utilitaires */

  use \geoquizz\utils\Writer as writer;


  $config=parse_ini_file("../src/config/geoquizz.db.conf.ini");
  $db = new Illuminate\Database\Capsule\Manager();
  $db->addConnection($config);
  $db->setAsGlobal();
  $db->bootEloquent();

  //Création et configuration du container
  $configuration=[
    'settings'=>[
      'displayErrorDetails'=>true,
      'production' => false
    ]
  ];

  $errors = require_once __DIR__ . '/../src/config/api_errors.php';

  $c=new \Slim\Container(array_merge( $configuration, $errors) );
  $app=new \Slim\App($c);
  $c = $app->getContainer();

  //Initialisation du conteneur pour le writer
  new writer($c);

  //Application

  function checkToken(Request $rq, Response $rs, callable $next){
    // récupérer l'identifiant de commde dans la route et le token
    $id = $rq->getAttribute('route')->getArgument( 'id');
    $token = $rq->getQueryParam('token', null);
    // vérifier que le token correspond à la commande
    try
    {
        partieModel::where('id', '=', $id)->where('token', '=',$token)->firstOrFail();
    } catch (ModelNotFoundException $e) {
        $rs= $rs->withStatus(404);
        $temp = array("type" => "error", "error" => '404', "message" => "Le token n'est pas valide");
        $rs->getBody()->write(json_encode($temp));
        return $rs;
    };
    return $next($rq, $rs);
  };

  function afficheError(Response $resp, $location, $errors){
    $resp=$resp->withHeader('Content-Type','application/json')
    ->withStatus(400)
    ->withHeader('Location', $location);
    $resp->getBody()->write(json_encode($errors));
    return $resp;
  }

  //Parties

  //On recherche une partie en particulier
  $app->get('/parties/{id}[/]',
    function(Request $req, Response $resp, $args){
      $ctrl=new Partie($this);
      return $ctrl->getPartie($resp,$args);
    }
  )->setName("partieListe")->add('checkToken');;

  //on souhaite l'historique des 10 meilleurs parties
  $app->get('/parties[/]',
    function(Request $req, Response $resp, $args){
      $ctrl=new Partie($this);
      return $ctrl->getParties($resp,$args);
    }
  )->setName("partiesListe");

  //On va créer une partie
  $validators= [
      'nb_photos' => Validator::numeric()->positive(),
      'joueur' => Validator::StringType()->alnum(),
      'id_serie' => Validator::numeric()
  ];

  $app->post('/parties[/]',
      function(Request $req, Response $resp, $args){
        if($req->getAttribute('has_errors')){
          $errors = $req->getAttribute('errors');
          return afficheError($resp, '/parties/nouvelle', $errors);
        }else{
          $ctrl=new Partie($this);
          return $ctrl->createPartie($req,$resp,$args);
        }
      }
  )->setName('createPartie')->add(new Validation($validators));

  //on va modifier le score d'une partie
  $validators= [
      'score' => Validator::numeric()->positive()
  ];
  
  $app->put('/parties/{id}[/]',
      function(Request $req, Response $resp, $args){
        if($req->getAttribute('has_errors')){
          $errors = $req->getAttribute('errors');
          return afficheError($resp, '/parties/update', $errors);
        }else{
          $ctrl=new Partie($this);
          return $ctrl->updateScorePartie($req,$resp,$args);
        }
      }
      )->setName('updateScorePartie')->add(new Validation($validators))->add('checkToken');
  
  $app->run();
?>
