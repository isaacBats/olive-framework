<?php 
	// // TRACER
	$whoops = new \Whoops\Run;
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();

	//  ROOT DIRECTORY
	define('__LUNA__',  __DIR__."/.." );
	define('__ASSETS__',  __DIR__."/../assets/" );

	$cfg = new \Spot\Config();
	$cfg->addConnection('mysql', [
	    'dbname' => 'cotizador',
	    'user' => 'root',
	    'password' => 'root',
	    'host' => 'localhost',
	    'driver' => 'pdo_mysql',
	]);

	global $spot;
	$spot = new \Spot\Locator($cfg);

	global $imageMannager;
	$imageMannager = new \Intervention\Image\ImageManager(array('driver' => 'imagick'));

	if( !isset($_SESSION)){session_start();}
	$aura_session = new \Aura\Session\SessionFactory;
	global $session_handle;
    $session_handle = $aura_session->newInstance($_SESSION);

	// LANG  MANNAGER
	// TODO: Pass to middleware
	$lang = isset($_GET["lang"])?$_GET["lang"]:"es";
	if( str_replace( "/".$lang ,"",$_SERVER["REQUEST_URI"] ) != $_SERVER["REQUEST_URI"] ){
		$_SERVER["REQUEST_URI"] = substr( $_SERVER["REQUEST_URI"], 3 );	
	}

?>