<?php // reportcard.php
// Copyright 2011 Bearslug Entertainment. All Rights Reserved.
  require_once 'header.php';
  require_once 'botm_functions.php';

  // TODO: Andrew will make this more awesome.
  function getLevelFromEXP($exp) {
    return floor(($exp / 10) + 1);
  }

  // TODO: Andrew will make this more awesome.
  function getEXPforLevel($level) {
    return ($level * 10) - 10;
  }

  function getGradeString($gradeLevel) {
    // Determine what grade to print.
    if ($gradeLevel == -1) {
      return 'Preschool';
    }
    elseif ($gradeLevel == 0) {
      return 'Kindergarten';
    }
    elseif ($gradeLevel == 9) {
      return 'Freshman (9)';
    }
    elseif ($gradeLevel == 10) {
      return 'Sophomore (10)';
    }
    elseif ($gradeLevel == 11) {
      return 'Junior (11)';
    }
    elseif ($gradeLevel == 12) {
      return 'Senior (12)';
    }
    else {
      return 'Grade: ' . "$gradeLevel";
    }
  }

  function getLetterGrade($percent) {
    // Calculate letter grade
    if ($percent < 60) {
      $letterGrade = 'F';
    }
    elseif ($percent < 70) {
      $letterGrade = 'D';
    }
    elseif ($percent < 80) {
      $letterGrade = 'C';
    }
    elseif ($percent < 90) {
      $letterGrade = 'B';
    }
    elseif ($percent <= 100) {
      $letterGrade = 'A';
    }
    // Determine + or - grade
    if ($letterGrade != 'F' && $percent != 100 && ($percent % 10) < 3) {
      $letterGrade = $letterGrade . '-';
    }
    elseif ($letterGrade != 'F' && ($percent % 10) > 6) {
      $letterGrade = $letterGrade . '+';
    }
    elseif ($percent == 100) {
      $letterGrade = 'A+';
    }
    return $letterGrade;
  }

