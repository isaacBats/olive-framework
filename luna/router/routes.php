<?php
	

	/**
	 * Home of the website
	 */
	$router->addRoute(array(
	  'path'     => '/',
	  'get'      => array('Plain', 'home')
	));

	/**
	 * Upload for images
	 */
	$router->addRoute(array(
	  'path'     => '/image/upload',
	  'get'      => array('Image', 'upload'),
	  'post'      => array('Image', 'upload'),
	));


?>