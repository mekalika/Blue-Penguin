<?php //checkNameAvailability.php
// Copyright 2011 M.G. Twice. All Rights Reserved.

/** 
  * @fileoverview: Check whether or not a given name is already taken.
  */

  require_once 'botm_functions.php';
  session_start();

  // Check whether a name is taken, and return a String indicating so or not.
  if(isSet($_POST['name'])) {
    $name = $_POST['name'];
    $sql_check = queryMysql('SELECT studentID FROM characters WHERE name=' . 
                            "'$name'");
    if(mysql_num_rows($sql_check)) {  // Name taken
      echo '<font color="red">The name <STRONG>'.$name.'</STRONG> is already in
            use.</font>';
    }
    else {  // Name not taken
      echo 'OK';
    }
  }
?>
