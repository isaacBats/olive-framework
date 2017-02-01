<?php 

// namespace Olive\controllers;

use Olive\controllers\Controller;

class Plain extends Controller
{	
	public function home( $req , $res ){
		
		echo $this->renderWiew($res);
	}

}