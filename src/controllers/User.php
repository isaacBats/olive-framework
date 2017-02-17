<?php 

namespace Olive\controllers;

use Olive\controllers\Controller;

class User extends Controller
{

	
	// public function login($req , $res){
	// 	$face = $this->session->get("facebook" , false );
	// 	$f = $face?["facebook" =>  $this->session->get("facebook") ]:[];
	// 	if( isset( $req->data["password"] ) && $face ){
	// 		$user = $this->mapper->build([
	// 	            'email'         => $req->data["username"],
	// 	            'password'         => $req->data["password"],
	// 	            'name'         => $req->data["name"],
	// 	            'type_user'         => 'user',
	// 	            'facebook_id'         => $face["id"]
	// 	        ]);
	// 	    $this->mapper->save( $user );
	// 	    $ext = pathinfo($face["picture"]["url"], PATHINFO_EXTENSION);
	// 	    $ext = explode("?" , $ext)[0];
	// 	    $img = __ASSETS__."profile_pic/".$face["id"].".".$ext;
	// 	    $img_name = $face["id"].".".$ext;
	// 	    file_put_contents($img, file_get_contents($face["picture"]["url"]));
	// 	    $UDMapper = $this->spot->mapper("Entity\UserDetails");
	// 	    $user_details = $UDMapper->build([
	// 	            'user_id'           => $user->id,
	// 	            'gender'           => $face["gender"],
	// 	            'avatar'       => $img_name
	// 	        ]);
	// 	    $UDMapper->save( $user_details );
	// 	    $session_user = $this->session_handle->getSegment('Luna\Session');

	// 	    $user->relation("detail" , $user_details );

	// 	    $session_user->set("user" , $user->toArray() );
	// 	    header( "Location: /");
	// 	    exit;
	// 	}
		
	// 	echo $this->rview( $res  , $f );
	// }

	// public function logout($req , $res){
	
	// 	header("Location: /login");
	// 	exit;

	// }

}