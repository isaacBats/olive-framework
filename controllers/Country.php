<?php 


/**
*
* 
*/

class Country extends Luna\Controller
{	
	public function home( $req , $res ){
		
		echo $this->rview($res);
	}


	public function getAction( $req, $res ){
		$id = $req->params["id"];
		$country = $this->mapper->select()->where(["id"=>$id])->toArray();
		

		$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
		$res->add( json_encode( $country , JSON_UNESCAPED_UNICODE) );
		//$res->add( $country );
		echo $res->send(); 
	}

	public function editAction( $req, $res ){

	}

	public function deleteAction( $req, $res ){

	}

	public function addAction( $req, $res ){

	}

	public function allAction( $req, $res ){

		$countries = $this->mapper->select()->toArray();


		$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
		$res->add( json_encode( $countries , JSON_UNESCAPED_UNICODE) );
		//$res->add( $countries );
		echo $res->send(); 

	}







}




?>