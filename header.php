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
    $lastAction         = $row['lastAction'];
    $motivationTimer    = $row['motivationTimer'];
    $prideTimer         = $row['prideTimer'];
    $battleTimer        = $row['battleTimer'];
    
    // Update lastAction timestamp
    $query = "UPDATE characters SET lastAction=$time WHERE studentID=$studentID";
    $result = queryMysql($query);

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
  
  // Calculate time since last action
  $motivationTime = $time - $motivationTimer;
  $prideTime = $time - $prideTimer;
  $battleTime = $time - $battleTimer;
  $idleTime = $time - $lastAction;
  $offsetTime = ($time - $lastAction) % $RT;
  
  // Calculate stat replenishment
  $currMotivation = min($currMotivation + floor($motivationTime/$RT),$maxMotivation);
  $currPride = min($currPride + floor($prideTime/$RT),$maxPride);
  $currBattle = min($currBattle + floor($battleTime/$RT),$maxBattle);
  
  // Calculate time left after stat replenishment
  $motivationTime %= $RT;
  $prideTime %= $RT;
  $battleTime %= $RT;

  echo <<<_HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
 <head>
  <title>Battle of the Tiger Moms</title>
  <link rel="stylesheet" href="styles/style.css">
 </head>
<div id="container">
<body>

<!-- ID Card -->
<div class="topbar">
<img src="images/harvard_logo.jpg">
<div class="cssbox"> 
<div class="cssbox_head"><h2 align="left">$characterName</h2></div> 
<div class="cssbox_body">  
<ul class = "stats">
  <li>Motivation: <span id="currMotivation">$currMotivation</span>/<span id="maxMotivation">$maxMotivation</span> <span id="motivationTimer" title=$motivationTime>a</span> <span id="motivationTime">$motivationTime</span>
  <li>Pride: <span id="currPride">$currPride</span>/<span id="maxPride">$maxPride</span> <span id="prideTimer" title=$prideTime>a</span> <span id="prideTime">$prideTime</span>
  <li> Battle: <span id="currBattle">$currBattle</span>/<span id="maxBattle">$maxBattle</span> <span id="battleTimer" title=$battleTime>a</span> <span id="battleTime">$battleTime</span>
  <li>Cash: $<span id="cash">$cash</span>
</ul>
<!-- TODO: District is based on friends. -->
<pre>District: 27	<span id="gradeString">$gradeString</span></pre></div>
</div>

<!-- Site navigation menu -->
<ul id="nav">
  <li><a href="main.php">Home</a>
  <li><a href="events.php">Events</a>
    <ul>
      <li><a href="life.html">Life</a>
      <li><a href="academics.html">Academics</a>
      <li><a href="events.php">Electives</a>
    </ul>
  <li><a href="shop.php">Shop</a>
  <li><a href="compete.html">Compete</a>
  <li><a href="reportcard.php">Stats</a>
    <ul>
      <li><a href="reportcard.php">Report Card</a>
      <li><a href="items.php">My Items</a>
      <li><a href="traits.php">My Traits</a>
      <li><a href="school.php">School</a>
    </ul>
  <li><a href="district.html">District</a>
</ul>
</div>
<script type="text/javascript" src="timer.js"></script>
_HTML;
?>
