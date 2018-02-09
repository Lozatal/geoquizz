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
  * @apiError (Réponse : 200) Redirection vers getComptesCreation
  *
  * @apiErrorExample {text} exemple de réponse en cas d'erreur
  *			nom : must contain only letters (a-z) and digits (0-9)
  *			email : must be valid email
  *			password : must contain only letters (a-z) and digits (0-9)
  *			password_rep :must contain only letters (a-z) and digits (0-9)
  */

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
  * @apiError (Réponse : 200) Redirection vers getComptesConnexion
  *
  * @apiErrorExample {text} exemple de réponse en cas d'erreur
  *			email : must be valid email
  *			password : must contain only letters (a-z) and digits (0-9)
  */

  /**
  * @api {get} /compte Affiche la page de modification du compte
  * @apiGroup Comptes
  * @apiName getComptes
  * @apiVersion 0.1.0
  *
  * @apiDescription Accès à toutes les ressources de type compte de l'utilisateur connecté :
  * permet d'accéder à la représentation des ressources compte que l'utilisateur va pouvoir consulter et modifier,
  * Retourne une liste de lien pour twig.
  *
  * @apisuccess (Succès : 200) OK Ressources trouvées
  */

  /**
  * @api {post} /compte Vérification et modification d'un compte
  * @apiGroup Comptes
  * @apiName putCompte
  * @apiVersion 0.1.0
  *
  * @apiDescription Modification d'une ressource de type Compte:
  * permet de récupérer après vérification des mots de passes les nouvelles informations d'un compte éxistant,
  * Rafraichit la page.
  *
  * @apiParam {Varchar} email Email de l'utilisateur
  * @apiParam {Varchar} password Mot de passe
  *
  * @apiSuccess (Réponse : 200) OK Ressources trouvées
  *
  * @apiError (Réponse : 200) Redirection vers getComptes
  *
  * @apiErrorExample {text} exemple de réponse en cas d'erreur
  *			nom : must contain only letters (a-z) and digits (0-9)
  *			email : must be valid email
  *			password : must contain only letters (a-z) and digits (0-9)
  *			password_rep :must contain only letters (a-z) and digits (0-9)
  */

  /**
  * @api {get} /logout Déconnexion
  * @apiGroup Comptes
  * @apiName logoutCompte
  * @apiVersion 0.1.0
  *
  * @apiDescription Suppression de la session utilisateur:
  *
  * @apiSuccess (Réponse : 200) Redirection vers loginCompte
  *
  */

  /**
  * @api {get} /creerPhoto/{idSerie} Affiche la page de création de photo
  * @apiGroup Photos
  * @apiName getPhotoCreation
  * @apiVersion 0.1.0
  *
  * @apiDescription Accès à toutes les ressources de type photo :
  * permet d'accéder à la représentation des ressources photo permettant la création d'une photo.
  * Retourne une liste de lien pour twig.
  *
  * @apisuccess (Succès : 200) OK Ressources trouvées
  */

  /**
  * @api {post} /photos/{idSerie} Vérification et création d'une photo
  * @apiGroup Photos
  * @apiName postPhotos
  * @apiVersion 0.1.0
  *
  * @apiDescription Création d'une ressource de type photo:
  * permet d'ajouter une ressource Serie.
  *
  * @apiParam {Varchar} text Description
  * @apiParam {Varchar} text Url
  * @apiParam {Decimal} text Longitude
  * @apiParam {Decimal} text Latitude
  *
  * @apiSuccess (Réponse : 200) Redirection vers getSerieAfficherPhotos
  *
  * @apiError (Réponse : 200) Redirection vers getPhotoCreation
  *
  * @apiErrorExample {text} exemple de réponse en cas d'erreur
  *			Longitude : must contain only letters digits (0-9)
  *			Latitude :must contain only digits (0-9)
  */

  /**
  * @api {get} /modifierPhoto/{id}/{idSerie} Affiche la page de modification d'une photo
  * @apiGroup Photos
  * @apiName getPhotoModification
  * @apiVersion 0.1.0
  *
  * @apiDescription Accès à toutes les ressources de type Photo:
  * permet d'accéder à la représentation des ressources photo permettant la modification d'une photo.
  * Retourne une liste de lien pour twig.
  *
  * @apiSuccess (Réponse : 200) OK Ressources trouvées
  *
  */

  /**
  * @api {post} /photos/{id}/{idSerie} Vérification et modification d'une photo
  * @apiGroup Photos
  * @apiName putPhotosID
  * @apiVersion 0.1.0
  *
  * @apiDescription Modification d'une ressource de type photo:
  * permet de modifier les informations sur une photo d'une série,
  *
  * @apiParam {Varchar} text Description
  * @apiParam {Varchar} text Url
  * @apiParam {Decimal} text Longitude
  * @apiParam {Decimal} text Latitude
  *
  * @apiSuccess (Réponse : 200) Redirection vers getSerieAfficherPhotos
  *
  * @apiError (Réponse : 200) Redirection vers getPhotoModification
  *
  * @apiErrorExample {text} exemple de réponse en cas d'erreur
  *			Longitude : must contain only letters digits (0-9)
  *			Latitude :must contain only digits (0-9)
  */

  /**
  * @api {get} /supprimerPhoto/{id}/{idSerie} Affiche la page de modification d'une photo
  * @apiGroup Photos
  * @apiName getPhotoSuppresion
  * @apiVersion 0.1.0
  *
  * @apiDescription Suppression d'une ressource de type Photo:
  *
  * @apiSuccess (Réponse : 200) Redirection vers getSerieAfficherPhotos
  *
  */

  /**
  * @api {get} /backoffice Affiche la page de liste des séries
  * @apiGroup Series
  * @apiName getIndex
  * @apiVersion 0.1.0
  *
  * @apiDescription Liste des ressource de type Series:
  * permet d'accéder à la représentation des ressources series que l'utilisateur va pouvoir consulter et modifier,
  * Retourne une liste de lien pour twig.
  *
  * @apiSuccess (Réponse : 200) OK Ressources trouvées
  *
  */

  /**
  * @api {get} /afficherSerie/{idSerie} Affiche la page de liste des photos d'une série
  * @apiGroup Series
  * @apiName getSerieAfficherPhotos
  * @apiVersion 0.1.0
  *
  * @apiDescription Liste des ressource de type Photos d'une Serie:
  * permet d'accéder à la représentation des ressources photos que l'utilisateur va pouvoir consulter et modifier,
  * Retourne une liste de lien pour twig.
  *
  * @apiSuccess (Réponse : 200) OK Ressources trouvées
  *
  */

  /**
  * @api {get} /creerSerie Affiche la page de création d'une série
  * @apiGroup Series
  * @apiName getSerieCreation
  * @apiVersion 0.1.0
  *
  * @apiDescription Accès à toutes les ressources de type Serie :
  * permet d'accéder à la représentation des ressources photo permettant la création d'une photo.
  * Retourne une liste de lien pour twig.
  *
  * @apisuccess (Succès : 200) OK Ressources trouvées
  */

  /**
  * @api {post} /creerSerie Vérification et modification d'une photo
  * @apiGroup Series
  * @apiName getSeriesPost
  * @apiVersion 0.1.0
  *
  * @apiDescription Crée une ressource de type Serie:
  * permet d'ajouter une ressource Serie.
  *
  * @apiParam {Varchar} text Description
  * @apiParam {Varchar} text Url
  * @apiParam {Decimal} text Longitude
  * @apiParam {Decimal} text Latitude
  *
  * @apiSuccess (Réponse : 200) Redirection vers getSerieAfficherPhotos
  *
  * @apiError (Réponse : 200) Redirection vers getPhotoModification
  *
  * @apiErrorExample {text} exemple de réponse en cas d'erreur
  *			Longitude : must contain only letters digits (0-9)
  *			Latitude :must contain only digits (0-9)
  */

  $validators = [
  'ville' => Validator::StringType()->setname("Ville"),
  'serie_lat' => Validator::numeric()->floatVal()->setname("Latitude"),
  'serie_long' => Validator::numeric()->floatVal()->setname("Longitude"),
  'dist' => Validator::numeric()->setname("Distance de marquage de point")
  ];
  // création de la série Twig
  $app->post('/creerSerie',
  function(Request $req, Response $resp, $args){
  if($req->getAttribute('has_errors')){
  $args['exception'] = $req->getAttribute('errors');
  }
  $ctrl=new Series($this);
  return $ctrl->getSeriesPost($req,$resp,$args);
  }
  )->setName("getSeriesPost")->add(new Validation($validators))->add('checkLogin');

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
  'ville' => Validator::StringType()->setname("Ville"),
  'serie_lat' => Validator::numeric()->floatVal()->setname("Latitude"),
  'serie_long' => Validator::numeric()->floatVal()->setname("Longitude"),
  'dist' => Validator::numeric()->setname("Distance de marquage de point")
  ];
  // Modification de la série Twig
  $app->post('/modifierSerie/{id}',
  function(Request $req, Response $resp, $args){
  if($req->getAttribute('has_errors')){
  $args['exception'] = $req->getAttribute('errors');
  }
  $ctrl=new Series($this);
  return $ctrl->getSeriesPut($req,$resp,$args);
  }
  )->setName("getSeriesPut")->add(new Validation($validators))->add('checkLogin');

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
