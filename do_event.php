<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) && isset($_POST['eventID']) && isset($_POST['type']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    $eventID = sanitizeString($_POST['eventID']);
    $type = sanitizeString($_POST['type']);

    // Get grade level from playerID
    $query = "SELECT characters.studentID,gradeLevel FROM accounts,characters
              WHERE playerID=$playerID AND accounts.studentID=characters.studentID";
    $result = queryMysql($query);
    $row = mysql_fetch_array($result);
    $studentID  = $row['studentID'];

    // Retrieve event properties
    $query = "SELECT events.*, charevents.timeReady FROM events LEFT JOIN charevents
              ON events.eventID=charevents.eventID
              AND charevents.studentID=$studentID WHERE events.eventID=$eventID";
    $result = queryMysql($query);
    $row=mysql_fetch_array($result);
    $eventName          = $row['eventName'];
    $eventCost          = $row['eventCost'];
    $motivationReq      = $row['motivationReq'];
    $eGradeLevel        = $row['eGradeLevel'];
    $timeLimit          = $row['timeLimit'];
    $timeReady          = $row['timeReady'];
    $skill[0]           = $row['skillA'];
    $EXP[0]             = $row['EXPA'];
    $skill[1]           = $row['skillB'];
    $EXP[1]             = $row['EXPB'];
    $skill[2]           = $row['skillC'];
    $EXP[2]             = $row['EXPC'];
    $category           = $row['category'];

    // Debug info
    //echo "eventName: $eventName timeLimit: $timeLimit timeReady: $timeReady<br>";
    //echo "studentID: $studentID eventID: $eventID<br>";

    // Check if any skills are grades
    for ($i = 0; $i < 3; $i++)
    {
      $temp = explode(" ", $skill[$i]);
      if (count($temp) > 1)
      {
        $isGrade[$i] = 1;
        if ($temp[0] == "English")
        {
          $skill[$i] = "language"; // Convert English into language
          $category = "Language";
        }
        else
        {
          $skill[$i] = $temp[0];
        }
      }
      else
      {
        $isGrade[$i] = 0;
      }
    }

    // Retreive character properties
    $query = "SELECT * FROM characters WHERE studentID=$studentID";
    $result = queryMysql($query);
    $row=mysql_fetch_array($result);
    $studentID          = $row['studentID'];
    $gradeLevel         = $row['gradeLevel'];
    $cash               = $row['cash'];
    $currMotivation     = $row['currMotivation'];
    $maxMotivation      = $row['maxMotivation'];
    $currPride          = $row['currPride'];
    $maxPride           = $row['maxPride'];
    $currBattle         = $row['currBattle'];
    $maxBattle          = $row['maxBattle'];
    $lastAction         = $row['lastAction'];
    $motivationTimer    = $row['motivationTimer'];
    $prideTimer         = $row['prideTimer'];
    $battleTimer        = $row['battleTimer'];
    for ($i = 0; $i < 3; $i++)
    {
      if ($skill[$i] != "")
      {
        $skillMultiplier[$i] = $row[strtolower($skill[$i]) . "Multiplier"];
        $skillEXP[$i]        = $row[strtolower($skill[$i]) . "EXP"];
      }
    }
    $time = time();

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

    // Reset timer if stat is full
    if ($currMotivation == $maxMotivation)
      $motivationTime = 0;
    if ($currPride == $maxPride)
      $prideTime = 0;
    if ($currBattle == $maxBattle)
      $battleTime = 0;

    // Calculate timestamp for replenishment timers
    $motivationTime = $time - $motivationTime % $RT;
    $prideTime = $time - $prideTime % $RT;
    $battleTime = $time - $battleTime % $RT;

    // Check if you can do the event
    if ($cash >= $eventCost && $currMotivation >= $motivationReq && $gradeLevel >= $eGradeLevel
        && $time > $timeReady && $timeLimit > -2)
    {
      // OK, you can do the event
      $cash -= $eventCost;
      $currMotivation -= $motivationReq;

      // Find event specific item bonuses (for specific sports like soccer)
      $query = "SELECT items.bonus,items.itemName FROM purchases LEFT JOIN itembonus
                ON itembonus.itemID=purchases.itemID
                LEFT JOIN items ON itembonus.itemID=items.itemID WHERE itembonus.eventID=$eventID";
      $result = queryMysql($query);
      $itemBonus = 1;
      $bonusString = "";
      while($row=mysql_fetch_array($result))
      {
        $bonus = $row['bonus'];
        $itemName = $row['itemName'];
        $itemBonus *= $bonus;
        $bonusPercent = (int)(($bonus - 1) * 100);
        $bonusString .= $itemName . " gives " . $bonusPercent ."% bonus! ";
      }
      echo $bonusString . "Total bonus: " . $itemBonus . " ";

      // Find category item bonuses (i.e. math)
      $query = "SELECT items.bonus,items.itemName FROM purchases LEFT JOIN items
                ON purchases.itemID=items.itemID WHERE items.itemSkill='$category'";
      $result = queryMysql($query);
      $itemBonus2 = 1;
      $bonusString2 = "";
      while($row=mysql_fetch_array($result))
      {
        $bonus = $row['bonus'];
        $itemName = $row['itemName'];
        $itemBonus2 *= $bonus;
        $bonusPercent = (int)(($bonus-1) * 100);
        $bonusString .= $itemName . " gives " . $bonusPercent ."% bonus! ";
      }
      echo $bonusString . "Total bonus2: " . $itemBonus2 . "<br>";

      // Create query to update skills by concatenating each skill increase
      $skillString = "";
      for ($i = 0; $i < 3; $i++)
      {
        if ($isGrade[$i] != 1 && $skill[$i] != "")
        {
          $prevEXP = $skillEXP[$i];
          $skillEXP[$i] += round((int)$EXP[$i] * (float)($skillMultiplier[$i] * $itemBonus * $itemBonus2));
          $skillString .= ", " . strtolower($skill[$i]) . "EXP" . "=$skillEXP[$i]";
          //echo "Base=" . $EXP[$i] . " skillMult=" . $skillMultiplier[$i] . " bonus1=" . $itemBonus . " bonus2=" . $itemBonus2;
          echo $skill[$i] . " increased from " . $prevEXP  . " to " . $skillEXP[$i] . "!<br>";
        }
      }

      // Create query to update grades by concatenating each grade increase
      $gradeString = "";
      for ($i = 0; $i < 3; $i++)
      {
        if ($isGrade[$i] == 1)
        {
          if ($skill[$i] == "language")
          {
            $skill[$i] = "English"; // Convert language back in English
          }
          // Retrieve character grades
          $query = "SELECT chargrades.percent,grades.gradeID,grades.subject
                    FROM chargrades, grades WHERE chargrades.gradeID=grades.gradeID
                    AND chargrades.studentID=$studentID AND grades.gradeLevel=$eGradeLevel
                    AND grades.subject=\"" . $skill[$i] . "\"";
          $result = queryMysql($query);
          $row=mysql_fetch_array($result);
          $percent[$i] = $row['percent'];
          $gradeID[$i] = $row['gradeID'];

          $prevGrade = $percent[$i];
          $percent[$i] += round((int)$EXP[$i] * (float)($skillMultiplier[$i] * $itemBonus * $itemBonus2));
          $percent[$i] = min($percent[$i], 100); // Cap grades at 100%
          $gradeString .= "";
          //echo "gradeID=" . $gradeID[$i] . " Percent=" . $percent[$i] . " Subject=" . $skill[$i];
          //echo "Base=" . $EXP[$i] . " $skill[$i]" . " grade increased to " . $percent[$i] . "<br>";
          echo $skill[$i] . " grade increased from " . $prevGrade . " to " . $percent[$i] . "!<br>";

          // Update grade
          $query = "UPDATE chargrades SET percent=$percent[$i] WHERE gradeID=$gradeID[$i]";
          $result = queryMysql($query);
        }
      }

      /*// Create query to update skills by concatenating each skill increase
      $skillString = "";
      $skillEXP1 += round((int)$EXPA * (float)($skillMultiplier1 * $itemBonus * $itemBonus2));
      if ($isGradeA == 1)
      {

      }
      else
      {
        $skillString .= ", " . strtolower($skillA) . "EXP" . "=$skillEXP1";
        echo "Base=" . $EXPA . " skillMult=" . $skillMultiplier1 . " bonus1=" . $itemBonus . " bonus2=" . $itemBonus2;
        echo "$skillA increased to $skillEXP1!<br>";
      }

      if ($skillB != "")
      {
        $skillEXP2 += round((int)$EXPB * (float)($skillMultiplier2 * $itemBonus * $itemBonus2));
        $skillString .= ", " . strtolower($skillB) . "EXP" . "=$skillEXP2";
        echo "$skillB increased to $skillEXP2!<br>";
      }
      if ($skillC != "")
      {
        $skillEXP3 += round((int)$EXPC * (float)($skillMultiplier3 * $itemBonus * $itemBonus2));
        $skillString .= ", " . strtolower($skillC) . "EXP" . "=$skillEXP3";
        echo "$skillC increased to $skillEXP3!<br>";
      }*/

      // Update character stats
      $query = "UPDATE characters SET cash=$cash, currMotivation=$currMotivation,
                currPride=$currPride, currBattle=$currBattle, lastAction=$time,
                motivationTimer=$motivationTime, prideTimer=$prideTime,
                battleTimer=$battleTime" . $skillString . " WHERE studentID=$studentID";
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
        //echo "Adding new charevent";
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
        //echo "Updating charevent";
      }
    }
    else
    {
      if ($cash < $eventCost)
      {
        echo "You are too poor!<br>";
      }
      else if ($currMotivation < $motivationReq)
      {
        echo "Your tiger cub is too mopey to do anything!<br>";
      }
      else if ($gradeLevel < $eGradeLevel)
      {
        echo "Your tiger cub is too young to do this!<br>";
      }
      else if ($time < $timeReady)
      {
        echo "Your tiger cub did this event too recently!<br>";
      }
      else if ($timeLimit < -1)
      {
        echo "Your tiger cub completed this one-time event!<br>";
      }
    }
  }

  mysql_close($db_server);
?>
