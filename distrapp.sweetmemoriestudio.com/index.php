<?php

ini_set('display_errors', '1');
include 'config/config.php';

//include 'localhost\proyectoInicioSesion\controllers\IndexController.php';
function __autoload($resource) {
    if (is_readable(ROOT . 'config' . DS . $resource . '.php')) {
        include ROOT . 'config' . DS . $resource . '.php';
    }
}

try {

    $r = new Request();
    $db = new Database();
    $singleton = Singleton::getInstance();
    $singleton->db = $db;
    $singleton->r = $r;
    new Boot($singleton->r);
} catch (Exception $e) {
    var_dump($e);
}
echo "prueba";

//use Facebook\FacebookSession;
//use Facebook\FacebookRedirectLoginHelper;
//use Facebook\FacebookRequest;
//use Facebook\FacebookResponse;
//use Facebook\FacebookSDKException;
//use Facebook\FacebookRequestException;
//use Facebook\FacebookAuthorizationException;
//use Facebook\GraphObject;
//include_once './config/fbApi/src/Facebook/FacebookResponse.php';
//include './config/fbApi/src/Facebook/autoload.php';
//use Facebook;
//require './config/';
//include 'config/fbApi/src/Facebook/Url/FacebookUrlManipulator.php';
//include 'config/fbApi/src/Facebook/PersistentData/PersistentDataInterface.php';
//include 'config/fbApi/src/Facebook/PersistentData/FacebookSessionPersistentDataHandler.php';
//include 'config/fbApi/src/Facebook/Url/UrlDetectionInterface.php';
//include 'config/fbApi/src/Facebook/Url/FacebookUrlDetectionHandler.php';
//include 'config/fbApi/src/Facebook/PseudoRandomString/PseudoRandomStringGeneratorInterface.php';
//include 'config/fbApi/src/Facebook/PseudoRandomString/PseudoRandomStringGeneratorTrait.php';
//include 'config/fbApi/src/Facebook/PseudoRandomString/McryptPseudoRandomStringGenerator.php';
//include 'config/fbApi/src/Facebook/Exceptions/FacebookSDKException.php';
//include 'config/fbApi/src/Facebook/Helpers/FacebookRedirectLoginHelper.php';
//include 'config/fbApi/src/Facebook/Authentication/OAuth2Client.php';
//include 'config/fbApi/src/Facebook/Facebook.php';
//include 'config/fbApi/src/Facebook/Http/RequestBodyInterface.php';
//include 'config/fbApi/src/Facebook/Http/RequestBodyUrlEncoded.php';
//include 'config/fbApi/src/Facebook/FacebookRequest.php';
//include 'config/fbApi/src/Facebook/Authentication/AccessToken.php'; 
//include 'config/fbApi/src/Facebook/FacebookApp.php';
////include 'config/fbApi/src/Facebook/FacebookResponse.php';
//
//include 'config/fbApi/src/Facebook/FacebookClient.php';
//include 'config/fbApi/src/Facebook/HttpClients/FacebookHttpClientInterface.php';
//include 'config/fbApi/src/Facebook/HttpClients/FacebookCurl.php';
//include 'config/fbApi/src/Facebook/Http/GraphRawResponse.php';
//include 'config/fbApi/src/Facebook/HttpClients/FacebookCurlHttpClient.php';
//new \Facebook\Facebook;

$appId = "1681772598704166";
$appSecret = "4b6804fc91280077edf58ebb3a55a4e2";
$returnUrl = "http://distrapp.sweetmemoriestudio.com/";

require './config/fbApi/facebook.php';

$facebook = new Facebook(array(
    'appId' => $appId,
    'secret' => $appSecret
        ));


if ($facebook->getUser() == 0) {
    $loginUrl = $facebook->getLoginUrl(array(
        "scope" => 'user_managed_groups,publish_actions'
//        "http://distrapp.sweetmemoriestudio.com/" => 'user_groups,manage_pages,publish_actions,publish_stream'
    ));

//    -----echo "<a href = '$loginUrl'>Login with facebook</a>";
} else {

//    $groups = $facebook->api('me/feed');
////    $id = $groups["data"][0]["id"];
//    $id = $groups["data"];
//    var_dump($facebook);
//    $api = $facebook->api($id . '/feed', 'POST', array(
////        "link" => 'cyberfreax.com',
//        "link" => $returnUrl,
//        "message" => 'Check This Out !'
//    ));

    //posting to pages

//    $pages = $facebook->api('me/accounts');
//    $id = $pages[data][0][id];
//    $token = $pages[data][0][access_token];
//    $api = $facebook->api($id . '', 'POST', array(
//        access_token => $token,
//        link => 'cyberfreax.com',
//        message => 'Check This Out !'
//    ));

    //posting to profile
    $api = $facebook->api('me/feed', 'POST', array(
        "link" => $returnUrl,
        "message" => 'Se ha perdido un objeto!'
    ));

    //displaying logout link
    echo "<br><a href = 'index/logout'>Logout</a>";
}
//////////
/*///
  //$permissions="manage_pages,publish_streams";
  //$permissions=["manage_pages","publish_stream"];
  $permissions = ["user_groups","user_managed_groups","manage_pages", "publish_actions", "publish_pages"];
  $facebook = new \Facebook\Facebook(array(
  'app_id' => $appId,
  'app_secret' => $appSecret
  ));

  $helper = $facebook->getRedirectLoginHelper();
  //var_dump($helper );
  $accessToken=null;
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
  }
  echo "<hr/>";
  if (isset($accessToken)) {
  var_dump($accessToken);
  }
  echo "<hr/>";

  //$permissions = ['email', 'user_likes']; // optional
  $loginUrl = $helper->getLoginUrl('http://distrapp.sweetmemoriestudio.com/', $permissions);

  echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

  //var_dump($helper );
  //var_dump($facebook);
  //$fRequest=new \Facebook\FacebookRequest($facebook->getApp());
  //$fRequest->getAccessToken();
  //var_dump($fRequest);
 * 
 */
?>
