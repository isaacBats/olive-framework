<?php 

// namespace Olive\controllers;

use Olive\controllers\Controller;

class Plain extends Controller
{	
	public function home( $req , $res ){		
		return $this->renderView($res, 'Plain.home', ['saludo' => 'Hello, how are you?', 'nombres' => ['Daniel', 'Adan', 'Juan']]);
	}

}