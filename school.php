<?php // school.php
// Copyright 2011 Bearslug. All Rights Reserved.

/**
  * @fileoverview: Loads schools based on grade,
  *                TODO: showing which school the character currently goes to.
  */

  // Log in to MySQL
  require_once 'header.php';

  echo <<<_HTML
<script>
window.onload = getSchools($playerID)
function getSchools(playerID) {
  params = "playerID=" + playerID
  request = new ajaxRequest()
  request.open("POST", "get_schools.php", true)
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function() {
    // readyState == 4 means the page is done loading
    if (this.readyState == 4) {
      // status == 200 means the query returned successfully
      if (this.status == 200) {
        if (this.responseText != null) {
          // Write schools table to the schoolsList DIV
          document.getElementById('schoolList').innerHTML = this.responseText
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error: " + this.statusText)
    }
  }
  request.send(params)
}

function enrollSchool(playerID, schoolID)
{
  params = "playerID=" + playerID + "&schoolID=" + schoolID
  request = new ajaxRequest()
  request.open("POST", "enroll_school.php", true)
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function() {
    // readyState == 4 means the page is done loading
    if (this.readyState == 4) {
      // status == 200 means the query returned successfully
      if (this.status == 200) {
        if (this.responseText != null) {
          // Refresh school list
          getSchools(playerID)
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error1: " + this.statusText + " " + this.status)
    }
  }
  request.send(params)
}

function ajaxRequest() {
  try {
    // For Non-IE Browsers
    var request = new XMLHttpRequest()
  }
  catch(e1) {
    try {
      // For IE6+
      request = new ActiveXObject("Msxml2.XMLHTTP")
    }
    catch(e2) {
      try {
        // For IE5
        request = new ActiveXObject("Microsoft.XMLHTTP")
      }
      catch(e3) {
        request = false
      }
    }
  }
  return request
}

function temp() {
  document.getElementById('cash').innerHTML = "yes"
}
</script>

<!-- Subnavigation menu -->
<ul id="subnav">
  <li><a href="reportcard.php">Report Card</a>
  <li><a href="items.php">Items</a>
  <li><a href="traits.php">My Traits</a>
  <li class="selected"><a href="school.php">My School</a>
</ul>

<!-- Schools -->
<h2>Schools</h2>
<p>The right preschool will lead to the right elementary school which leads to
the right middle school, and so on! But do you live in the right school
district? The more Tiger Mom friends you have, the better!"<br>
Friends: <div id='numFriends'></div>
<div class="electivelist" id='schoolList'></div>
<!-- Sign and date the page, it's only polite! -->
<center><a href="http://tigermomgame.tumblr.com">Tiger Mom Game Blog</a>
<address>Copyright &copy 2012 Bearslug Games. All Rights Reserved.</address>
</center>
_HTML;

  mysql_close($db_server);
?>
