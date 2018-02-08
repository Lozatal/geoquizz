<?php

/**
 * File:  index.php
 * Creation Date: 08/02/2018
 * description:Geoquizz Documentation de l'API Player 
 *
 * @author: Daniel Bentz
 */

/**
 * @api {get} /series  accéder à toutes les séries
 * @apiGroup Series
 * @apiName getSeriesSansPagination
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources de type série :
 * permet d'accéder à la représentation des ressources séries sans pagination.
 * Retourne une représentation json des ressources, incluant leur id, ville, localisation ainsi que la distance (difficulté).
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        "type" : "collection",
 *          serie : {
 *              "id"  : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6",
 *              "ville" : "Lyon",
 *              "description" : "Une série de photos concernant la ville de lyon",
 *              "serie_lat" : "45.75",
 *              "serie_long" : "4.85",
 *              "dist" : "100"
 *        }
 *     }
 */

  $app->get('/series[/]',
    function(Request $req, Response $resp, $args){
      $ctrl=new Serie($this);
      return $ctrl->getSeriesSansPagination($resp,$args);
    }
  )->setName("getSeriesSansPagination");

  /**
 * @api {get} /seriesNbImage  accéder à toutes les séries 'active' (avec des photos) ainsi que le nombre d'images
 * @apiGroup Series
 * @apiName getSeriesEtImages
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources de type série :
 * permet d'accéder à la représentation des ressources séries sans pagination avec le total du nombre d'images liées à cette série.
 * Retourne une représentation json des ressources, incluant leur id, ville, localisation ainsi que la distance et le nombre d'image.
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        "type" : "collection",
 *          serie : {
 *              "id"  : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6",
 *              "ville" : "Lyon",
 *              "description" : "Une série de photos concernant la ville de lyon",
 *              "serie_lat" : "45.75",
 *              "serie_long" : "4.85",
 *              "dist" : "100",
 *              "nb_images" : 10
 *        }
 *     }
 */

//On récupère la liste des series 'active' avec photos ainsi que le nombre de photos
  $app->get('/seriesNbImage[/]',
    function(Request $req, Response $resp, $args){
      $ctrl=new Serie($this);
      return $ctrl->getSeriesEtImages($req,$resp,$args);
    }
  )->setName("getSeriesEtImages");

    /**
 * @api {get} /series/{id}  accéder à une série en fonction d'un id
 * @apiGroup Series
 * @apiName getSeriesID
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources d'une série en particulier
 * permet d'accéder à la représentation des ressources d'une série
 * Retourne une représentation json des ressources, incluant l'id, la ville, localisation ainsi que la distance.
 *
 * @apiParam {varchar} id uuid de la série à rechercher
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        serie : {
 *              "id"  : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6",
 *              "ville" : "Lyon",
 *              "description" : "Une série de photos concernant la ville de lyon",
 *              "serie_lat" : "45.75",
 *              "serie_long" : "4.85",
 *              "dist" : "100"
 *        }
 *     }
 */

     //Afficher une serie par son ID
  $app->get('/series/{id}',
    function(Request $req, Response $resp, $args){
      $ctrl=new Serie($this);
      return $ctrl->getSeriesID($req,$resp,$args);
    }
  )->setName("getSeriesID");

/**
 * @api {get} /parties/{id}  accéder à une partie en fonction d'un id
 * @apiGroup Parties
 * @apiName getPartie
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources d'une partie en particulier
 * permet d'accéder à la représentation des ressources d'une partie
 * Retourne une représentation json des ressources, incluant l'id, la ville, localisation ainsi que la distance, la série et les photos.
 *
 * @apiParam {varchar} id uuid de la partie à rechercher
 *
 * @apiParam (request parameter) {Varchar} Token TokenJWT
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        partie : {
 *              "id"  : "02b0a1df-1766-4fb3-adfe-7e418e27b0fa",
 *              "token" : "ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced",
 *              "nb_photos" : "10",
 *              "status" : "1",
 *              "score" : "20",
 *              "joueur" : "Dupont",
 *              "id_serie" : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6",
 *              "serie": {
 *                "id": "0722ceee-16d9-4c68-b147-25d8bbcc9bd6",
 *                "ville": "Seoul",
 *                "map_refs": "1",
 *                "dist": "100"
 *              },
 *              "photos": [
 *                {
 *                    "id": 1,
 *                    "description": "palais",
 *                    "position_long": "10",
 *                    "position_lat": "10",
 *                    "url": "https://www.hkexpress.com/sites/default/files/seoul.jpg",
 *                    "id_serie": "0722ceee-16d9-4c68-b147-25d8bbcc9bd6"
 *                },
 *                {
 *                    "id": 2,
 *                    "description": "temple",
 *                    "position_long": "10",
 *                    "position_lat": "10",
 *                    "url": "https://tripagency.info/wp-content/uploads/2016/04/seoul.jpg",
 *                    "id_serie": "0722ceee-16d9-4c68-b147-25d8bbcc9bd6"
 *                }
 *              ]
 *        }
 *     }
 *
 * @apiError (Erreur : 404) NotFound Pas de partie dans la base de données avec cette id.
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not Found
 *
 *     {
 *       "not found"
 *     }
 */

  $app->get('/parties/{id}[/]',
    function(Request $req, Response $resp, $args){
      $ctrl=new Partie($this);
      return $ctrl->getPartie($resp,$args);
    }
  )->setName("getPartie")->add('checkToken');

