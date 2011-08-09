<?php // get_traits.php
// Copyright 2011 Bearslug Entertainment. All Rights Reserved.

/**
  * @fileoverview: gets HTML code for the traits table based on the character.
  */

  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    
    // Get current trait values.
    $query = "SELECT characters.studentID, skillPoints, maxMotivation, maxBattle, maxPride from accounts,characters WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $studentID = $row['studentID'];
    $skillPoints = $row['skillPoints'];
    $maxMotivation = $row['maxMotivation'];
    $maxBattle = $row['maxBattle'];
    $maxPride = $row['maxPride'];

    // Print out the Traits table! Alternates colors. 
    echo <<<_HTML
<font size="2.5" face="verdana, helvetica, arial">Available Skill Points: $skillPoints</font> 
<table id="traits">
  <tr>
    <th>Trait</th>
    <th>Score</th>
    <th>Action</th>
    <th>Description</th>
  </tr>

  <tr>
    <td>Max<br>Motivation</td>
    <td>$maxMotivation</td>
_HTML;
    if ($skillPoints > 0) {
      echo <<<_HTML
    <td><input type="button" value="Increase!" onClick="allocateSkillPoint($playerID,'maxMotivation')"></td>
_HTML;
    }
    else {
      echo <<<_HTML
    <td>Skill points required</td>
_HTML;
    }
    echo <<<_HTML
    <td>More Motivation allows you to push your tiger cub more, participating in more events.</td>
  </tr>
  <tr class="alt">
    <td>Max Battle</td>
    <td>$maxBattle</td>
_HTML;
    if ($skillPoints > 0) {
      echo <<<_HTML
    <td><input type="button" value="Increase!" onClick="allocateSkillPoint($playerID,'maxBattle')"></td>
_HTML;
    }
    else {
      echo <<<_HTML
    <td>Skill points required</td>
_HTML;
    }
    echo <<<_HTML
    <td>The higher your Battle stat, the more often your kid can stand comparisons to all the other tiger cubs!</td>
  </tr>
  <tr>
    <td>Max Pride</td>
    <td>$maxPride</td>
_HTML;
    if ($skillPoints > 0) {
      echo <<<_HTML
    <td><input type="button" value="Increase!" onClick="allocateSkillPoint($playerID,'maxPride')"></td>
_HTML;
    }
    else {
      echo <<<_HTML
    <td>Skill points required</td>
_HTML;
    }
    echo <<<_HTML
    <td>Every time your kid is compared to another, their pride goes down. Higher max pride means they can last longer! [1 skill point = 10 Pride points]</td>
  </tr>
</table><br>
_HTML;
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>
