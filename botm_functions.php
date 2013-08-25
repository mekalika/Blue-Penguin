<?php //botm_functions.php

  // Local login using MAMP
  $db_hostname = 'localhost';
  $db_database = 'botm';
  $db_username = 'sandrew';
  $db_password = 'Burrito8291';

  /*
  // Login using Facebook
  $url=parse_url(getenv("CLEARDB_DATABASE_URL"));
  $db_hostname = $url["host"];
  $db_database = substr($url["path"],1);
  $db_username = $url["user"];
  $db_password = $url["pass"];
  */

  // Define stat replenishment interval to be 3 minutes (180 seconds)
  $RT = 30;

  // Define start of the school term (beginning of current round)
  $termStart = 1377414000;

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

  function weeksPassed() {
  global $termStart;
  $numWeeks = floor((time() - $termStart) / 604800);
  $numWeeks = min($numWeeks, 13);
  $numWeeks = max($numWeeks, 0);
  return $numWeeks;
  }

  function getCash($expense) {
    // Get $20k a week
    return (weeksPassed() + 1) * 20000 - $expense;
  }

  function getGrade() {
    // Grade starts at -1 for preschool
    return weeksPassed() - 1;
  }

?>
