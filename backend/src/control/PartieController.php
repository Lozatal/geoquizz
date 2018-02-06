<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;
  use Ramsey\Uuid\Uuid as Uuid;

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
    public function getParties(Response $resp,array $args){
      $parties=partie::get();
        
      $resp=$resp->withHeader('Content-Type','application/json')
            ->withStatus(200);
      $resp->getBody()->write(json_encode($parties));
      return $resp;
    }

    /*
    * Sauvegarde une partie a partir d'une requête post
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    
    public function createPartie(Request $req,Response $resp,array $args){
      $postVar=$req->getParsedBody();

      if ($postVar != null){
        $partie=new partie();
        $partie->id= Uuid::uuid4();
        $partie->token=bin2hex(random_bytes(32));
        $partie->status=0; //created
        $partie->nb_photos = filter_var($postVar['nb_photos'],FILTER_SANITIZE_STRING);
        $partie->joueur = filter_var($postVar['joueur'],FILTER_SANITIZE_STRING);
        $partie->id_serie = filter_var($postVar['id_serie'],FILTER_SANITIZE_STRING);

        $partie->save();
          
        $resp=$resp->withHeader('Content-Type','application/json')
            ->withStatus(201);
        $resp->getBody()->write(json_encode($partie));
      }else{
        $resp=$resp->withStatus(400);
        $resp->getBody()->write('Bad request');
      }
      return $resp;
    }
  }