echo <<<_HTML
<script src="scripts/sliding.js"></script>
<script>
function reportName(studentID) {
  params = "studentID=" + studentID
  request = new ajaxRequest()
  request.open("POST", "report_name.php", true)
   request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function()
  {
    if (this.readyState == 4) // readyState == 4 means the page is done loading
    {
      if (this.status == 200) // status == 200 means the query returned successfully
      {
        if (this.responseText != null)
        {
          document.getElementById('reportName').innerHTML = this.reponseTest
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error1: " + this.statusText + " " + this.status)
    }
  }
  request.send(params)
}
</script>

  <!-- Subnavigation menu -->
  <ul id="subnav">
    <li class="selected"><a href="reportcard.php">Report Card</a>
    <li><a href="items.php">Items</a>
    <li><a href="traits.php">My Traits</a>
    <li><a href="school.php">My School</a>
  </ul>
_HTML;

  // Get grade level from playerID.
  $query = "SELECT name,characters.studentID,gradeLevel from accounts,characters WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
  $result = queryMysql($query);
  $row = mysql_fetch_array($result);
  $name 	= $row['name'];
  $studentID 	= $row['studentID'];
  $gradeLevel 	= $row['gradeLevel'];

  // Get current school.
  $query = "SELECT schoolID from charSchool WHERE studentID=$studentID";
  $result = queryMysql($query);
  $schoolID = mysql_result($result, 0);
  $query = "SELECT schoolName from schools WHERE schoolID=$schoolID";
  $result = queryMysql($query);
  $schoolName = mysql_result($result, 0);

  echo <<<_HTML
<!-- Main content -->
<h1>$name</h1>
<div class="control-panel">
<ul class="control-list">
  <li id="1">Grades</li>
  <li id="2">Skills</li>
  <li id="3">Transcript</li>
</ul>
</div>
<hr>
<img src="images/asian_girl_profile" width="209" height="329" align="left" style="margin-right:10px">
<div id="report-wrapper"><div class="glidingreport">
<span class="gliding-report-content">

Grade Level: $gradeString<br>
School: $schoolName<br>
District Size: 27<br> <!-- TODO -->
_HTML;

// Progress bars for current grades
  $gradeString = getGradeString($gradeLevel);
   echo <<<_HTML
<p><strong>Grades</strong><br>
_HTML;
    // Get gradeID, subject from grades table
    $query = "SELECT gradeID, subject FROM grades WHERE gradeLevel=$gradeLevel";
    $result = queryMysql($query);
    while($row = mysql_fetch_array($result)) {
      $gradeID	= $row['gradeID'];
      $subject	= $row['subject'];
      // Get percent from charGrades table
      $query = "SELECT percent FROM charGrades WHERE gradeID=$gradeID AND " .
               "studentID=$studentID";
      $result2 = queryMysql($query); 
      $percent = mysql_result($result2, 0);
      $letterGrade = getLetterGrade($percent);

      // Display progress bar.
      $progressWidth = 300 * ($percent / 100);
      echo <<<_HTML
<div style="float: left;width:90px">$subject:<pre></div><div style="float:left;width:300px;padding:2px;background-color:white;border:1px solid black;text-align:center">
    <div style="width:
_HTML;
      echo "$progressWidth";
      if ($percent < 70) {
        echo <<<_HTML
px;background-color:#F875C5;">$percent% <!--pink--> 
    </div></div><br><br>
_HTML;
      } 
      elseif ($percent < 80) {
        echo <<<_HTML
px;background-color:#F28626;"> $letterGrade ($percent%) <!--orange--> 
    </div></div><br><br>
_HTML;
      }
      elseif ($percent < 90) {
        echo <<<_HTML
px;background-color:#D6ADFF;"> $letterGrade ($percent%) <!--green-->
    </div></div><br><br>
_HTML;
       }
      elseif ($percent < 95) {
        echo <<<_HTML
px;background-color:#10AD85;"> $letterGrade ($percent%) <!--purple-->
    </div></div><br><br>
_HTML;
      }
      elseif ($percent <= 99) {
        echo <<<_HTML
px;background-color:#2DA2EF;"> $letterGrade ($percent%) <!--light blue-->
    </div></div><br><br>
_HTML;
      }
      elseif ($percent = 100) {
        echo <<<_HTML
px;background-color:#2962A7;color:#FFFFFF"><strong>$letterGrade ($percent%) </strong><!--teal--> 
    </div></div><br><br>
_HTML;
      }
    } 
    echo '</span><span class="gliding-report-content">';


  // Skill information.
  $skillEXPs = array('cultureEXP', 'pianoEXP', 'violinEXP', 'athleticsEXP', 'danceEXP',
                     'languageEXP', 'scienceEXP', 'mathEXP',
                     'chineseEXP');
  $skills = array('Culture', 'Piano', 'Violin', 'Athletics', 'Dance',
                  'Language', 'Science', 'Math',
                  'Chinese');
  $images = array('culture_icon.gif', 'piano_icon.gif', 'violin_icon.gif', 'athletics_icon.gif', 'dance_icon.gif',
                  'language_icon.gif', 'science_icon.gif', 'math_icon.gif', 'chinese_icon.gif');

  echo "<table cellpadding=\"5\"><tr>";
  foreach ($skillEXPs as $skillEXP) {
    $query = "SELECT $skillEXP FROM characters WHERE studentID=$studentID";
    $result = queryMysql($query);
    $exp = mysql_result($result, 0);
    $currLevel = getLevelFromEXP($exp);
    $expCurrLevel = getEXPForLevel($currLevel);
    $expNextLevel = getEXPForLevel($currLevel + 1);
    $expDiff = $expNextLevel - $expCurrLevel;
    $expPercent = floor((($exp - $expCurrLevel) / $expDiff) * 100);
    $progressWidth = 100 * ($expPercent / 100);

    // Get name of skill for printing.
    $index = array_search($skillEXP, $skillEXPs);
    $skillName = $skills[$index];
    $image_file = 'images/' . $images[$index];

     echo <<<_HTML
<td width="160"><div style="margin-left:auto; margin-right:auto;text-align:center"><img src="$image_file" width=100px height=100px><br></div><div style="margin-left:auto;margin-right:auto;width:100px;padding:2px;background-color:white;border:1px solid black;text-align:center">
    <div style="width:
_HTML;
      echo "$progressWidth";
        echo <<<_HTML
px;background-color:#2FB2A0;">$exp/$expNextLevel 
    </div></td>
_HTML;
     if ($index == 2 || $index == 5) {
       echo '</tr><tr>';
     }
    // TODO: Will make prettier later.
    // TODO: Also need to add levels, but looks too ugly right now.
    //	     Need to design layout for this page...
/*    if ($skillName == 'Piano') {
      echo 'Just press the buttons! It not that hard.<br><br>';
    }
    elseif ($skillName == 'Violin') {
      echo 'Only one finger bleeding. Keep practicing!<br><br>';
    } 
    elseif ($skillName == 'Chinese') {
      echo 'Gotta write that letter to Grandma.<br><br>';
    }
    else { 
      echo '<br><br>';
    } */
  }
  echo '</tr></table></span><span class="gliding-report-content">';
  // Overview of grades
  echo "<table cellpadding=\"5\">";
  for ($grade = -1; $grade <= 12; $grade++) {
    // Determine what grade to print.
    $gradeString = getGradeString($grade);
    if ($grade == -1) {
      echo <<<_HTML
<tr><td width="115px"><strong>$gradeString</strong><br>
_HTML;
    } 
    elseif ($grade == 3 || $grade == 7 || $grade == 11) {
      echo <<<_HTML
</td></tr><tr><td width="115px"><strong>$gradeString</strong><br>
_HTML;
    }
    else {
      echo <<<_HTML
</td><td width="115px"><strong>$gradeString</strong><br>
_HTML;
    }
    // Get gradeID, subject from grades table
    $query = "SELECT gradeID, subject FROM grades WHERE gradeLevel=$grade";
    $result = queryMysql($query);
    while($row = mysql_fetch_array($result)) {
      $gradeID	= $row['gradeID'];
      $subject	= $row['subject'];
      // Get percent from charGrades table
      $query = "SELECT percent FROM charGrades WHERE gradeID=$gradeID AND studentID=$studentID";
      $result2 = queryMysql($query); 
      $num_results = mysql_num_rows($result2);
      if ($num_results == 0) {  // Gray out grade.
        echo <<<_HTML
<font color ="#999999">$subject</font>
<br>
_HTML;
      }
      else {  // Normal color.
        $percent = mysql_result($result2, 0);
        $letterGrade = getLetterGrade($percent); 
        echo "$subject: $letterGrade ($percent%)<br>";
      }
    }
  }
  echo '</table></span></div></div>';
  echo <<<_HTML

<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> 
        <a href="forums.html">Forums</a>
        <a href="help.html">Help</a>
<address>Copyright &copy 2011 Bearslug Games. All Rights Reserved.</address>
</center>

<form action="logout.php" method="post"><pre>
<input type="submit" value="Logout" />
</pre></form>
Player ID: $playerID<br>
Student ID: $studentID

</body>
</html>
_HTML;
?>
