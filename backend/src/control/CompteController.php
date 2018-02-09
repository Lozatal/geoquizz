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

    public function putCompte(Request $req, Response $resp, array $args){
      $postVar=$req->getParsedBody();

      $nom=filter_var($postVar['nom'],FILTER_SANITIZE_STRING);
      $email=filter_var($postVar['email'],FILTER_SANITIZE_STRING);
      $password=filter_var($postVar['password'],FILTER_SANITIZE_STRING);
      $password2=filter_var($postVar['password_rep'],FILTER_SANITIZE_STRING);
      $pass_old=filter_var($postVar['password_old'],FILTER_SANITIZE_STRING);

      $verifier= new \geoquizz\utils\GeoquizzAuthentification();
      $verifier->modifyUser($nom, $email, $password, $password2, $pass_old);

      $redirect=$this->conteneur->get('router')->pathFor('compteGet');
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);

      return $resp;
    }

    public function loginCompte(Request $req, Response $resp, array $args){
      $postVar=$req->getParsedBody();

      $email=filter_var($postVar['email'],FILTER_SANITIZE_STRING);
      $password=filter_var($postVar['password'],FILTER_SANITIZE_STRING);

      $verifier= new \geoquizz\utils\GeoquizzAuthentification();
      $verifier->login($email, $password);

      $redirect=$this->conteneur->get('router')->pathFor('index');
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);

      return $resp;
    }

    public function logoutCompte(Request $req, Response $resp, array $args){
      $verifier= new \geoquizz\utils\GeoquizzAuthentification();
      $verifier->logout();

      $redirect=$this->conteneur->get('router')->pathFor('comptesConnexionGet');
      $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
      return $resp;
    }

    //======================================================
    // Fonctions pour twig
    //======================================================

    public function getComptesConnexion(Request $req, Response $resp, array $args){
      $ajouter=$this->conteneur->get('router')->pathFor('comptesCreationGet');
      $login=$this->conteneur->get('router')->pathFor('loginPost');
      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      $backoffice=$this->conteneur->get('router')->pathFor('index');
      return $this->conteneur->view->render($resp,'connexion.twig',['creation'=>$ajouter,
                                                                    'login'=>$login,
                                                                    'backoffice'=>$backoffice,
                                                                    'style'=>$style]);
    }

    public function getComptesCreation(Request $req, Response $resp, array $args){
      $connexion=$this->conteneur->get('router')->pathFor('comptesConnexionGet');
      $ajouter=$this->conteneur->get('router')->pathFor('comptesCreationGet');
      $creation=$this->conteneur->get('router')->pathFor('comptesPost');
      $login=$this->conteneur->get('router')->pathFor('loginPost');
      $style='http://'.$_SERVER['HTTP_HOST']."/style";
      $backoffice=$this->conteneur->get('router')->pathFor('index');
      return $this->conteneur->view->render($resp,'compte/creationCompte.twig',['connexion'=>$connexion,
                                                                                'ajouter' =>$ajouter,
                                                                                'creation' =>$creation,
                                                                                'login'=>$login,
                                                                                'backoffice'=>$backoffice,
                                                                                'style'=>$style]);
    }

    public function getComptes(Request $req,Response $resp,array $args){
      $email=$_SESSION['user_login'];
      $compteGet = Compte::where("email","=",$email)->get();
      if($compteGet){
        $style='http://'.$_SERVER['HTTP_HOST']."/style";
        $backoffice=$this->conteneur->get('router')->pathFor('index');
        $logout=$this->conteneur->get('router')->pathFor('logout');
        $compte=$this->conteneur->get('router')->pathFor('compteGet');
        $modifier=$this->conteneur->get('router')->pathFor('modifierCompte');
        return $this->conteneur->view->render($resp,'compte/compte.twig',['style'=>$style,
                                                                          'backoffice'=>$backoffice,
                                                                          'logout'=>$logout,
                                                                          'compteGet'=>$compteGet,
                                                                          'modifier'=>$modifier,
                                                                          'compte'=>$compte]);
      }else{
        $redirect=$this->conteneur->get('router')->pathFor('index');
        $resp=$resp->withStatus(301)->withHeader('Location', $redirect);
        return $resp;
      }
    }
  }
