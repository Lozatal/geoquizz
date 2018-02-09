<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Photo as Photos;
  use geoquizz\model\Serie as Serie;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class PhotoController{
    public $conteneur=null;
    public function __construct($conteneur){
      $this->conteneur=$conteneur;
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
      $Serie=Serie::where('id','=',$idSerie)->select('serie_lat','serie_long')->first();
      $Photos = Photos::find($id);
      if($Photos){
        $style='http://'.$_SERVER['HTTP_HOST']."/style";
        $modification=$this->conteneur->get('router')->pathFor('photosPut',['id'=>$id,'idSerie'=>$idSerie]);
        $backoffice=$this->conteneur->get('router')->pathFor('index');
        $logout=$this->conteneur->get('router')->pathFor('logout');
        $compte=$this->conteneur->get('router')->pathFor('compteGet');
        return $this->conteneur->view->render($resp,'photo/modifierPhoto.twig',['photo'=>$Photos,
                                                                                'modification'=>$modification,
                                                                                'backoffice'=>$backoffice,
                                                                                'logout'=>$logout,
                                                                                'latSerie'=>$Serie['serie_lat'],
                                                                                'longSerie'=>$Serie['serie_long'],
                                                                                'compte'=>$compte,
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
        $Serie=Serie::where('id','=',$idSerie)->select('serie_lat','serie_long')->first();
        $style='http://'.$_SERVER['HTTP_HOST']."/style";
        $creation=$this->conteneur->get('router')->pathFor('photosPost',['idSerie'=>$idSerie]);
        $backoffice=$this->conteneur->get('router')->pathFor('index');
        $logout=$this->conteneur->get('router')->pathFor('logout');
        $compte=$this->conteneur->get('router')->pathFor('compteGet');
        return $this->conteneur->view->render($resp,'photo/creationPhoto.twig',['creation'=>$creation,
                                                                                'backoffice'=>$backoffice,
                                                                                'idSerie'=>$idSerie,
                                                                                'latSerie'=>$Serie['serie_lat'],
                                                                                'longSerie'=>$Serie['serie_long'],
                                                                                'logout'=>$logout,
                                                                                'compte'=>$compte,
                                                                                'style'=>$style]);
      }
  }
