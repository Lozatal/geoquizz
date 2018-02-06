<?php

  namespace geoquizz\control;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  use geoquizz\model\Compte as Compte;

  use geoquizz\utils\Writer as writer;
  use geoquizz\utils\Pagination as pagination;

  use Ramsey\Uuid\Uuid;

  use illuminate\database\Eloquent\ModelNotFoundException as ModelNotFoundException;

  class CompteController{

    public $conteneur=null;

    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

    //======================================================
    //Fonctions principales
    //======================================================

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

    //======================================================
    // Fonctions pour twig
    //======================================================

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

    public function getComptes(Request $req,Response $resp,array $args){
      $id=$args['id'];
      $compte = Compte::select('nom','email')->find($id);
      
      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      return $this->conteneur->view->render($resp,'compte/compte.twig',[]);
    }
  }
