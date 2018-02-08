<?php

/**
 * File:  rest.php
 * Creation Date: 06/02/2018
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
 *              "description" : "Une série de photo concernant la ville de lyon",
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
 *              "description" : "Une série de photo concernant la ville de lyon",
 *              "serie_lat" : "45.75",
 *              "serie_long" : "4.85",
 *              "dist" : "100",
                "nb_images" : 10
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
 * @api {get} /series/{id}  accéder à une série en fonction de id
 * @apiGroup Series
 * @apiName getSeriesID
 * @apiVersion 0.1.0
 *
 *
 * @apiDescription Accès à toutes les ressources d'une série en particulier
 * permet d'accéder à la représentation des ressources d'une série
 * Retourne une représentation json des ressources, incluant l'id, la ville, localisation ainsi que la distance.
 *
 * @apisuccess (Succès : 200) OK Ressources trouvées
 *
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *     {
 *        serie : {
 *              "id"  : "0722ceee-16d9-4c68-b147-25d8bbcc9bd6",
 *              "ville" : "Lyon",
 *              "description" : "Une série de photo concernant la ville de lyon",
 *              "serie_lat" : "45.75",
 *              "serie_long" : "4.85",
 *              "dist" : "100",
 *        }
 *     }
 */

     //Afficher une serie par son ID
  $app->get('/series/{id}',
    function(Request $req, Response $resp, $args){
      $ctrl=new Serie($this);
      return $ctrl->getSeriesID($req,$resp,$args);
    }
  )->setName("seriesGetID");


/**
 * @api {put} /partie/{id} modifier une partie
 * @apiGroup Partie
 * @apiName updatePartie
 * @apiVersion 0.1.0
 *

 *
 * @apiDescription Accès à unes ressource de type partie :
 * Permet de modifier une partie nottament son score ainsi que le pseudo principalement,
 * lorsque le joueur a terminé sa partie.
 *
 * @apiParam {Number} id Identifiant unique de la partie à modifier 
 * @apiParam {Number} etat L'état de la partie
 * 
 * @apiParam (request parameter) {String}Token TokenJWT
 * 
 * @apiSuccessExample {json} exemple de réponse en cas de succès
 *     HTTP/1.1 200 OK
 *      Location: http://api.geoquizz.local/partie/
 *      Content-Type: application/json;charset=utf8
 * 
 * @apiError (Réponse : 400) MissingParameter paramètre manquant dans la requête
 * 
 * @apiErrorExample {json} exemple de réponse en cas d'erreur
 *     HTTP/1.1 400 Bad Request
 *     {
 *       "type": "error",
 *       "error" : 400,
 *       "message" : "donnée manquante (etat)"
 *     }
 */

$app->put('/partie[/]', function (Request $req, Response $resp, $args) {
    $c = new geoquizz\api\control\Controller($this);
    return $c->updatePartie($req, $resp, $args);
    }
)->add(new Validation( $validatorsUpdatePartie));