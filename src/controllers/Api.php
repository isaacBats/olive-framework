<?php 

namespace Olive\controllers;

use Olive\controllers\Controller;

class Api extends Controller
{	

	public $response_name = "";

	public function home( $req , $res ){
		
		echo $this->rview($res);
	}


	public function getAction( $req, $res ){
		$id = $req->params["id"];
		$response = new \stdClass();
		$entity = $this->mapper->select()->where(["id"=>$id])->first();
		$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
		$response->entity = $entity;
		$res->add( json_encode( $response , JSON_UNESCAPED_UNICODE) );
		echo $res->send(); 
	}

	public function editAction( $req, $res ){
		$entity_data = $req->data;
		$id = $req->params["id"];
		unset( $entity_data["_RAW_HTTP_DATA"]);
		$entity = $this->mapper->where(["id"=>$id])->first();
		foreach ($entity_data as $key => $value) {
			if( isset( $entity->{$key} ) ){
				$entity->{$key} = $value;
			}
		}
		$this->mapper->update($entity);
	}

	public function deleteAction( $req, $res ){
		$id = $req->params["id"];
		$delete = $this->mapper->delete(["id"=>$id]);
		$response = new \stdClass();
		$response->msg = ( $delete != 0 ) ? "Eliminado" : "No existe el elemento" ;
		$res->add( json_encode( $response , JSON_UNESCAPED_UNICODE) );
		echo $res->send(); 
	}

	public function addAction( $req, $res ){
		$entity = json_decode( $req->data["_RAW_HTTP_DATA"] , true );
		$entity = $this->mapper->create($entity[$this->response_name]);
		$response = new \stdClass();
		$response->{$this->response_name} = $entity;
		$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
		$res->add( json_encode( $response , JSON_UNESCAPED_UNICODE) );
		echo $res->send(); 
	}

	public function allAction( $req, $res ){

		$data = $this->mapper->select()->toArray();

		$response = new \stdClass();
		$response->{$this->response_name} = $data;

		$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
		$res->add( json_encode( $response , JSON_UNESCAPED_UNICODE) );
		echo $res->send(); 

	}

}