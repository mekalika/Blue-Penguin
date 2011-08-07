<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    
    // Get grade level from playerID.
    $query = "SELECT gradeLevel from accounts,characters WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $gradeLevel = mysql_result($result, 0);
    
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
    echo <<<_HTML
<table id="traits">
  <tr>
    <th>School Name</th>
    <th>Friends Required</th>
    <th>Description</th>
  </tr>
_HTML;
    $alt = 1;  // Determines table row color.
    while($row = mysql_fetch_array($result)) {
      $schoolID         = $row['schoolID'];
      $schoolName       = $row['schoolName'];
      $friendsReq       = $row['friendsReq'];
      $schoolType	= $row['schoolType'];
      $description 	= $row['description'];
      
      if ($alt % 2 == 1) {
        echo <<<_HTML
<tr>
  <td>$schoolName</td>
  <td>$friendsReq</td>
  <td>$description</td>
</tr>
_HTML;
      }
      else {
        echo <<<_HTML
 <tr class="alt">
   <td>$schoolName</td>
   <td>$friendsReq</td>
   <td>$description</td>
 </tr>
_HTML;
      }
      $alt++; 
    }
    echo "</table></br><br>";
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>