/**
 * @api {get} /parties  accéder aux 10 meilleurs parties
 * @apiGroup Parties
 * @apiName partiesListe
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources des 10 meilleurs parties (meilleur score)
 * permet d'accéder à la représentation des ressources de ces 10 parties
 * Retourne une représentation json de collection de ressources, incluant l'id, le token, la ville, localisation ainsi que la distance.
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        "type" : "collection",
 *        partie : {
 *              "id"  : "02b0a1df-1766-4fb3-adfe-7e418e27b0fa",
 *              "token" : "ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced",
 *              "nb_photos" : "10",
 *              "status" : "1",
 *              "score" : "20",
 *              "joueur" : "Dupont",
 *              "id_serie" : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6",
 *        }
 *     }
 */

  //on souhaite l'historique des 10 meilleurs parties
  $app->get('/parties[/]',
    function(Request $req, Response $resp, $args){
      $ctrl=new Partie($this);
      return $ctrl->getParties($resp,$args);
    }
  )->setName("partiesListe");

/**
 * @api {get} /parties/player/{player}  accéder aux parties d'un joueur
 * @apiGroup Parties
 * @apiName partiesListePlayer
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources des parties d'un joueur en particulier
 * permet d'accéder à la représentation des ressources de ces parties
 * Retourne une représentation json de collection de ressources, incluant l'id, le token, la ville, localisation ainsi que la distance.
 *
 * @apiParam {varchar} player nom du joueur a rechercher
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        "type" : "collection",
 *        partie : {
 *              "id"  : "02b0a1df-1766-4fb3-adfe-7e418e27b0fa",
 *              "token" : "ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced",
 *              "nb_photos" : "10",
 *              "status" : "1",
 *              "score" : "20",
 *              "joueur" : "Dupont",
 *              "id_serie" : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6"
 *        }
 *     }
 */

  //On recherche les parties d'un joueur
  $app->get('/parties/player/{player}[/]',
    function(Request $req, Response $resp, $args){
      $ctrl=new Partie($this);
      return $ctrl->getPartiesPlayer($resp,$args);
    }
  )->setName("partiesListePlayer");

/**
 * @api {post} /parties  Créer une partie
 * @apiGroup Parties
 * @apiName createPartie
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Création d'une ressource de type Partie:
 * permet d'ajouter une ressource partie.
 * Retourne une représentation json de la ressource, incluant son id, token, pseudo, son nombre de photos maximum, son status,
 * le score est vide
 *
 * @apiParam {Number} nb_photos Nombre de photos a afficher lors de la partie
 * @apiParam {Varchar} joueur Pseudo du joueur
 * @apiParam {Varchar} id_serie Uuid de la série
 * 
 * @apiSuccess (Réponse : 201) {json} Created représentation json de la nouvelle ressource partie
 *
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 201 CREATED
 *     {
 *        partie : {
 *              "id"  : "02b0a1df-1766-4fb3-adfe-7e418e27b0fa",
 *              "token" : "ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced",
 *              "nb_photos" : "10",
 *              "status" : "0",
 *              "score" : "",
 *              "joueur" : "Dupont",
 *              "id_serie" : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6"
 *        }
 *     }
 *
 *
 * @apiError (Réponse : 400) Bad request paramètre manquant dans la requête
 *
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *        "Bad request"
 *     }
 */

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

/**
 * @api {put} /parties/{id} modifier le score et l'état d'une partie
 * @apiGroup Parties
 * @apiName updateScorePartie
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à unes ressource de type partie :
 * Permet de modifier le score d'une partie, modifier automatiquement l'état de la partie en terminé,
 * lorsque le joueur a terminé sa partie.
 *
 * @apiParam {Varchar} id Uuid unique de la partie à modifier 
 * 
 * @apiParam (request parameter) {Varchar} Token TokenJWT
 * 
 * @apiSuccessExample {response} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        partie : {
 *              "id"  : "02b0a1df-1766-4fb3-adfe-7e418e27b0fa",
 *              "token" : "ae48aa07ab511e2d1d303acf0cee2fb5c4b3f9df3af891c713850a5134687ced",
 *              "nb_photos" : "10",
 *              "status" : "1",
 *              "score" : "42",
 *              "joueur" : "Dupont",
 *              "id_serie" : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6"
 *        }
 *     }
 * 
 * @apiError (Réponse : 404) Not found identifiant de la partie non valide
 * 
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 404 Not found
 *     {
 *        "Bad request"
 *     }
 */

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