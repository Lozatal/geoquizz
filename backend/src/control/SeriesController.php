<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Compte as compte;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class ComptesControlleur{

    public $conteneur=null;

    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    public function postCompte(Request $req,Response $resp,array $args){
      $photos=photos::get();

      $resp=$resp->withHeader('Content-Type','application/json');
      $resp->getBody()->write($json);
      return $resp;
    }
  }
