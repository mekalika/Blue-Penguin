<?php // enroll_school.php
// Copyright 2011 Bearslug. All Rights Reserved.

/*
 * @fileoverview: Enrolls given student at a given school.
 */
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) && isset($_POST['schoolID']) &&
      time() < $termEnd && time() > $termStart)
  {
    $playerID = sanitizeString($_POST['playerID']);
    $schoolID = sanitizeString($_POST['schoolID']);

    $query = "SELECT studentID from accounts WHERE playerID=$playerID";
    $result = queryMysql($query);
    $studentID = mysql_result($result, 0);

    $query = "UPDATE charschool SET schoolID=$schoolID " .
             "WHERE studentID=$studentID";
    queryMysql($query);
  }

  mysql_close($db_server);
?>
