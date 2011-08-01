<?php // create_character.php
// Copyright 2011 M.G.Twice. All Rights Reserved.

/* 
 * @fileoverview: Gets character information from form and by randomly
 *                generating multiplier values, and inserts into characters
 *                table. If creating a character midgame, determine average
 *                skills of active characters and use those.
 */

  function exponential($lambda) {
    $x = lcg_value(); // PHP uses this function to generate ~U(0,1]
    return - log($x) / $lambda;
  }
    
  /** 
   * mean = n / lambda
   * variation = n / (lambda^2)
   * n: number of exponential samples
   * lambda: shaping variable (exponential decay)
   */
  function gamma($n, $lambda) {
    $i=0;

    for($i; $i < $n; $i++) {
      $x[$i] = exponential($lambda);
    }

    $y = 0;
    $j = 0;

    for($j; $j < $n; $j++) {
      $y += $x[$j];
    }

    return $y;
  }
  
  function get_post($var) {
    return mysql_real_escape_string($_POST[$var]);
  }
 
  require_once 'botm_functions.php';
  session_start();

  $pianoMultiplier 	= gamma(6,12) + 0.5;
  $violinMultiplier 	= gamma(6,12) + 0.5;  
  $athleticsMultiplier 	= gamma(6,12) + 0.5;
  $danceMultiplier 	= gamma(6,12) + 0.5;
  $languageMultiplier 	= gamma(6,12) + 0.5;
  $scienceMultiplier 	= gamma(6,12) + 0.5;
  $mathMultiplier 	= gamma(6,12) + 0.5;
  $historyMultiplier 	= gamma(6,12) + 0.5;
  $chineseMultiplier 	= gamma(6,12) + 0.5;
  
  if (isset($_POST['name']) &&
      isset($_POST['gender'])) {
    $name 	= get_post('name');
    $gender 	= get_post('gender');
    $time = time();
    $minActiveCharTime = $time - 604800;  // One week in seconds

    // Create character!
    queryMysql('INSERT INTO characters (name, gender, pianoMultiplier, ' . 
               'violinMultiplier, athleticsMultiplier,danceMultiplier, ' . 
               'languageMultiplier, scienceMultiplier, mathMultiplier, ' . 
               'historyMultiplier, chineseMultiplier, lastAction) VALUES' . 
               " ('$name', '$gender', '$pianoMultiplier', " . 
               "'$violinMultiplier', '$athleticsMultiplier', " .
               "'$danceMultiplier', '$languageMultiplier', " .
               "'$scienceMultiplier', '$mathMultiplier', " .
               "'$historyMultiplier', '$chineseMultiplier', '$time')"
              );
    $result = queryMysql('SELECT studentID, round, gradeLevel FROM ' .
                         'characters WHERE name=' . "('$name')");
    $row = mysql_fetch_array($result);

    $skills = array('pianoEXP', 'violinEXP', 'athleticsEXP', 'danceEXP',
                    'languageEXP', 'scienceEXP', 'mathEXP', 'historyEXP',
                    'chineseEXP');
    // If creating a character midgame, determine skills based on average
    // skills of active characters in this round.
    if ($row['gradeLevel'] != -1) {
      // Give user 10 * (grade + 1) number of skill points.
      $numSkillPoints = 10 * ($row['gradeLevel'] + 1);
      queryMysql('UPDATE characters SET skillPoints=' . 
                "'$numSkillPoints'" . ' WHERE name=' . "'$name'");

      // Calculate and give student average EXPs for Chinese, math, etc. 
      $result = queryMysql('SELECT COUNT(*) FROM characters');
      $numChars = mysql_result($result, 0);
      foreach ($skills as $skill) {
        $total = 0;
        $round = $row['round'];
        $result = queryMysql("SELECT $skill FROM characters WHERE name!=" .
                             "'$name' AND round='$round' AND " .
                             "lastAction>='$minActiveCharTime'");
 
        while($skillRow = mysql_fetch_array($result)) {
          $total += $skillRow[$skill];
        }
        $avgSkillEXP = $total / ($numChars - 1);
        queryMysql('UPDATE characters SET ' . "$skill" . 
                   "='$avgSkillEXP'" . ' WHERE name=' . "'$name'"); 
    
      // TODO: Calculate and insert levels based on EXP. 
      }
    }

    $studentID = $row['studentID'];
    // TODO: Change the following section once we integrate with Facebook.
    queryMysql('INSERT INTO accounts (studentID, password) VALUES (' .
               "'$studentID'" . ', \'a\')');

    // Log in to BoTM!
    $result = queryMysql('SELECT playerID FROM accounts WHERE studentID=' .
                         "'$studentID'");
    $playerID = mysql_result($result, 0);
  
    session_start();
    $_SESSION['playerID'] = $playerID;
    header( 'Location: main.php' );
  }    
?>
