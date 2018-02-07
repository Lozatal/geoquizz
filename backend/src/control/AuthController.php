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

  		if(!$req->hasHeader('Authorization')) {
				$resp = $resp->withHeader('WWW-authenticate', 'Basic realm="geoquizz api" ');
				$resp= $resp->withStatus(401);
				$temp = array("type" => "error", "error" => '401', "message" => "No Authorization in header");
				$resp->getBody()->write(json_encode($temp));
				return $resp;
			}

		$auth=base64_decode(explode(" ", $req->getHeader('Authorization')[0]) [1]);
		list($user, $pass) = explode(':', $auth);

		try {
			$compte = Compte::select('email', 'password')
				->where('email', '=', $args['email'])
				->where('password', '=', $args['password'])
				->firstOrFail();
			if(!password_verify($pass, $carte->password)) {
				throw new \Exception("Authentification incorrecte");
			unset($compte->password);
			}
		} catch(\Exception $e){
			$resp = $resp->withHeader('WWW-authenticate','Basic realm="lbs api"');
    		return Writer::json_error($resp, 401, 'carte ou nom de client non reconnu');
		}

		$secret = 'geoquizz';
		$token = JWT::encode( [
			'iat'=>time(),
			'exp'=>time()+3600,
			'uid' =>  $compte->id],
			$secret, 'HS512' );

		$resp= $resp->withStatus(201);
		$resp->getBody()->write(json_encode($token));

		return $resp;
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
