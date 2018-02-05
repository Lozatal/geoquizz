<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  //use geoquizz\model\Parties as parties;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class PartiesControlleur{
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
      //$photos=parties::get();
        /*
      $resp=$resp->withHeader('Content-Type','application/json');
      $resp->getBody()->write('toto');
      */
      return $resp;
    }

  }
