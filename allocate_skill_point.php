<?php // allocate_skill_point.php
// Copyright 2011 Bearslug Entertainment. All Rights Reserved.

/*
 * @fileoverview: Allocates skill point for given student to given trait.
 */
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) && isset($_POST['trait']) &&
      time() < $termEnd && time() > $termStart)
  {
    $playerID = sanitizeString($_POST['playerID']);
    $trait = sanitizeString($_POST['trait']);

    $query = "SELECT studentID from accounts WHERE playerID=$playerID";
    $result = queryMysql($query);
    $studentID = mysql_result($result, 0);

    // Improve trait.
    if ($trait == 'maxPride') {
      $query = "UPDATE characters SET $trait=$trait+10 ".
               "WHERE studentID=$studentID";
      queryMysql($query);
    }
    else {
      $query = "UPDATE characters SET $trait=$trait+1 ".
               "WHERE studentID=$studentID";
      queryMysql($query);
    }

    // Decrement skill points.
    $query = "UPDATE characters SET skillPoints=skillPoints-1 ".
             "WHERE studentID=$studentID";
    queryMysql($query);

  }

  mysql_close($db_server);
?>
