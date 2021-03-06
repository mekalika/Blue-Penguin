<?php // get_schools.php
// Copyright 2011 Bearslug. All Rights Reserved.

/**
  * @fileoverview: gets HTML code for the Schools table based on the character.
  */

  require_once 'botm_functions.php';
  require_once 'php-sdk/facebook.php';
  $fb_creds = array(
    'appId' => '404296149675647',
    'secret' => '79f9f4a19297ea45092704fcd4dd592b',
  );
  $facebook = new Facebook($fb_creds);
  $user_id = $facebook->getUser();

  session_start();

  if (isset($_POST['playerID']))
  {
    $playerID = sanitizeString($_POST['playerID']);

    // Get grade level from playerID.
    $query = "SELECT characters.studentID from accounts,characters WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $studentID = $row['studentID'];
    $gradeLevel = getGrade();

    // Get current school.
    $query = "SELECT schoolID from charschool WHERE studentID=$studentID";
    $result = queryMysql($query);
    $currSchoolID = mysql_result($result, 0);

    // Determine schoolType based on grade.
    if ($gradeLevel == -1) {
      $schoolType = 'Preschool';
    }
    elseif ($gradeLevel > -1 && $gradeLevel < 6) {
      $schoolType = 'Elementary';
    }
    elseif ($gradeLevel >= 6 && $gradeLevel < 9) {
      $schoolType = 'Middle';
    }
    else {
      $schoolType = 'High';
    }

    $query = "SELECT * FROM schools WHERE schoolType='$schoolType'";
    $result = queryMysql($query);
    $numFriends = 0;  // TODO: Change this once integrated to Facebook
    $friends = $facebook->api('/209275/friends','GET',array('fields' => 'installed'));
    foreach ($friends["data"] as $value) {
      if ($value["installed"]) {
        $numFriends++;
      }
    }
    echo <<<_HTML
<table id="traits">
  <tr>
    <th>School Name</th>
    <th>Friends Required</th>
    <th>Description</th>
    <th></th>
  </tr>
_HTML;
    $alt = 1;  // Determines table row color.
    while($row = mysql_fetch_array($result)) {
      $schoolID         = $row['schoolID'];
      $schoolName       = $row['schoolName'];
      $friendsReq       = $row['friendsReq'];
      $schoolType	= $row['schoolType'];
      $description 	= $row['description'];

     // Print out the Schools table! Alternates colors and has a color for
     // current school.
      if ($alt % 2 == 1) {
        if ($currSchoolID == $schoolID) {
          echo <<<_HTML
<tr class="selected">
_HTML;
        }
        else {
          echo <<<_HTML
<tr>
_HTML;
        }
      echo <<<_HTML
  <td>$schoolName</td>
  <td>$friendsReq</td>
  <td>$description</td>
_HTML;
        if ($numFriends >= $friendsReq && $currSchoolID != $schoolID) {
          echo <<<_HTML
  <td><input type="button" value="Enroll!" onClick="enrollSchool($playerID,$schoolID)"></td>
</tr>
_HTML;
        }
        elseif ($currSchoolID == $schoolID) {
          echo <<<_HTML
  <td>Enrolled</td>
</tr>
_HTML;
        }
        else {
          echo <<<_HTML
  <td>Need $friendsReq friends</td>
</tr>
_HTML;
        }
      }
      else {  // Alternate color
        if ($currSchoolID == $schoolID) {
          echo <<<_HTML
<tr class="selected">
_HTML;
        }
        else {
          echo <<<_HTML
<tr class="alt">
_HTML;
        }
        echo <<<_HTML
   <td>$schoolName</td>
   <td>$friendsReq</td>
   <td>$description</td>
_HTML;
        if ($numFriends >= $friendsReq && $currSchoolID != $schoolID) {
          echo <<<_HTML
  <td><input type="button" value="Enroll!" onClick="enrollSchool($playerID,$schoolID)"></td>
</tr>
_HTML;
        }
        elseif ($currSchoolID == $schoolID) {
          echo <<<_HTML
  <td>Enrolled</td>
</tr>
_HTML;
        }
        else {
          echo <<<_HTML
  <td>Need $friendsReq friends</td>
</tr>
_HTML;
        }
      }
      $alt++;
    }
    echo "</table></br>";
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>
