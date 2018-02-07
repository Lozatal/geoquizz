<?php
namespace geoquizz\control;

use Firebase\JWT\JWT;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use geoquizz\utils\Writer as Writer;

use geoquizz\model\Compte as Compte;

class AuthController {

	public $conteneur=null;

    public function __construct($conteneur){
      $this->conteneur=$conteneur;
    }

		public function authenticate(Request $req,Response $resp,array $args) {

			$rs= $resp->withHeader( 'Content-type', "application/json;charset=utf-8");

				if(!$req->hasHeader('Authorization')) {
					$rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs api" ');
					$resp= $resp->withStatus(401);
					$temp = array("type" => "error", "error" => '401', "message" => "No Authorization in header");
					$rs->getBody()->write(json_encode($temp));
					return $rs;
				}
				$auth = base64_decode( explode( " ", $req->getHeader('Authorization')[0]) [1] );
				list($user, $pass) = explode(':', $auth);
				try {
					$compte = Compte::select('id', 'nom', 'password')
						->where('id', '=', $args['id'])
						->firstOrFail();
					if($pass != $compte->password) {
						throw new \Exception("Authentification incorrecte");
						/*if(!password_verify($pass, $carte->password)) {
						throw new \Exception("Authentification incorrecte");*/
					}
				} catch(\Exception $e){
					$rs = $rs->withHeader('WWW-authenticate', 'Basic realm="lbs api" ');
					$resp= $resp->withStatus(401);
					$temp = array("type" => "error", "error" => '401', "message" => $e->getMessage());
					$rs->getBody()->write(json_encode($temp));
					return $rs;
				}

				$secret = 'geoquizz';
				$token = JWT::encode( [ 'iss'=>'http://backoffice.geoquizz.local/auth',
					'aud'=>'http://api.lbs.local',
					'iat'=>time(),
					'exp'=>time()+3600,
					'uid' =>  $compte->id],
					$secret, 'HS512' );

				$resp= $resp->withStatus(201);
				$temp = array("token" => $token);
				$rs->getBody()->write(json_encode($temp));

				return $rs;
			}

	// public function getCarte(Request $req, Response $resp, array $args){
	// 	$id=$args['id'];
  //     	$carte = Compte::select("id", "nom", "nbcommande", "montant")
  //     			->where("id", "=", $id)
  //     			->firstOrFail();
	//     $json =writer::jsonFormatRessource("carte",$carte,$links);
	//     $resp=$resp->withHeader('Content-Type','application/json');
	//     $resp->getBody()->write($json);
  //
	//     return $resp;
	// }
}
