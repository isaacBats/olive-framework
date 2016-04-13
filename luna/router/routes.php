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
	  'post'      => array('Country', 'editAction'),
	  'delete'      => array('Country', 'deleteAction')
	));
	$router->addRoute(array(
	  'path'     => '/country',
	  'post'      => array('Country', 'addAction'),
	  'get'      => array('Country', 'allAction')
	));

?>