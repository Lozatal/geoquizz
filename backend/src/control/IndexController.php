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
      $serie=$this->conteneur->get('router')->pathFor('serieCreationGet');
      $photo=$this->conteneur->get('router')->pathFor('photoCreationGet');
      $compte=$this->conteneur->get('router')->pathFor('compteGet');

      $tabPhoto=Photo::select('description','id')->get();
      foreach($tabPhoto as $photo){
        $id=$photo['id'];
        $photo['modif']=$this->conteneur->get('router')->pathFor('photoModificationGet',['id'=>$id]);
        $photo['suppr']=$this->conteneur->get('router')->pathFor('photoModificationGet',['id'=>$id]);
      }

      $tabSerie=Serie::select('ville','id')->get();
      foreach($tabSerie as $serie){
        $id=$serie['id'];
        $serie['modif']=$this->conteneur->get('router')->pathFor('serieModificationGet',['id'=>$id]);
        $photo['suppr']=$this->conteneur->get('router')->pathFor('photoModificationGet',['id'=>$id]);
      }

      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      return $this->conteneur->view->render($resp,'index.twig',['photo'=>$photo,'serie'=>$serie,'tabSerie'=>$tabSerie,'tabPhoto'=>$tabPhoto,'compte'=>$compte,'style'=>$style]);
    }
  }
