<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    $base_path = __DIR__ . '/';
    require_once($base_path . 'facebook-sdk-v5/autoload.php');
    // Connect to Xiphias database
    $server = "127.0.0.1";
	$username = "xiphias";
	$password = "xiphias";
	$database = "xiphiasdb";
	$conn = mysql_connect($server,$username,$password);
	mysql_select_db($database);
	
    use Facebook\FacebookSession;
    use Facebook\FacebookRedirectLoginHelper;
    $fb = new Facebook\Facebook([
      'app_id' => '1017264564980391',
      'app_secret' => '0aa49db7cad39b361543882ddb8d76d4',
      'default_graph_version' => 'v2.3',
    ]);

    $helper = $fb->getRedirectLoginHelper();
    try {
      $accessToken = $helper->getAccessToken();
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
    if (! isset($accessToken)) {
      if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
      } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
    }

    // Logged in
    echo '<h3>Access Token</h3>';
    var_dump($accessToken->getValue());

    // The OAuth 2.0 client handler helps us manage access tokens
    $oAuth2Client = $fb->getOAuth2Client();

    // Get the access token metadata from /debug_token
    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
    echo '<h3>Metadata</h3>';
    var_dump($tokenMetadata);
    if (! $accessToken->isLongLived()) {
      // Exchanges a short-lived access token for a long-lived one
      try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
      } catch (Facebook\Exceptions\FacebookSDKException $e) {
        echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
        exit;
      }
      echo '<h3>Long-lived</h3>';
      var_dump($accessToken->getValue());
    } else {
        echo '<h3>tShe King!</h3>';
    }

//     $_SESSION['fb_access_token'] = (string) $accessToken;
//     echo $_SESSION['fb_access_token'] . '<br>';
    $aToken=file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=1017264564980391&client_secret=0aa49db7cad39b361543882ddb8d76d4&grant_type=fb_exchange_token&%20fb_exchange_token=".$accessToken);
    echo $aToken . '<br>';
    $uid=1;
    $var = substr($aToken,0,strpos($aToken,"&exp"));
    $var = strstr($var,$var[13]);
    $query = 'insert into access_token values ('.$uid.',"'.$var.'",CURDATE());';
    echo $query.'<br>';
    $res = mysql_query($query);
    if($res === false){
        echo 'Fail';
        echo 'Invalid Query: ' . mysql_error() . '<br>';
        }
    else echo 'Good<br> Connected to Facebook!';
    //$fb->setDefaultAccessToken($accessToken);
    // $picUrl = "http://images2.fanpop.com/images/photos/5100000/Cute-pups-dogs-5114450-500-309.jpg";  
//     $linkData = [
//         'link' => $picUrl,
//         'message' => 'Test-test',
//     ];
    /*try{
        $response = $fb->post('/me/feed',$linkData,$accessToken);
    } catch (Facebook\Exceptions\FacebookResponseException $e){
        echo 'Response Exception: ' . $e->getMessage();
        exit;
    } catch (Facebook\Exceptions\FacebookSDKException $e){
        echo 'SDK Exception: ' . $e->getMessage();
        exit;
    } catch (Exception $e){
        echo 'Unknown Exception: ' . $e->getMessage();
        exit;
    }
    $graphNode = $response->getGraphNode();
    echo 'Posted with id: ' . $graphNode['id'];*/
?>