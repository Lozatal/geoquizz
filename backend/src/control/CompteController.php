<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Compte as Comptes;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use Ramsey\Uuid\Uuid;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class CompteController{

    public $conteneur=null;

    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    public function getComptes(Request $req,Response $resp,array $args){
      $size = $req->getQueryParam('size',10);
      $page = $req->getQueryParam('page',1);

      $q = comptes::select('id','nom','email');

      //Récupération du total d'élement de la recherche
      $total = sizeof($q->get());

      if($total!=0){
        $returnPag=pagination::page($q,$size,$page,$total);
        $listeComptes = $returnPag["request"]->get();

        $tab = writer::addLink($listeComptes, 'Comptes', 'ComptesGetID');
        $json = writer::jsonFormatCollection("Comptes",$tab,$total,$size,$returnPag["page"]);
      }else{
        $json = writer::jsonFormatCollection("Comptes",[],0,0);
      }

      $resp=$resp->withHeader('Content-Type','application/json');
      $resp->getBody()->write($json);
      return $resp;
    }

    public function postCompte(Request $req, Response $resp, array $args){
      $postVar=$req->getParsedBody();

      $id= Uuid::uuid4();
      $nom=filter_var($postVar['nom'],FILTER_SANITIZE_STRING);
      $email=filter_var($postVar['email'],FILTER_SANITIZE_STRING);
      $password=filter_var($postVar['password'],FILTER_SANITIZE_STRING);
      $password2=filter_var($postVar['password_rep'],FILTER_SANITIZE_STRING);

      $verifier= new \geoquizz\utils\GeoquizzAuthentification();
      $verifier->createUser($id, $nom, $email, $password, $password2);

      $redirect=$this->conteneur->get('router')->pathFor('comptesConnexionGet');
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);

      return $resp;
    }

    public function getComptesConnexion(Request $req, Response $resp, array $args){
      $ajouter=$this->conteneur->get('router')->pathFor('comptesCreationGet');
      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      return $this->conteneur->view->render($resp,'connexion.twig',['creation'=>$ajouter, 'style'=>$style]);
    }

    public function getComptesCreation(Request $req, Response $resp, array $args){
      $login=$this->conteneur->get('router')->pathFor('comptesConnexionGet');
      $creation=$this->conteneur->get('router')->pathFor('comptesPost');
      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      return $this->conteneur->view->render($resp,'compte/creationCompte.twig',['connexion'=>$login, 'creation' =>$creation, 'style'=>$style]);
    }
  }
