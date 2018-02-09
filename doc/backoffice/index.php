<?php

/**
 * File:  index.php
 * Creation Date: 08/02/2018
 * description:Geoquizz Documentation de l'API Backoffice
 *
 * @author: Daniel Bentz
 */

/**
 * @api {get} /creerCompte Affiche la page de création de compte
 * @apiGroup Comptes
 * @apiName getComptesCreation
 * @apiVersion 0.1.0
 *
 * @apiDescription Accès à toutes les ressources de type compte :
 * permet d'accéder à la représentation des ressources compte permettant la création d'un compte.
 * Retourne une liste de lien pour twig.
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 */

 // Page de création de compte
  $app->get('/creerCompte',
    function(Request $req, Response $resp, $args){
      $ctrl=new Comptes($this);
      return $ctrl->getComptesCreation($req,$resp,$args);
    }
  )->setName("comptesCreationGet");

/**
 * @api {post} /creerCompte Créer un compte
 * @apiGroup Comptes
 * @apiName postCompte
 * @apiVersion 0.1.0
 *
 * @apiDescription Création d'une ressource de type Compte:
 * permet d'ajouter une ressource compte.
 * Redirige vers la page de connexion.
 *
 * @apiParam {Varchar} nom Pseudo de l'utilisateur
 * @apiParam {Varchar} email Email de l'utilisateur
 * @apiParam {Varchar} password Mot de passe
 * @apiParam {Varchar} password_rep Confirmation du mot de passe
 * 
 * @apiSuccess (Réponse : 201) Created
 *
 * @apiError (Réponse : 400) Bad request paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *			nom : must contain only letters (a-z) and digits (0-9)
 *			email : must be valid email
 *			password : must contain only letters (a-z) and digits (0-9)
 *			password_rep :must contain only letters (a-z) and digits (0-9)
 *     }
 */

  $validators = [
      'nom' => Validator::StringType(),
      'email' => Validator::StringType(),
      'password' => Validator::StringType()->alnum(),
      'password_rep' => Validator::StringType()->alnum(),
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

 /**
 * @api {get} / Affiche la page de connexion au compte
 * @apiGroup Comptes
 * @apiName getComptesConnexion
 * @apiVersion 0.1.0
 *
 * @apiDescription Accès à toutes les ressources de type compte :
 * permet d'accéder à la représentation des ressources compte permettant la connexion,
 * Retourne une liste de lien pour twig.
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 */

  // Page de connexion au compte
  $app->get('/',
    function(Request $req, Response $resp, $args){
      $ctrl=new Comptes($this);
      return $ctrl->getComptesConnexion($req,$resp,$args);
    }
  )->setName("comptesConnexionGet");

/**
 * @api {post} / Vérification et connexion à un compte
 * @apiGroup Comptes
 * @apiName loginCompte
 * @apiVersion 0.1.0
 *
 * @apiDescription Création d'une ressource de type Compte:
 * permet de récupérer après vérification de son éxistence une ressource compte.
 * Redirige vers la page des séries du backoffice.
 *
 * @apiParam {Varchar} email Email de l'utilisateur
 * @apiParam {Varchar} password Mot de passe
 * 
 * @apiSuccess (Réponse : 200) OK Ressources trouvées
 *
 * @apiError (Réponse : 400) Bad request paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *			email : must be valid email
 *			password : must contain only letters (a-z) and digits (0-9)
 *     }
 */
  $validators = [
      'email' => Validator::email(),
      'password' => Validator::StringType()->alnum()
  ];

  $app->post('/',
    function(Request $req, Response $resp, $args){
      if($req->getAttribute('has_errors')){
        $errors = $req->getAttribute('errors');
        return afficheError($resp, '/comptes/login', $errors);
      }else{
        $ctrl=new Comptes($this);
        return $ctrl->loginCompte($req,$resp,$args);
      }
    }
  )->setName("loginPost")->add(new Validation($validators));

  //======================================================
  //                Visualisation et déconnexion
  //======================================================

  // Page de visualisation du compte
  $app->get('/compte',
    function(Request $req, Response $resp, $args){
      $ctrl=new Comptes($this);
      return $ctrl->getComptes($req,$resp,$args);
    }
  )->setName("compteGet")->add('checkLogin');

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


?>
