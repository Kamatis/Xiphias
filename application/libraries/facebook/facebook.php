<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( session_status() == PHP_SESSION_NONE ) {
  session_start();
}

// Autoload the required files
require_once( APPPATH . 'libraries/facebook/Facebook/autoload.php' );


class Facebook {
  var $ci;
  var $helper;
  var $session;
  var $permissions;
  var $fb;
  var $callback;

  public function __construct() {
    $this->ci =& get_instance();

    // Initialize the SDK
    $this->fb = new Facebook\Facebook([
      'app_id'                  => $this->ci->config->item('app_id', 'facebook'),
      'app_secret'              => $this->ci->config->item('app_secret', 'facebook'),
      'default_graph_version'   => 'v2.4',
    ]);

    // Create the login helper and callback url
    // callback recommended: app domain in the app
    // callback path should be absolute
    $this->helper       = $this->fb->getRedirectLoginHelper();
    $this->permissions  = $this->ci->config->item('permissions', 'facebook');
    $this->callback     = $this->ci->config->item('redirect_url', 'facebook');    
  }

  public function loginUrl() {
    return $this->helper->getLoginUrl( $this->callback, $this->permissions );
  }

  public function accessToken() {
    try {
      $accessToken = $this->$helper->getAccessToken();
      return $accessToken;
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    } catch(Exception $e){
        echo $e->getMessage();
        exit;
    }
  }
  
  public function batchPost($token, $data) {
    $linkData = [
      'link'        => 'localhost/xiphias',
      'message'     => '',
      'caption'     => 'XIPHIAS.COM',
      'description' => $data['description'],
      'picture'     => $data['picture'],
      'name'        => $data['name']
    ];
    
    try {
      $response = $this->fb->post('/me/feed', $linkData, $token);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    
    $graphNode = $response->getGraphNode();
    echo 'Posted with id: ' . $graphNode['id'];
  }
  
  // FUnction in exchanging short-lived tokens
  // * Exchange short-lived tokens for long-lived tokens
  // Note:  Probably won't work on extending expired tokens
  //        Since it gets the previous token from client-side (cookies)
  public function exchangeToken() {
    $jshelper = $this->fb->getJavaScriptHelper();
    try {
      $accessToken = $jshelper->getAccessToken();
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    catch(Exception $e) {
      echo 'Unknown Exception: ' . $e->getMessage();
    }
    
    if(!isset($accessToken)) {
      echo 'No cookie set or no OAuth data could be obtained from cookie.';
      exit;
    }
    
    $oauth2Client = $this->fb->getOAuth2Client();
    
    try{
      $longLivedAccessToken = $oauth2Client->getLongLivedAccessToken($accessToken);
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Error extending short-lived access token: ' . $e->getMessage();
      exit;
    }
    
    // data to be inserted in database;
    $data['access_token']     = $longLivedAccessToken->getValue();
    $data['expiration_date']  = $longLivedAccessToken->getExpiresAt()->format('Y-m-d H:i:s');
    
    
    // Success route
    echo 'Access Token Extended!';
    echo '== Access Token Information ==';
    try {
      echo 'Value: ' . $longLivedAccessToken->getValue() . "\n";
      echo 'Expiration Date: ' . $longLivedAccessToken->getExpiresAt()->format('l, F j, Y H:i A') . "\n";
      echo 'Is Expired?: ' . ($longLivedAccessToken->isExpired() ? 'true' : 'false') . '\n';
      echo 'Is Long Lived?: ' . ($longLivedAccessToken->isLongLived() ? 'true' : 'false') . "\n";
      echo 'Is App Token?: ' . ($longLivedAccessToken->isAppAccessToken() ? 'true' : 'false') . "\n";
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Error getting access token info: ' . $e->getMessage();
      exit;
    }
    
    return $data;
  }
}