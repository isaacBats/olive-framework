<?php
	//  BaseMiddleware by Luna for CORS see usage on class
	require_once (__DIR__."/../CORS.php");
	require_once (__DIR__."/../Blade.php");
	//require_once (__DIR__."/../oauth.php");
	require_once (__DIR__."/../migrator.php");
	require_once (__DIR__."/../documentor.php");
	require_once (__DIR__."/../SessionLogin.php");
	require_once (__DIR__."/../FacebookLogin.php");

	
	//  REQUIRE MODELS
	foreach( scandir( __OLIVE__.'/src/models' ) as $model ){
		$bffmodel = explode("." , $model);
		if( end( $bffmodel ) == "php" ){
			require_once( __OLIVE__.'/src/models/'.$model );
		}
	}

	//  REQUIRE CONTROLLERS
	require_once( __OLIVE__.'/src/controllers/Controller.php' );

	//  START ROUTER
	$router = new \Zaphpa\Router();
	
	//  ATTACHS
	//$router->attach('\Luna\OAuth' );
	$router->attach('\config\CORS', '*');
	$router->attach('\config\Migrator');
	$router->attach('\config\Blade');
	$router->attach('\config\AutoDocumentator', '/apidocs' , $details = true);
	$router->attach('\config\FacebookLogin');
	$router->attach('\config\SessionLogin');

	//  ROUTES
	require_once( __OLIVE__.'/config/router/routes.php' );
	try {
	  $router->route();
	} catch ( \Zaphpa\Exceptions\InvalidPathException $ex) {
	  header("Content-Type: application/json;", TRUE, 404);
	  $out = array("error" => "not found");
	  die(json_encode($out));
	}     


?>