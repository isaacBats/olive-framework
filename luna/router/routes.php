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


	/**
	 * Country API
	 */
	$router->addRoute(array(
	  'path'     => '/country/{id}',
	  'get'      => array('Country', 'getAction'),
	  'post'      => array('Country', 'editAction'),		//TERMINADA
	  'delete'      => array('Country', 'deleteAction')		//TERMINADA
	));
	$router->addRoute(array(
	  'path'     => '/country',
	  'post'      => array('Country', 'addAction'), 		// TERMINADA
	  'get'      => array('Country', 'allAction')			//TERMINADA
	));

?>