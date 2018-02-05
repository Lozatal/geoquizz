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
       $data = $request->getParsedBody();
       //var_dump($data);


       if (!isset($data['nom'])) return $response->withStatus(400);
       if (!isset($data['description'])) return $response->withStatus(400);

       $myCategorie = new lbs\models\Categorie();
       $myCategorie->nom = filter_var($data['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
       $myCategorie->description = filter_var($data['description'], FILTER_SANITIZE_SPECIAL_CHARS);
       $myCategorie->save();

       return $response->withStatus(201);
      return $resp;
    }
  }
