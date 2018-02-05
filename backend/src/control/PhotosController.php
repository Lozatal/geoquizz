<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Photos as Photos;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class PhotosController{
    public $conteneur=null;
    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    /*
    * Retourne la liste en json des Photos
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getPhotos(Request $req,Response $resp,array $args){
      $size = $req->getQueryParam('size',10);
      $page = $req->getQueryParam('page',1);

      $q = Photos::select('id','description','url');

      //Récupération du total d'élement de la recherche
      $total = sizeof($q->get());

      $returnPag=pagination::page($q,$size,$page,$total);
      $listePhotos = $returnPag["request"]->get();

      $tab = writer::addLink($listePhotos, 'Photos', 'photosGetID');
      $json = writer::jsonFormatCollection("Photos",$tab,$total,$size,$returnPag["page"]);

      $resp=$resp->withHeader('Content-Type','application/json');
      $resp->getBody()->write($json);
      return $resp;
    }

    /*
    * Retourne la description complète d'une photo en json
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getPhotosID(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $resp=$resp->withHeader('Content-Type','application/json');
      $Photos = Photos::find($id);
      if($Photos==null){//Si id introuvable
        $json["erreur"]="Id trouvable";
        $resp=$resp->withHeader('Content-Type','application/json')->withStatus(204);
        $resp->getBody()->write(json_encode($json));
      }else{
        $json=writer::jsonFormatRessource("Photos",$Photos);
        $resp=$resp->withHeader('Content-Type','application/json');
        $resp->getBody()->write($json);
      }
      return $resp;
    }

    /*
    * Supprime une photo par son ID
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function deletePhotos(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $postVar=$req->getParsedBody();
      $Photos = Photos::find($id);
      if($Photos){
        $Photos->delete();
        $resp=$resp->withStatus(200);
        $resp->getBody()->write('Delete Complete');
      }
      else{
        $resp=$resp->withStatus(404);
        $resp->getBody()->write('not found');
      }
      return $resp;
    }

    /*
    * Modifie une Photo via son ID
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function putPhotosID(Request $req,Response $resp,array $args){
      $id=$args['id'];

      $postVar=$req->getParsedBody();

      $Photos = Photos::find($id);
      if($Photos){
        if (!is_null($postVar['description']) && !is_null($postVar['url']) && !is_null($postVar['position_long']) && !is_null($postVar['position_lat'])){
          $Photos->description=filter_var($postVar['description'],FILTER_SANITIZE_STRING);
          $Photos->url=filter_var($postVar['url'],FILTER_SANITIZE_STRING);
          $Photos->position_long=filter_var($postVar['position_long'],FILTER_SANITIZE_STRING);
          $Photos->position_lat=filter_var($postVar['position_lat'],FILTER_SANITIZE_STRING);
          $Photos->save();
          $resp=$resp->withStatus(200);
          $resp->getBody()->write('Modification complete');
        }
        else{
          $resp=$resp->withStatus(400);
          $resp->getBody()->write('Bad request');
        }
      }
      else{
        $resp=$resp->withStatus(404);
        $resp->getBody()->write('not found');
      }
      return $resp;
    }

    /*
    * Ajoute un Photos
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function postPhotos(Request $req,Response $resp,array $args){
      $postVar=$req->getParsedBody();
      $Photos = new Photos();
      //Création du Photos
      if (!is_null($postVar['description']) && !is_null($postVar['url']) && !is_null($postVar['position_long']) && !is_null($postVar['position_lat'])){
        $Photos->description=filter_var($postVar['description'],FILTER_SANITIZE_STRING);
        $Photos->url=filter_var($postVar['url'],FILTER_SANITIZE_STRING);
        $Photos->position_long=filter_var($postVar['position_long'],FILTER_SANITIZE_STRING);
        $Photos->position_lat=filter_var($postVar['position_lat'],FILTER_SANITIZE_STRING);
        $Photos->save();

        $resp=$resp->withStatus(201);
        $resp->getBody()->write('Created');
      }
      else{
        $resp=$resp->withStatus(400);
        $resp->getBody()->write('Bad request');
      }

      return $resp;
    }

    alias 'ls= ls --color=auto'
    PS1='${debian_chroot:+($debian_chroot)}\[\033[01;32m\]\u@\h\[\033[00m\]:\[\033[01;34m\]\w\[\033[00m\]\$ '

  }
