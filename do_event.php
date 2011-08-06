<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) && isset($_POST['eventID']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    $eventID = sanitizeString($_POST['eventID']);
    
    // Retrieve event properties
    $query = "SELECT * FROM events WHERE eventID=$eventID";
    $result = queryMysql($query);
    $row=mysql_fetch_array($result);
    $eventID            = $row['eventID'];
    $eventCost          = $row['eventCost'];
    $motivationReq      = $row['motivationReq'];
    $eGradeLevel        = $row['eGradeLevel'];
    $timeLimit          = $row['timeLimit'];
    $skillA             = $row['skillA'];
    $EXPA               = $row['EXPA'];
    $skillB             = $row['skillB'];
    $EXPB               = $row['EXPB'];
    $skillC             = $row['skillC'];
    $EXPC               = $row['EXPC'];

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
    if ($cash >= $eventCost && $currMotivation >= $motivationReq && $gradeLevel >= $eGradeLevel && $time > $timeLimit && $timeLimit > -2)
    {
      // OK, you can do the event
      $cash -= $eventCost;
      $currMotivation -= $motivationReq;
      
      // Create query to update skills by concatenating each skill increase
      $skillString = "";
      $skillEXP1 += round((int)$EXPA * (float)$skillMultiplier1);
      $skillString .= ", " . strtolower($skillA) . "EXP" . "=$skillEXP1";
      if ($skillB != "")
      {
        $skillEXP2 += round((int)$EXPB * (float)$skillMultiplier2);
        $skillString .= ", " . strtolower($skillB) . "EXP" . "=$skillEXP2";
      }        
      if ($skillC != "")
      {
        $skillEXP3 += round((int)$EXPC * (float)$skillMultiplier3);
        $skillString .= ", " . strtolower($skillC) . "EXP" . "=$skillEXP3";
      }

      $query = "UPDATE characters SET cash=$cash, currMotivation=$currMotivation, lastAction=$time" . $skillString . " WHERE studentID=$studentID";
      $result = queryMysql($query);
      
      // Handle one-time event
      if ($timeLimit == -1)
      {
        $query = "UPDATE events SET timeLimit=-2 WHERE eventID=$eventID";
        $result = queryMysql($query);
      }
    }
  }
  
  mysql_close($db_server);
?>