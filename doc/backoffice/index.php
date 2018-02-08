<?php

/**
 * File:  index.php
 * Creation Date: 08/02/2018
 * description:Geoquizz Documentation de l'API Backoffice
 *
 * @author: Ragonneau Valentin
 */

/**
 * @api {post} / Page de connexion au backoffice
 * @apiGroup Comptes
 * @apiName loginPost
 * @apiVersion 0.1.0
 *
 *
 * @apiParam {Request} req Requête
 * @apiParam {Response} resp Réponse
 * @apiParam {array} args Tableau d'argument
 *
 * @apiDescription Accès à la page de connexion :
 * Permet d'accéder au formulaire de connexion.
 * Retourne un affichage html/css du formulaire.
 *
 * @apisuccess (Succès : 301) Redirection vers la page /Backoffice
 */
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
 )->setName("loginPost");

?>
