<?php // header.php
// Copyright 2011 Bearslug Games. All Rights Reserved.

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
  
  // Set time left to -1 if stat is full
  if ($currMotivation == $maxMotivation)
    $motivationTime = -1;
  if ($currPride == $maxPride)
    $prideTime = -1;
  if ($currBattle == $maxBattle)
    $battleTime = -1;

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
<div id="topbar">
<img src="images/logo.gif">
<div id="cssbox"> 
<h2 align="left">$characterName</h2> 
<ul class = "stats">
  <li>Motivation: <span id="currMotivation">$currMotivation</span>/<span id="maxMotivation">$maxMotivation</span> <span id="motivationTimer" title=$motivationTime>a</span> <span id="motivationTime">$motivationTime</span>
  <li>Pride: <span id="currPride">$currPride</span>/<span id="maxPride">$maxPride</span> <span id="prideTimer" title=$prideTime>a</span> <span id="prideTime">$prideTime</span>
  <li> Battle: <span id="currBattle">$currBattle</span>/<span id="maxBattle">$maxBattle</span> <span id="battleTimer" title=$battleTime>a</span> <span id="battleTime">$battleTime</span>
  <li>Cash: $<span id="cash">$cash</span>
</ul>
<!-- TODO: District is based on friends. -->
<table width=100%>
  <tr>
    <td>District: 27</td>
    <td>$gradeString</td>
  </tr>
</table>
</div>

<!-- Site navigation menu -->
<ul id="nav">
  <li onMouseOver="document.images['icon_home'].src='images/icon_home1.gif'" onMouseOut="document.images['icon_home'].src='images/icon_home.gif'"><a href="main.php"><img name="icon_home" src="images/icon_home.gif" height=12 width=12/> Home</a>
  <li onMouseOver="document.images['icon_events'].src='images/icon_events1.gif'" onMouseOut="document.images['icon_events'].src='images/icon_events.gif'"><a href="events_academic.php"><img name="icon_events" src="images/icon_events.gif" height=12 width=12/> Events</a>
    <ul>
      <li><a href="events_academic.php">Academic</a>
      <li><a href="events_elective.php">Elective</a>
      <li><a href="events_life.php">Life</a>
    </ul>
  <li onMouseOver="document.images['icon_shop'].src='images/icon_shop1.gif'" onMouseOut="document.images['icon_shop'].src='images/icon_shop.gif'"><a href="shop.php"><img name="icon_shop" src="images/icon_shop.gif" height=12 width=18/> Shop</a>
  <li onMouseOver="document.images['icon_compete'].src='images/icon_compete1.gif'" onMouseOut="document.images['icon_compete'].src='images/icon_compete.gif'"><a href="compete.html"><img name="icon_compete" src="images/icon_compete.gif" height=12 width=14/> Compete</a>
  <li onMouseOver="document.images['icon_stats'].src='images/icon_stats1.gif'" onMouseOut="document.images['icon_stats'].src='images/icon_stats.gif'"><a href="reportcard.php"><img name="icon_stats" src="images/icon_stats.gif" height=12 width=12/> Stats</a>
    <ul>
      <li><a href="reportcard.php">Report Card</a>
      <li><a href="items.php">My Items</a>
      <li><a href="traits.php">My Traits</a>
      <li><a href="school.php">School</a>
    </ul>
  <li onMouseOver="document.images['icon_district'].src='images/icon_district1.gif'" onMouseOut="document.images['icon_district'].src='images/icon_district.gif'"><a href="district.html"><img name="icon_district" src="images/icon_district.gif" height=12 width=12/> District</a>
</ul>
</div>
<script type="text/javascript" src="timer.js"></script>
_HTML;
?>
