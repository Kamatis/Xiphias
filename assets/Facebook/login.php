<?php
    session_start();
    date_default_timezone_set('Asia/Manila');
    //define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/Facebook/');
    $base_path = '/Library/WebServer/Documents/testFB/';
    require_once($base_path . 'facebook-sdk-v5/autoload.php');
    $fb = new Facebook\Facebook([
      'app_id' => '1017264564980391',
      'app_secret' => '0aa49db7cad39b361543882ddb8d76d4',
      'default_graph_version' => 'v2.3',
      ]);
      
    $server = "127.0.0.1";
	$username = "xiphias";
	$password = "xiphias";
	$database = "xiphiasdb";
	$conn = mysql_connect($server,$username,$password);
	mysql_select_db($database);
	$uid = 1;
	$query = 'select user_id,a_token from access_token where user_id='.$uid;
	$res = mysql_query($query);
	if(mysql_num_rows($res)==0){
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['public_profile,email,publish_actions,user_birthday']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://localhost/testFB/fb-callback.php', $permissions);
    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    } else {
        while($row = mysql_fetch_assoc($res)){
            $token=$row['a_token'];
        }
        $picUrl = "http://images2.fanpop.com/images/photos/5100000/Cute-pups-dogs-5114450-500-309.jpg";  
        $linkData = [
            'link' => $picUrl,
            'message' => 'Test-test',
        ];
        try{
            $response = $fb->post('/me/feed',$linkData,$token);
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
        echo 'Posted with id: ' . $graphNode['id'];
    }
?>