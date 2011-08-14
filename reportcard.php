<?php // reportcard.php
// Copyright 2011 Bearslug Entertainment. All Rights Reserved.
  require_once 'header.php';
  require_once 'botm_functions.php';
  session_start();

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
  <div id="subnavbar">
  <span class="inbar">
  <ul>
    <li><a href="reportcard.php"><span>Report Card</span></a>
    <li><a href="items.html"><span>Items</span></a>
    <li><a href="traits.php"><span>My Traits</span></a>
    <li><a href="school.php"><span>My School</span></a>
  </ul>
  </span>
  </div>
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
<p><strong>Basic info</strong><br>
Name: $name<br>
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
      $query = "SELECT percent FROM charGrades WHERE gradeID=$gradeID";
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

  // Overview of grades
  echo "<table cellpadding=\"5\">";
  for ($grade = -1; $grade <= 12; $grade++) {
    // Determine what grade to print.
    $gradeString = getGradeString($grade);
    if ($grade == -1) {
      echo <<<_HTML
<tr><td width="140px"><strong>$gradeString</strong><br>
_HTML;
    } 
    elseif ($grade == 4 || $grade == 9) {
      echo <<<_HTML
</td></tr><tr><td width="140px"><strong>$gradeString</strong><br>
_HTML;
    }
    else {
      echo <<<_HTML
</td><td width="140px"><strong>$gradeString</strong><br>
_HTML;
    }
    // Get gradeID, subject from grades table
    $query = "SELECT gradeID, subject FROM grades WHERE gradeLevel=$grade";
    $result = queryMysql($query);
    while($row = mysql_fetch_array($result)) {
      $gradeID	= $row['gradeID'];
      $subject	= $row['subject'];
      // Get percent from charGrades table
      $query = "SELECT percent FROM charGrades WHERE gradeID=$gradeID";
      $result2 = queryMysql($query); 
      $percent = mysql_result($result2, 0);
      if ($percent == NULL) {  // Gray out grade.
        echo <<<_HTML
<font color ="gray">$subject</font>
<br>
_HTML;
      }
      else {  // Normal color.
        $letterGrade = getLetterGrade($percent); 
        echo "$subject: $letterGrade ($percent%)<br>";
      }
    }
  }
  echo "</table>";

// Skill information.
/*
 TODO: For each skill, get skillEXP, skillLevel.
       Also need the EXP difference between current skillLevel and next
       skillLevel. Calculate percentage based on skillEXP and this
       EXP difference. Display progress bars.
*/
  echo <<<_HTML

<p>Progress bars and levels for skills. BONUS: add pithy descriptions for each skill.
Piano Violin Athletics Dance Language Science Math

<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> 
        <a href="forums.html">Forums</a>
        <a href="help.html">Help</a>
<address>Copyright &copy 2011 Bearslug Entertainment. All Rights Reserved.</address>
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