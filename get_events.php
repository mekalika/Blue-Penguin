<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    
    // Get grade level from playerID
    $query = "SELECT characters.studentID,gradeLevel FROM accounts,characters
              WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $studentID  = $row['studentID'];
    $gradeLevel = $row['gradeLevel'];
    
    // Get all events below current grade level, join events and charEvents table
    $query = "SELECT events.*,charEvents.timeReady,charEvents.timesDone FROM events
              LEFT JOIN charEvents ON events.eventID=charEvents.eventID
              AND charEvents.studentID=$studentID WHERE events.eGradeLevel<=$gradeLevel";
    $result = queryMysql($query);
    
    echo "Player ID: $playerID<br>";
    echo "Grade Level: $gradeLevel<br>";

    $time = time();
    while($row=mysql_fetch_array($result)) {
      $eventID          = $row['eventID'];
      $eventName        = $row['eventName'];
      $eventCost        = $row['eventCost'];
      $motivationReq    = $row['motivationReq'];
      $timeLimit        = $row['timeLimit'];
      $timeReady        = $row['timeReady'];
      $eventDescription = $row['eventDescription'];
      $skillA           = $row['skillA'];
      $skillB           = $row['skillB'];
      $skillC           = $row['skillC'];
      $timesDone        = $row['timesDone'];
      
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
        $timerName = "timer";
      }

    echo <<<_HTML
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
    <th width=65%>Requirements</th>
    <th></th>
  </tr>
  <tr>
    <td>$skillA</td>
    <td>Cost: $$eventCost</td>
    <td></td>
  </tr>
  <tr>
    <td>$skillB</td>
    <td>Motivation: $motivationReq</td>
    <td><input type="button" value="Do event" onClick="doEvent($playerID,$eventID)"></td>
  </tr>
  <tr>
    <td>$skillC</td>
    <td></td>
    <td><a href="do_event.php">test</a></td>
  </tr>
</table><br><br>
_HTML;
    }
    echo <<<_HTML
<script type="text/javascript" src="timer.js"></script>
Time: $time
_HTML;
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>
