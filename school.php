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
  params = "playerID=" + playerID // + "&gradeLevel=" + gradeLevel
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

  request.onreadystatechange = function()
  {
    if (this.readyState == 4) // readyState == 4 means the page is done loading
    {
      if (this.status == 200) // status == 200 means the query returned successfully
      {
 /*       if (this.responseText != null)
        {
          // refresh header
          refreshHeader()
          
          // refresh events list
          //getEvents(playerID)
          
          // Display stat increases
//          document.getElementById('eventResult').innerHTML = this.responseText
          
          // debug
          //document.getElementById('info1').innerHTML = this.responseText
        }*/
        //else alert("Ajax error: No data received")
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
<div id="subnavbar">
<span class="inbar">
<ul>
  <li><a href="reportcard.html"><span>Report Card</span></a>
  <li><a href="items.html"><span>Items</span></a>
  <li><a href="traits.html"><span>My Traits</span></a>
  <li><a href="school.php"><span>My School</span></a>
</ul>
</span>
</div>

<!-- Schools -->
<h2>Schools</h2>
<p>The right preschool will lead to the right elementary school which leads to 
the right middle school, and so on! But do you live in the right school
district? The more Tiger Mom friends you have, the better!"
<div class="electivelist" id='schoolList'>a</div>
<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> <a href="forums.html">Forums</a> <a href="help.html">Help</a>
<address>Copyright &copy 2011 M.G.Twice. All Rights Reserved.</address>
</center>
_HTML;

  mysql_close($db_server);
?>
