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
		$response = new stdClass();
		$country = $this->mapper->select()->where(["id"=>$id])->first();
		$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
		$response->country = $country;
		$res->add( json_encode( $response , JSON_UNESCAPED_UNICODE) );
		echo $res->send(); 
	}

	public function editAction( $req, $res ){
		$country_data = $req->data;
		$id = $req->params["id"];
		unset( $country_data["_RAW_HTTP_DATA"]);
		$country = $this->mapper->where(["id"=>$id])->first();
		foreach ($country_data as $key => $value) {
			if( isset( $country->{$key} ) ){
				$country->{$key} = $value;
			}
		}
		$this->mapper->update($country);
	}

	public function deleteAction( $req, $res ){
		$id = $req->params["id"];
		$delete = $this->mapper->delete(["id"=>$id]);
		$response = new stdClass();
		$response->msg = ( $delete != 0 ) ? "Eliminado" : "No existe el elemento" ;
		$res->add( json_encode( $response , JSON_UNESCAPED_UNICODE) );
		echo $res->send(); 
	}

	public function addAction( $req, $res ){
		$country = $req->data;
		unset( $country["_RAW_HTTP_DATA"]);
		$this->mapper->create($country);
	}

	public function allAction( $req, $res ){

		$countries = $this->mapper->select()->toArray();


		$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
		$res->add( json_encode( $countries , JSON_UNESCAPED_UNICODE) );
		echo $res->send(); 

	}







}




?>