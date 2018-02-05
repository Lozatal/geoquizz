<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Partie as partie;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class PartieController{
    public $conteneur=null;
    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    /*
    * Retourne la page de modification d'un sandwich
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getParties(Request $req,Response $resp,array $args){
      $parties=partie::get();
        
      $resp=$resp->withHeader('Content-Type','application/json');
      $resp->getBody()->write(json_encode($parties));
      
      return $resp;
    }

  }
