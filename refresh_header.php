<?php // header.php
// Copyright 2011 M.G.Twice. All Rights Reserved.

/**
  * @fileoverview: Fills in the ID card and the Site Nav.
  */

  require_once 'botm_functions.php';
  session_start();
  
  $time = time();
 
  if(isset($_SESSION['playerID'])) {
    // Determine studentID from playerID.
    $playerID = $_SESSION['playerID'];
    $query = "SELECT * FROM accounts WHERE playerID='$playerID'";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $studentID = $row['studentID'];

    // Get character information. 
    $query = "SELECT * FROM characters WHERE studentID='$studentID'";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $characterName          = $row['name'];
    $currMotivation         = $row['currMotivation'];
    $maxMotivation          = $row['maxMotivation'];
    $currPride              = $row['currPride'];
    $maxPride               = $row['maxPride'];
    $cash                   = $row['cash'];
    $gradeLevel             = $row['gradeLevel'];

    // Determine what to print on ID card based on gradeLevel.
    if ($gradeLevel == -1) {
      $gradeString = 'Preschool';
    }
    elseif ($gradeLevel == 0) {
      $gradeString = 'Kindergarten';
    }
    else {
      $gradeString = 'Grade: ' . "$gradeLevel";
    }
  }
  else {
    header( 'Location: logout.php' );
  }

  header('Content-Type: text/xml');
  echo <<<_HTML
<?xml version="1.0" encoding="UTF-8"?>
<stats>
<currmotivation>$currMotivation</currmotivation>
<maxmotivation>$maxMotivation</maxmotivation>
<currpride>$currPride</currpride>
<maxpride>$maxPride</maxpride>
<cash>$cash</cash>
<gradestring>$gradeString</gradestring>
</stats>
_HTML;

  mysql_close($db_server);
?>
