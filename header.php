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

  echo <<<_HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
 <head>
  <title>Battle of the Tiger Moms</title>
  <link rel="stylesheet" href="styles/style.css">
 </head>
<body>

<!-- ID Card -->
<div class="topbar">
<div class="cssbox"> 
<div class="cssbox_head"><h2 align="left">$characterName</h2></div> 
<div class="cssbox_body">  
<ul class = "stats">
  <li>Motivation: $currMotivation/$maxMotivation
  <li>Pride: $currPride/$maxPride
  <li>Cash: $$cash
</ul>
<!-- TODO: District is based on friends. -->
<pre>District: 27	$gradeString</pre></div>
</div>

<!-- Site navigation menu -->
<ul class="navbar">
  <li><a href="main.php">Home</a>
  <li><a href="events.php">Events</a>
  <li><a href="shop.html">Shop</a>
  <li><a href="compete.html">Compete</a>
  <li><a href="reportcard.html">Stats</a>
  <li><a href="district.html">District</a>
</ul>
</div>
_HTML;
?>
