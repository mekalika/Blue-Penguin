<?php // signon.php
// Copyright 2011 M.G.Twice. All Rights Reserved.

  // Log in to MySQL.
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) &&
      isset($_POST['password'])) {
    $playerID           = get_post('playerID');
    $user_password      = get_post('password');

    $query = "SELECT * FROM accounts WHERE playerID='$playerID'";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $password = $row['password'];
    if ($user_password == $password) {
      $_SESSION['playerID'] = $playerID;
      header( 'Location: main.php' );
    }
  }

  /*
  require_once 'php-sdk/facebook.php';
  $fb_creds = array(
    'appId' => '404296149675647',
    'secret' => '79f9f4a19297ea45092704fcd4dd592b',
  );
  $facebook = new Facebook($fb_creds);
  $user_id = $facebook->getUser();

  // Check if user is logged in
  if ($user_id) {
    try {
      // Logged in, set playerID
      $user_info = $facebook->api('/me','GET');
      $_SESSION['playerID'] = $user_info['id'];
      echo "Id: " . $user_info['id'];

      // Check if character is created
      $playerID = $_SESSION['playerID'];
      $query = "SELECT * FROM accounts WHERE playerID=$playerID";
      $result = queryMysql($query);
      if (mysql_num_rows($result) == 0) {
        // No character found, go to character creation page
        header('Location: create_char_page.php');
      } else {
        header('Location: main.php');
      }
    } catch (FacebookApiException $e) {
      // User is logged out but session is still active
      $login_url = $facebook->getLoginUrl(array('redirect_uri' => 'https://apps.facebook.com/tigermomgame/signon.php'));
      echo '<div><script>top.location.href="' . $login_url . '"</script></div>';
    }
  } else {
    // User is logged out, redirect them to log in again
    $login_url = $facebook->getLoginUrl(array('redirect_uri' => 'https://apps.facebook.com/tigermomgame/signon.php'));
    echo '<div><script>top.location.href="' . $login_url . '"</script></div>';
  }
  */

  echo <<<_HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
 <head>
 <title>Sign-On Form</title>
  <link rel="stylesheet" href="styles/style.css" />
 </head>
<body>
<form action="signon.php" method="post"><pre>
<table border="0">
  <tr>
    <td width="200"><div align="right">Username:&nbsp;</div></td>
    <td width="100"><input size="20" type="text" name="playerID"/></td>
  </tr>
  <tr>
    <td width="200"><div align="right">Password:&nbsp;</div></td>
    <td width="100"><input size="20" type="password" name="password"/>
  </tr>
  <tr>
    <td width="200"><div align="right"></div></td>
    <td width="100"><input size="20" type="submit" value="Login"/>
  </tr>
</pre></form>
</body>
</html>
_HTML;

  mysql_close($db_server);
?>
