<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Compte as compte;

  use Ramsey\Uuid\Uuid;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class ComptesController{

    public $conteneur=null;

    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    public function postCompte(Request $req, Response $resp, array $args){
       $data = $req->getParsedBody();

       if (!isset($data['nom'])) return $resp->withStatus(400);
       if (!isset($data['email'])) return $resp->withStatus(400);
       if (!isset($data['password'])) return $resp->withStatus(400);

       $compte = compte();
       $compte->id = Uuid::uuid4();
       $compte->nom = filter_var($data['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
       $compte->email = filter_var($data['email'], FILTER_SANITIZE_SPECIAL_CHARS);
       $compte->password = filter_var($data['password'], FILTER_SANITIZE_SPECIAL_CHARS);
       $compte->save();

       return $response->withStatus(201);
      return $resp;
    }
  }
