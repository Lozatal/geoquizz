<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Compte as Compte;
  use geoquizz\model\Photo as Photo;
  use geoquizz\model\Serie as Serie;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class IndexController{

    public $conteneur=null;

    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    //======================================================
    // Fonctions pour twig
    //======================================================

    public function getIndex(Request $req, Response $resp, array $args){
      $userid=$args['userid'];
      $serie=$this->conteneur->get('router')->pathFor('serieCreationGet',['userid'=>$userid]);
      $photo=$this->conteneur->get('router')->pathFor('photoCreationGet',['userid'=>$userid]);
      $compte=$this->conteneur->get('router')->pathFor('compteGet',['userid'=>$userid]);
      $tabPhoto=Photo::select('description','id')->get();
      foreach($tabPhoto as $photo){
        $photo['url']=$this->conteneur->get('router')->pathFor('photoModificationGet',['id'=>$photo['id'],'userid'=>$userid]);
      }
      $tabSerie=Serie::select('ville','id')->get();
      foreach($tabSerie as $serie){
        $serie['url']=$this->conteneur->get('router')->pathFor('photoModificationGet',['id'=>$serie['id'],'userid'=>$userid]);
      }
      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      return $this->conteneur->view->render($resp,'index.twig',['photo'=>$photo,'serie'=>$serie,'tabSerie'=>$tabSerie,'tabPhoto'=>$tabPhoto,'compte'=>$compte,'style'=>$style]);
    }
  }
