<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) && isset($_POST['eventID']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    $eventID = sanitizeString($_POST['eventID']);
    
    // Get grade level from playerID
    $query = "SELECT characters.studentID,gradeLevel FROM accounts,characters
              WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $studentID  = $row['studentID'];
    
    // Retrieve event properties
    $query = "SELECT events.*, charevents.timeReady FROM events LEFT JOIN charevents
              ON events.eventID=charevents.eventID
              WHERE charevents.studentID=$studentID AND events.eventID=$eventID";
    $result = queryMysql($query);
    $row=mysql_fetch_array($result);
    $eventName          = $row['eventName'];
    $eventCost          = $row['eventCost'];
    $motivationReq      = $row['motivationReq'];
    $eGradeLevel        = $row['eGradeLevel'];
    $timeLimit          = $row['timeLimit'];
    $timeReady          = $row['timeReady'];
    $skillA             = $row['skillA'];
    $EXPA               = $row['EXPA'];
    $skillB             = $row['skillB'];
    $EXPB               = $row['EXPB'];
    $skillC             = $row['skillC'];
    $EXPC               = $row['EXPC'];
    echo "eventName: $eventName timeLimit: $timeLimit timeReady: $timeReady<br>";
    echo "studentID: $studentID eventID: $eventID<br>";

    // Retreive character properties
    $query = "SELECT * FROM accounts, characters WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $row=mysql_fetch_array($result);
    $studentID          = $row['studentID'];
    $gradeLevel         = $row['gradeLevel'];
    $cash               = $row['cash'];
    $currMotivation     = $row['currMotivation'];
    $skillMultiplier1   = $row[strtolower($skillA) . "Multiplier"];
    $skillEXP1          = $row[strtolower($skillA) . "EXP"];
    if ($skillB != "")
    {
      $skillMultiplier2 = $row[strtolower($skillB) . "Multiplier"];
      $skillEXP2        = $row[strtolower($skillB) . "EXP"];
    }
    if ($skillC != "")
    {
      $skillMultiplier3 = $row[strtolower($skillC) . "Multiplier"];
      $skillEXP3        = $row[strtolower($skillC) . "EXP"];
    }
    $time = time();
    
    // Check if you can do the event
    if ($cash >= $eventCost && $currMotivation >= $motivationReq && $gradeLevel >= $eGradeLevel && $time > $timeReady && $timeLimit > -2)
    {
      // OK, you can do the event
      $cash -= $eventCost;
      $currMotivation -= $motivationReq;
      
      // Create query to update skills by concatenating each skill increase
      $skillString = "";
      $skillEXP1 += round((int)$EXPA * (float)$skillMultiplier1);
      $skillString .= ", " . strtolower($skillA) . "EXP" . "=$skillEXP1";
      echo "$skillA increased to $skillEXP1!<br>";
      if ($skillB != "")
      {
        $skillEXP2 += round((int)$EXPB * (float)$skillMultiplier2);
        $skillString .= ", " . strtolower($skillB) . "EXP" . "=$skillEXP2";
        echo "$skillB increased to $skillEXP2!<br>";
      }        
      if ($skillC != "")
      {
        $skillEXP3 += round((int)$EXPC * (float)$skillMultiplier3);
        $skillString .= ", " . strtolower($skillC) . "EXP" . "=$skillEXP3";
        echo "$skillC increased to $skillEXP3!<br>";
      }

      $query = "UPDATE characters SET cash=$cash, currMotivation=$currMotivation, lastAction=$time" . $skillString . " WHERE studentID=$studentID";
      $result = queryMysql($query);
      
      // Handle one-time event
      if ($timeLimit == -1)
      {
        $query = "UPDATE events SET timeLimit=-2 WHERE eventID=$eventID";
        $result = queryMysql($query);
      }
      
      // Update charevents table
      $query = "SELECT * FROM charevents WHERE studentID=$studentID AND eventID=$eventID";
      $result = queryMysql($query);
      
      if (mysql_num_rows($result) == 0)
      {
        // First time doing event, add to charevents table
        $query = "INSERT INTO charevents (studentID, eventID, timeReady)
                  VALUES ($studentID, $eventID, $timeLimit+$time)";
        $result = queryMysql($query);
        echo "Adding new charevent";
      }
      else
      {
        // Update previous charevents entry
        $row = mysql_fetch_array($result);
        $timesDone = $row['timesDone'];
        $timesDone++;
        
        $query = "UPDATE charevents SET timeReady=$timeLimit+$time, timesDone=$timesDone
                  WHERE studentID=$studentID AND eventID=$eventID";
        $result = queryMysql($query);
        echo "Updating charevent";
      }
    }
  }
  
  mysql_close($db_server);
?>