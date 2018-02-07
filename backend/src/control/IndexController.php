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
      $compte=$this->conteneur->get('router')->pathFor('compteGet');

      $tabSeries=Serie::select('ville','id')->get();
      foreach($tabSeries as $tabSerie){
        $id=$tabSerie['id'];
        $tabSerie['afficher']=$this->conteneur->get('router')->pathFor('serieAfficherGet',['idSerie'=>$id]);
        $tabSerie['modifier']=$this->conteneur->get('router')->pathFor('serieModificationGet',['id'=>$id]);
        $tabSerie['supprimer']=$this->conteneur->get('router')->pathFor('serieSuppressionGet',['id'=>$id]);
      }

      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      $backoffice=$this->conteneur->get('router')->pathFor('index');
      return $this->conteneur->view->render($resp,'index.twig',['serie'=>$serie,
                                                                'tabSeries'=>$tabSeries,
                                                                'compte'=>$compte,
                                                                'backoffice'=>$backoffice,
                                                                'style'=>$style]);
    }
  }
