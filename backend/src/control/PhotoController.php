<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Photo as Photos;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class PhotoController{
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

      $q = Photos::select('id','description');

      //Récupération du total d'élement de la recherche
      $total = sizeof($q->get());

      if($total!=0){
        $returnPag=pagination::page($q,$size,$page,$total);
        $listePhotos = $returnPag["request"]->get();

        $tab = writer::addLink($listePhotos, 'Photos', 'photosGetID');
        $json = writer::jsonFormatCollection("Photos",$tab,$total,$size,$returnPag["page"]);
      }else{
        $json = writer::jsonFormatCollection("Photos",[],0,0);
      }

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
      $idSerie=$args['idSerie'];

      $postVar=$req->getParsedBody();

      $Photos = Photos::find($id);
      if($Photos){
        $Photos->description=filter_var($postVar['description'],FILTER_SANITIZE_STRING);
        $Photos->url=filter_var($postVar['url'],FILTER_SANITIZE_STRING);
        $Photos->position_long=filter_var($postVar['position_long'],FILTER_SANITIZE_STRING);
        $Photos->position_lat=filter_var($postVar['position_lat'],FILTER_SANITIZE_STRING);
        $Photos->save();
      }
      $redirect=$this->conteneur->get('router')->pathFor('serieAfficherGet',['idSerie'=>$idSerie]);
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
      return $resp;
    }

    /*
    * Ajoute une Photo
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function postPhotos(Request $req,Response $resp,array $args){
      $idSerie=$args['idSerie'];
      $postVar=$req->getParsedBody();
      $Photos = new Photos();
      //Création du Photos
      $Photos->description=filter_var($postVar['description'],FILTER_SANITIZE_STRING);
      $Photos->url=filter_var($postVar['url'],FILTER_SANITIZE_STRING);
      $Photos->position_long=filter_var($postVar['position_long'],FILTER_SANITIZE_STRING);
      $Photos->position_lat=filter_var($postVar['position_lat'],FILTER_SANITIZE_STRING);
      $Photos->id_serie=filter_var($postVar['id_serie'],FILTER_SANITIZE_STRING);
      $Photos->save();

      $redirect=$this->conteneur->get('router')->pathFor('serieAfficherGet',['idSerie'=>$idSerie]);
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
      return $resp;
    }

    /*
    * Ajoute supprime une photo depuis Twig
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getPhotoSuppresion(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $idSerie=$args['idSerie'];
      $Photos = Photos::find($id);
      if($Photos){
        $Photos->delete();
      }
      $redirect=$this->conteneur->get('router')->pathFor('serieAfficherGet',['idSerie'=>$idSerie]);
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
      return $resp;
    }

    /*
    * Page de modification d'une photo
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getPhotoModification(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $idSerie=$args['idSerie'];
      $Photos = Photos::find($id);
      if($Photos){
        $style='http://'.$_SERVER['HTTP_HOST']."/style";
        $modification=$this->conteneur->get('router')->pathFor('photosPut',['id'=>$id,'idSerie'=>$idSerie]);
        $backoffice=$this->conteneur->get('router')->pathFor('index');
        return $this->conteneur->view->render($resp,'photo/modifierPhoto.twig',['photo'=>$Photos,
                                                                                'modification'=>$modification,
                                                                                'backoffice'=>$backoffice,
                                                                                'style'=>$style]);
      }else{
        $redirect=$this->conteneur->get('router')->pathFor('serieAfficherGet',['idSerie'=>$idSerie]);
        $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
        return $resp;
      }
    }

      /*
      * Page de création d'une photo
      * @param : Request $req, Response $resp, array $args[]
      * Return Response $resp contenant la page complète
      */
      public function getPhotoCreation(Request $req,Response $resp,array $args){
        $idSerie=$args['idSerie'];
        $style='http://'.$_SERVER['HTTP_HOST']."/style";
        $creation=$this->conteneur->get('router')->pathFor('photosPost',['idSerie'=>$idSerie]);
        $backoffice=$this->conteneur->get('router')->pathFor('index');
        return $this->conteneur->view->render($resp,'photo/creationPhoto.twig',['creation'=>$creation,
                                                                                'backoffice'=>$backoffice,
                                                                                'idSerie'=>$idSerie,
                                                                                'style'=>$style]);
      }
  }
