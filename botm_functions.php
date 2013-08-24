<?php //botm_functions.php
  $url=parse_url(getenv("CLEARDB_DATABASE_URL"));
  $db_hostname = $url["host"];
  $db_database = substr($url["path"],1);
  $db_username = $url["user"];
  $db_password = $url["pass"];

  // Define stat replenishment interval to be 3 minutes (180 seconds)
  $RT = 30;

  // Define start of the school term (beginning of current round)
  $termStart = 1376809200;

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

  function getCash($time, $expense) {
    return $termStart;
    //return (floor(($time - $termStart) / 604800));
  }
?>
