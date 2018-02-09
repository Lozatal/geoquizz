<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;
  use Ramsey\Uuid\Uuid as Uuid;

  use geoquizz\model\Serie as Series;
  use geoquizz\model\Photo as Photos;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class SerieController{
    public $conteneur=null;
    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    /*
    * Retourne la liste en json des Series sans la pagination avec le calcul du nombre d'images
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSeriesEtImages(Request $req,Response $resp,array $args){
      $series = Series::get();

      $resultat = [];

      //Pour chaque serie, on va rechercher le nombre d'images
      foreach($series as $serie){
        $nbImage = Photos::where('id_serie', '=', $serie->id)->count();

        if($nbImage == null){
          $nbImage = 0;
        }

        //On exclue les séries sans images
        if($nbImage > 0){
          $serie->nb_images = $nbImage;
          $resultat[] = $serie;
        }
      }

      $resp=$resp->withHeader('Content-Type','application/json')
                ->withStatus(200);
      $resp->getBody()->write(json_encode($resultat));
      return $resp;
    }

    /*
    * Retourne la liste en json des Series sans la pagination
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSeriesSansPagination(Response $resp,array $args){
      $series = Series::get();

      $resp=$resp->withHeader('Content-Type','application/json')
        ->withStatus(200);
      $resp->getBody()->write(json_encode($series));
      return $resp;
    }

    /*
    * Retourne une Series par son id
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSeriesID(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $postVar=$req->getParsedBody();
      $Series = Series::find($id);
      if($Series){
        $resp=$resp->withHeader('Content-Type','application/json')
                    ->withStatus(200);
        $resp->getBody()->write(json_encode($Series));
      }else{
          $resp=$resp->withStatus(404);
          $resp->getBody()->write('not found');
      }
      return $resp;
    }

    public function getSerieSuppression(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $Series = Series::find($id);
      if($Series){
        $Series->delete();
        $Photos = Photos::where('id_serie','=',$id)->get();
        if($Photos){
          foreach($Photos as $photo){
            $photo->delete();
          }
        }
      }
      $redirect=$this->conteneur->get('router')->pathFor('index');
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
      return $resp;
    }

    /*
    * Page de modification d'une série
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSerieModification(Request $req,Response $resp,array $args){
      if(isset($args['exception'])){
        $exception=$args['exception'];
      }else{
        $exception=null;
      }
      $id=$args['id'];
      $Series = Series::find($id);
      if($Series){
        $style='http://'.$_SERVER['HTTP_HOST']."/style";
        $modification=$this->conteneur->get('router')->pathFor('getSeriesPut',['id'=>$id]);
        $backoffice=$this->conteneur->get('router')->pathFor('index');
        $logout=$this->conteneur->get('router')->pathFor('logout');
        $compte=$this->conteneur->get('router')->pathFor('compteGet');
        return $this->conteneur->view->render($resp,'serie/modifierSerie.twig',['serie'=>$Series,
                                                                                'modification'=>$modification,
                                                                                'backoffice'=>$backoffice,
                                                                                'logout'=>$logout,
                                                                                'compte'=>$compte,
                                                                                'exception'=>$exception,
                                                                                'style'=>$style]);
      }else{
        $redirect=$this->conteneur->get('router')->pathFor('index');
        $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
        return $resp;
      }
    }

    /*
    * Page de création d'une série
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSerieCreation(Request $req,Response $resp,array $args){
      if(isset($args['exception'])){
        $exception=$args['exception'];
      }else{
        $exception=null;
      }
      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      $creation=$this->conteneur->get('router')->pathFor('getSeriesPost');
      $backoffice=$this->conteneur->get('router')->pathFor('index');
      $logout=$this->conteneur->get('router')->pathFor('logout');
      $compte=$this->conteneur->get('router')->pathFor('compteGet');
      return $this->conteneur->view->render($resp,'serie/creationSerie.twig',['creation'=>$creation,
                                                                              'backoffice'=>$backoffice,
                                                                              'logout'=>$logout,
                                                                              'compte'=>$compte,
                                                                              'exception'=>$exception,
                                                                              'style'=>$style]);
    }

    /*
    * Modifie une Serie via son ID avec Twig
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSeriesPut(Request $req,Response $resp,array $args){
      if(isset($args['exception'])){
        return $this->getSerieModification($req,$resp,$args);
      }
      $id=$args['id'];

      $postVar=$req->getParsedBody();

      $Series = Series::find($id);
      if($Series){
        try{
          $Series->ville=filter_var($postVar['ville'],FILTER_SANITIZE_STRING);
          $Series->serie_lat=filter_var($postVar['serie_lat'],FILTER_SANITIZE_STRING);
          $Series->serie_long=filter_var($postVar['serie_long'],FILTER_SANITIZE_STRING);
          $Series->dist=filter_var($postVar['dist'],FILTER_SANITIZE_STRING);
          $Series->save();
        }catch(ModelNotFoundException $e){
          $args['exception']=$e->getMessage();
          return $this->getSerieModification($req,$resp,$args);
        }
        $redirect=$this->conteneur->get('router')->pathFor('index');
        $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
        return $resp;
      }
      else{
        $redirect=$this->conteneur->get('router')->pathFor('index');
        $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
        return $resp;
      }
      return $resp;
    }

    /*
    * Ajoute une Serie avec Twig
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSeriesPost(Request $req,Response $resp,array $args){
      if(isset($args['exception'])){
        return $this->getSerieCreation($req,$resp,$args);
      }
      try{
        $postVar=$req->getParsedBody();
        $Series = new Series();
        //Création d'une Serie
        $Series->id= Uuid::uuid4();
        $Series->ville=filter_var($postVar['ville'],FILTER_SANITIZE_STRING);
        $Series->serie_lat=filter_var($postVar['serie_lat'],FILTER_SANITIZE_STRING);
        $Series->serie_long=filter_var($postVar['serie_long'],FILTER_SANITIZE_STRING);
        $Series->dist=filter_var($postVar['dist'],FILTER_SANITIZE_STRING);
        $Series->save();
      }catch(ModelNotFoundException $e){
        $args['exception']=$e->getMessage();
        return $this->getSerieCreation($req,$resp,$args);
      }

      $redirect=$this->conteneur->get('router')->pathFor('index');
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
      return $resp;
    }

    /*
    * Afficher la liste des photos d'une série sélectionné
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSerieAfficherPhotos(Request $req,Response $resp,array $args){
      $idSerie=$args['idSerie'];
      $photo=$this->conteneur->get('router')->pathFor('photoCreationGet',['idSerie'=>$idSerie]);
      $compte=$this->conteneur->get('router')->pathFor('compteGet');
      $logout=$this->conteneur->get('router')->pathFor('logout');

      $tabPhotos=Photos::select('description','id', 'url')->where('id_serie','=',$idSerie)->get();
      foreach($tabPhotos as $tabPhoto){
        $id=$tabPhoto['id'];
        $url=$tabPhoto['url'];
        $tabPhoto['modifier']=$this->conteneur->get('router')->pathFor('photoModificationGet',['id'=>$id,'idSerie'=>$idSerie]);
        $tabPhoto['supprimer']=$this->conteneur->get('router')->pathFor('photoSuppressionGet',['id'=>$id,'idSerie'=>$idSerie]);
      }

      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      $backoffice=$this->conteneur->get('router')->pathFor('index');
      $compte=$this->conteneur->get('router')->pathFor('compteGet');
      return $this->conteneur->view->render($resp,'serie/afficherSerie.twig',['photo'=>$photo,
                                                                              'url'=>$url,
                                                                              'tabPhotos'=>$tabPhotos,
                                                                              'compte'=>$compte,
                                                                              'logout'=>$logout,
                                                                              'backoffice'=>$backoffice,
                                                                              'compte'=>$compte,
                                                                              'style'=>$style]);
    }
}
