<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Serie as Series;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class SeriesController{
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

      $q = Series::select('*');

      //Récupération du total d'élement de la recherche
      $total = sizeof($q->get());

      $returnPag=pagination::page($q,$size,$page,$total);
      $listeSeries = $returnPag["request"]->get();

      $tab = writer::addLink($listeSeries, 'Series', 'seriesGetID');
      $json = writer::jsonFormatCollection("Series",$tab,$total,$size,$returnPag["page"]);

      $resp=$resp->withHeader('Content-Type','application/json');
      $resp->getBody()->write($json);
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

  }
