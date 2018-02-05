<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Photos as photos;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class PhotosController{
    public $conteneur=null;
    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    /*
    * Retourne la page de modification d'un sandwich
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getPhotos(Request $req,Response $resp,array $args){
      $categories=photos::get();
      $resp->getBody()->write("coucou");
      return $resp;
    }

  }
