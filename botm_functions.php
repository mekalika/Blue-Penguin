<?php //botm_functions.php
  $db_hostname = 'localhost';
  $db_database = 'botm';
  $db_username = 'sandrew';
  $db_password = 'Burrito8291';
  
  // Define stat replenishment interval to be 3 minutes (180 seconds)
  $RT = 30;
  
  $db_server = mysql_connect($db_hostname, $db_username, $db_password) or die(mysql_error());
  mysql_select_db($db_database) or die(mysql_error());
  
  function queryMysql($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;
  }
  
  function destroySession() {
    $_SESSION = array();

    if (session_id() != "" || isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 2592000, '/');
    }

    session_destroy();
  }

  function sanitizeString($var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
  }
  
  function get_post($var) {
    return mysql_real_escape_string($_POST[$var]);
  }
?>
