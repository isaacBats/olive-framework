<?php 


/**
*
* 
*/

class Plain extends Luna\Controller
{	
	public function home( $req , $res ){
		
		echo $this->rview($res);
	}

}