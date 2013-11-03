<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('php-sdk/facebook.php');

  $config = array(
    'appId' => '404296149675647',
    'secret' => '79f9f4a19297ea45092704fcd4dd592b',
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
?>
<html>
  <head></head>
  <body>

  <?php
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/me','GET');
        echo "Name: " . $user_profile['name'] . "<br>";
        echo "Id: " . $user_profile['id'] . "<br>";

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(array('req_perms' => 'email,offline_access','redirect_uri' => 'https://apps.facebook.com/tigermomgame/'));
        $id = $facebook->getAppid();
        $secret = $facebook->getApiSecret();
        //echo 'Please <a href="' . $login_url . '">login.</a>';
        echo "Id: " . $id . "<br>";
        echo "Secret: " . $secret . "<br>";
        //echo '<div><script>top.location.href="' . $login_url . '"</script></div>';
        error_log($e->getType());
        error_log($e->getMessage());
      }
    } else {

      // No user, print a link for the user to login
      //$login_url = $facebook->getLoginUrl(array('req_perms' => 'email,offline_access','redirect_uri' => 'https://apps.facebook.com/tigermomgame/'));
    $login_url = $facebook->getLoginUrl(array('redirect_uri' => 'https://apps.facebook.com/tigermomgame/test.php'));
    $id = $facebook->getAppid();
    $secret = $facebook->getApiSecret();
    $token = $facebook->getAccessToken();
      //echo 'Please <a href="' . $login_url . '">login.</a><br>';
    echo "Id: " . $id . "<br>";
    echo "Secret: " . $secret . "<br>";
    echo "User ID: " . $user_id . "<br>";
    echo "Token: " . $token . "<br>";
    //echo '<div><script>top.location.href="' . $login_url . '"</script></div>';

    $friends = $facebook->api('209275/friends','GET',array('fields' => 'installed'));
    foreach ($friends["data"] as $value) {
      echo $value["id"] . "<br>";
      if ($value["installed"]) {
        echo "true<br>";
      }
    }
    //echo $friends . "<br>";

    $appId = 404296149675647;
     $url = "https://www.facebook.com/dialog/oauth?app_id=" . $appId . "&" . "redirect_uri=http://apps.facebook.com/tigermomgame&" . "scope=email,offline_access";
echo '
<div>
<a href=' . $url . '>Login</a><br>
</div>';
    }
  ?>

  </body>
</html>
