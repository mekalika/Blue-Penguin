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
    $password           = $row['password'];
  }
  if ($user_password == $password) {
    session_start();
    $_SESSION['playerID'] = $playerID;
    header( 'Location: main.php' );
  }

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
    
  function get_post($var) {
    return mysql_real_escape_string($_POST[$var]);
  }
?>
