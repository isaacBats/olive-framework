<?php

namespace config;

/**
 * Class Para manupular el login de usuarios
 * @package config
 *
 * Usage:
 * 
 * $router->attach('\Luna\SessionLogin');
 *     
 * 
 */

class SessionLogin extends \Zaphpa\BaseMiddleware {


  function preprocess(&$router) {
    $router->addRoute(array(
      'path'     => '/login',
      'get'      => array('User','login'),
      'post'      => array('User','login')
    ));
    $router->addRoute(array(
      'path'     => '/logout',
      'get'      => array('User','logout')
    ));
  }


  public function preroute(&$req, &$res) {

    $redirect_after_login = "/";

    //  URL's Autorizadas
    $allow_uri = [
        "/login" , 
        "/logout",
        "/migrate/up" ,
        "/migrate/data" ,
        "/" ,
        ''];

    global $spot;
    $usersMapper = $spot->mapper("Entity\User");

    global $session_handle;
    $session = $session_handle->getSegment('Luna\Session');
    
    
    if( array_search(self::$context["pattern"] , $allow_uri ) === false ){
        if( !$session->get( "user" , false) ){
            header("Location: http://".$_SERVER["SERVER_NAME"]."/login?redirect=".self::$context["request_uri"]);
        }else{
          //  IF USUER IS LOGGED IN
          $req->user = $session->get( "user" );
          $allow = true;

          if( !$allow ){
            header("Content-Type: application/json;", TRUE, 404);
            $out = array("error" => "not allow");
            die( json_encode($out) );
          }

        }

    }

    if( self::$context["request_uri"] == '/login'  ){
        if( $session->get( "user" , false) ){
            header("Location: http://".$_SERVER["SERVER_NAME"].$redirect_after_login);
        }
        if( isset( $req->data["username"] ) ){
            
            $username = $req->data["username"];
            $password = $req->data["password"];

            $user = $usersMapper->where(["email" => $username]);
            if( $user->first() ){
                if( $user->first()->password === md5($password)){

                    $user = $user->select()->with("detail")->first()->toArray();
                    $session->set( "user" , $user );
                    
                    if(isset($req->data["redirect"] )){
                        header("Location: http://".$_SERVER["SERVER_NAME"].$req->data["redirect"]);
                    }else{
                        header("Location: http://".$_SERVER["SERVER_NAME"].$redirect_after_login);
                    }
                    
                }else{
                   $session_controller = $session_handle->getSegment('Luna\Controllers');
                   $session_controller->setFlash("alert", ["message" => "El password y el usuario no coinciden!", "status" => "Error", "class" => "error"]);
                }
            }else{
                $session_controller = $session_handle->getSegment('Luna\Controllers');
                $session_controller->setFlash("alert", ["message" => "El password y el usuario no coinciden!", "status" => "Error", "class" => "error"]);
            }
        }
    }

    if( self::$context["request_uri"] == '/logout'  ){
        $session_handle->destroy();
    }
    
  }

  function prerender( &$buffer ) {


  }


}
?>