<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) && isset($_POST['type']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    $type = sanitizeString($_POST['type']);

    // Get grade level from playerID
    $query = "SELECT name, characters.studentID FROM " .
             "accounts,characters WHERE playerID=$playerID " .
             " AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $name = $row['name'];
    $studentID = $row['studentID'];
    $gradeLevel = getGrade();

    // Get all events below current grade level, join events and charevents table
    $query = "SELECT events.*,charevents.timeReady,charevents.timesDone FROM" .
             " events LEFT JOIN charevents ON events.eventID=" .
             "charevents.eventID AND charevents.studentID=$studentID WHERE " .
             "events.eGradeLevel=$gradeLevel AND events.type='$type' " .
             "ORDER BY events.category, events.eventCost, events.motivationReq";
    $result = queryMysql($query);

    $time = time();
    $prevEventCategory = '';
    if ($type != 'L') {
      echo '<div id="wrapper"><div class="gliding">';
    }
    $index = 0;
    while($row=mysql_fetch_array($result)) {
      $eventID = $row['eventID'];
      $eventName = $row['eventName'];
      $eventCost = $row['eventCost'];
      $motivationReq = $row['motivationReq'];
      $timeLimit = $row['timeLimit'];
      $timeReady = $row['timeReady'];
      $eventDescription = $row['eventDescription'];
      $skillA = $row['skillA'];
      $skillB = $row['skillB'];
      $skillC = $row['skillC'];
      $timesDone = $row['timesDone'];
      $category = $row['category'];
      $type = $row['type'];

      $timerName = "NULL";
      $timeLeft=0;
      // TODO: Use -2 to implement a completed one-time event
      if ($timeLimit == -1) {
        $eventTime = "One-time event";
      }
      else if ($timeLimit == -2)
      {
        $eventTime = "Completed";
      }
      else {
        $timeLeft = $timeReady - $time;
        $eventTime = "";
        $timerName = "countdownTimer";
      }

      // Hack to replace $name in eventName with character's name.
      $eventName = str_replace('$name', $name, $eventName);

      // Sort events into categories for slider
      if ($prevEventCategory != $category && $category != '') {
        if ($prevEventCategory != '') {
          echo '</span>';
        }
        if ($type != 'L') {
          echo "<span class=\"gliding-content\" title=$category>";
          echo "<h2>$category</h2>";
          $prevEventCategory = $category;
        }
      }

      $divName = "event" . "$index";
      echo <<<_HTML
<div id=$divName>
<table id="events">
<tr class="eventname">
<td colspan="2">$eventName</td>
<td><div name=$timerName title=$timeLeft>$eventTime</div></td>
</tr>
<tr class="eventdescription">
<td colspan="3">$eventDescription</td>
</tr>
<tr>
<th width=20%>Skills trained</th>
<th width=60%>Requirements</th>
<th></th>
</tr>
<tr>
<td>$skillA</td>
_HTML;
      if ($eventCost == 0) {
        echo <<<_HTML
<td>Motivation: $motivationReq</td>
<td></td>
</tr>
<tr>
<td>$skillB</td>
<td></td>
_HTML;
      }
      else {
        echo <<<_HTML
<td>Cost: $$eventCost</td>
<td></td>
</tr>
<tr>
<td>$skillB</td>
_HTML;
        if ($motivationReq == 0) {
          echo "<td></td>";
        }
        else {
          echo "<td>Motivation: $motivationReq</td>";
        }
      }
      echo <<<_HTML
<td><input type="button" value="Do event" onClick="doEvent($playerID,$eventID,'$type','$divName')"></td>
</tr>
<tr>
<td>$skillC</td>
<td></td>
<td></td>
</tr>
</table></div><br>
_HTML;
      $index++;
    }
    if ($type != 'L') {
      echo "</div></div>";
    }
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>
