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
    $characterName      = $row['name'];
    $currMotivation     = $row['currMotivation'];
    $maxMotivation      = $row['maxMotivation'];
    $currPride          = $row['currPride'];
    $maxPride           = $row['maxPride'];
    $currBattle         = $row['currBattle'];
    $maxBattle          = $row['maxBattle'];
    $cash               = $row['cash'];
    $gradeLevel         = $row['gradeLevel'];
    $motivationTimer    = $row['motivationTimer'];
    $prideTimer         = $row['prideTimer'];
    $battleTimer        = $row['battleTimer'];

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
    
    // Calculate time since last action
    $motivationTime = $time - $motivationTimer;
    $prideTime = $time - $prideTimer;
    $battleTime = $time - $battleTimer;
    //$idleTime = $time - $lastAction;
    //$offsetTime = ($time - $lastAction) % $RT;
    
    // Calculate stat replenishment
    $currMotivation = min($currMotivation + floor($motivationTime/$RT),$maxMotivation);
    $currPride = min($currPride + floor($prideTime/$RT),$maxPride);
    $currBattle = min($currBattle + floor($battleTime/$RT),$maxBattle);
    
    // Calculate time left after stat replenishment
    $motivationTime %= $RT;
    $prideTime %= $RT;
    $battleTime %= $RT;
    
    // Set time left to -1 if stat is full
    if ($currMotivation == $maxMotivation)
      $motivationTime = -1;
    if ($currPride == $maxPride)
      $prideTime = -1;
    if ($currBattle == $maxBattle)
      $battleTime = -1;
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
<motivationTime>$motivationTime</motivationTime>
<prideTime>$prideTime</prideTime>
<battleTime>$battleTime</battleTime>
</stats>
_HTML;

  mysql_close($db_server);
?>
