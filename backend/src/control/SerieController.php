<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Serie as Series;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class SerieController{
    public $conteneur=null;
    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    /*
    * Retourne la liste en json des Series
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function getSeries(Request $req,Response $resp,array $args){
      $size = $req->getQueryParam('size',10);
      $page = $req->getQueryParam('page',1);

      $q = Series::select('id','ville');

      //Récupération du total d'élement de la recherche
      $total = sizeof($q->get());

      if($total!=0){
        $returnPag=pagination::page($q,$size,$page,$total);
        $listeSeries = $returnPag["request"]->get();

        $tab = writer::addLink($listeSeries, 'Series', 'seriesGetID');
        $json = writer::jsonFormatCollection("Series",$tab,$total,$size,$returnPag["page"]);
      }else{
        $json = writer::jsonFormatCollection("Series",[],0,0);
      }

      $resp=$resp->withHeader('Content-Type','application/json');
      $resp->getBody()->write($json);
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
        $resp=$resp->withHeader('Content-Type','application/json');
        $resp->getBody()->write(json_encode($Series));
      }else{
          $resp=$resp->withStatus(404);
          $resp->getBody()->write('not found');
      }
      return $resp;
    }

    /*
    * Supprime une Serie par son ID
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function deleteSeries(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $postVar=$req->getParsedBody();
      $Series = Series::find($id);
      if($Series){
        $Series->delete();
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
    * Modifie une Serie via son ID
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function putSeriesID(Request $req,Response $resp,array $args){
      $id=$args['id'];

      $postVar=$req->getParsedBody();

      $Series = Series::find($id);
      if($Series){
        if (!is_null($postVar['ville'])
        && !is_null($postVar['map_refs'])
        && !is_null($postVar['dist'])){
          $Series->ville=filter_var($postVar['ville'],FILTER_SANITIZE_STRING);
          $Series->map_refs=filter_var($postVar['map_refs'],FILTER_SANITIZE_STRING);
          $Series->dist=filter_var($postVar['dist'],FILTER_SANITIZE_STRING);
          $Series->save();
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
    * Ajoute une Serie
    * @param : Request $req, Response $resp, array $args[]
    * Return Response $resp contenant la page complète
    */
    public function postSeries(Request $req,Response $resp,array $args){
      $postVar=$req->getParsedBody();
      $Series = new Series();
      //Création du Series
      if (!is_null($postVar['ville'])
      && !is_null($postVar['id'])
      && !is_null($postVar['map_refs'])
      && !is_null($postVar['dist'])){
        $Series->id=filter_var($postVar['id'],FILTER_SANITIZE_STRING);
        $Series->ville=filter_var($postVar['ville'],FILTER_SANITIZE_STRING);
        $Series->map_refs=filter_var($postVar['map_refs'],FILTER_SANITIZE_STRING);
        $Series->dist=filter_var($postVar['dist'],FILTER_SANITIZE_STRING);
        $Series->save();
        $resp=$resp->withStatus(201);
        $resp->getBody()->write('Created');
      }
      else{
        $resp=$resp->withStatus(400);
        $resp->getBody()->write('Bad request');
      }

      return $resp;
    }
  }
