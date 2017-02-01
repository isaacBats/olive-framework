<?php

namespace config;
use Facebook;

/**
 * Class Para manupular el login de usuarios con facebook
 * @package Luna
 *
 * Usage:
 * 
 * $router->attach('\Luna\FacebookLogin');
 *     
 * 
 */

class FacebookLogin extends \Zaphpa\BaseMiddleware {


  function preprocess(&$router) {
    $router->addRoute(array(
      'path'     => '/facebook-credentials',
      'get'      => array('\Luna\FacebookLogin','register')
    ));
  }

  public function register( $req ){

    $fb = new Facebook\Facebook([
      'app_id' => '867418723383590',
      'app_secret' => 'a0fd209505eb923a0e86b71d286736c2',
      'default_graph_version' => 'v2.5',
    ]);
    
    $helper = $fb->getJavaScriptHelper();
    try {
      $accessToken = $helper->getAccessToken();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;

    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    $fb->setDefaultAccessToken($accessToken);
    try {
      $response = $fb->get('/me?fields=name,email,id,gender,birthday,picture&width=180&height=180&redirect=false');
      $userNode = $response->getGraphUser();

    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    //  if the user is register on the system only login
    if( $this->checkUser( $userNode->getId() ) ){
      if(isset($req->data["redirect"] )){
          header("Location: http://".$_SERVER["SERVER_NAME"].$req->data["redirect"]);
      }else{
        header("Location: /");
      }
      exit;
    }else{
      if( !isset( $req->data["register"] ) ){
        global $session_handle;
        $session = $session_handle->getSegment('Luna\Controllers');
        $session->set( "facebook" , $userNode->asArray() );
        header("Location: /user/register");
        exit;
      }
    }

    
    $oAuth2Client = $fb->getOAuth2Client();
    if (! $accessToken->isLongLived()) {
      try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
      } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
        exit;
      }
      
    }

    $fb->setDefaultAccessToken($accessToken);
    $response = $fb->get('/me?fields=name,email,id,gender,birthday,picture&width=180&height=180&redirect=false');
    $userNode = $response->getGraphUser();

    $user_facebook = $userNode->asArray();

    global $spot;
    $UMapper = $spot->mapper("Entity\User");
    $UDMapper = $spot->mapper("Entity\UserDetails");

    global $session_handle;
    $session = $session_handle->getSegment('Luna\Session');

    $user = $UMapper->build([
            'email'         => $user_facebook["email"],
            'email_validated'  => 1,
            'password'         => '',
            'name'         => $user_facebook["name"],
            'type_user'         => 'user',
            'facebook_id'         => $user_facebook["id"],
            'facebook_token'         => $accessToken,
        ]);
    $UMapper->save( $user );

    
    $ext = pathinfo($user_facebook["picture"]["url"], PATHINFO_EXTENSION);
    $ext = explode("?" , $ext)[0];
    $img = __ASSETS__."profile_pic/".$user_facebook["id"].".".$ext;
    $img_name = $user_facebook["id"].".".$ext;
    file_put_contents($img, file_get_contents($user_facebook["picture"]["url"]));


    $user_details = $UDMapper->build([
            'user_id'           => $user->id,
            'gender'           => $user_facebook["gender"],
            'avatar'       => $img_name
        ]);
    $UDMapper->save( $user_details );

    if( $this->checkUser( $userNode->getId() ) ){
      header("Location: /");
    }
  }


  public function checkUser( $id ){
    global $spot;
    $usersMapper = $spot->mapper("Entity\User");
    global $session_handle;
    $session = $session_handle->getSegment('Luna\Session');

    if( !$session->get( "user" , false) ){
        $user = $usersMapper->select()->with("detail")->where(["facebook_id" => $id ])->first();
        if( $user ){
          $session->set( "user" , $user->toArray() );
          return true; 
        }else{
          return false;
        }
        
    }

    return false;
  }

  function prerender( &$buffer ) {


  }


}
?>