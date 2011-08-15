<?php // traits.php
// Copyright 2011 Bearslug Entertainment. All Rights Reserved.

/**
  * @fileoverview: Loads traits and displays available skill points. 
  */

  // Log in to MySQL
  require_once 'header.php';

  echo <<<_HTML
<script>
window.onload = getTraits($playerID)
function getTraits(playerID) {
  params = "playerID=" + playerID // + "&gradeLevel=" + gradeLevel
  request = new ajaxRequest()
  request.open("POST", "get_traits.php", true)
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function() {
    // readyState == 4 means the page is done loading
    if (this.readyState == 4) {
      // status == 200 means the query returned successfully
      if (this.status == 200) {
        if (this.responseText != null) {
          // Write traits table to the traitsList DIV
          document.getElementById('traitsList').innerHTML = this.responseText
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error: " + this.statusText)
    }
  }
  request.send(params)
}

function allocateSkillPoint(playerID, trait)
{
  params = "playerID=" + playerID + "&trait=" + trait
  request = new ajaxRequest()
  request.open("POST", "allocate_skill_point.php", true)
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function() {
    if (this.readyState == 4) {
      // status == 200 means the query returned successfully
      if (this.status == 200) {
        if (this.responseText != null) {
          // Refresh header
          refreshHeader()

          // Refresh traits list
          getTraits(playerID)
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error1: " + this.statusText + " " + this.status)
    }
  }
  request.send(params)
}

function refreshHeader()
{
  params = ""
  request = new ajaxRequest()
  request.open("POST", "refresh_header.php", true)
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function()
  {
    if (this.readyState == 4) // readyState == 4 means the page is done loading
    {
      if (this.status == 200) // status == 200 means the query returned successfully
      {
        if (this.responseXML != null)
        {
          // Parse XML data
          currMotivation        = this.responseXML.getElementsByTagName('currmotivation')
          maxMotivation         = this.responseXML.getElementsByTagName('maxmotivation')
          currPride             = this.responseXML.getElementsByTagName('currpride')
          maxPride              = this.responseXML.getElementsByTagName('maxpride')
          cash                  = this.responseXML.getElementsByTagName('cash')
          gradeString           = this.responseXML.getElementsByTagName('gradestring')
          
          // Update ID card info
          document.getElementById('currMotivation').innerHTML = currMotivation[0].childNodes[0].nodeValue
          document.getElementById('maxMotivation').innerHTML = maxMotivation[0].childNodes[0].nodeValue
          document.getElementById('currPride').innerHTML = currPride[0].childNodes[0].nodeValue
          document.getElementById('maxPride').innerHTML = maxPride[0].childNodes[0].nodeValue
          document.getElementById('cash').innerHTML = cash[0].childNodes[0].nodeValue
          document.getElementById('gradeString').innerHTML = gradeString[0].childNodes[0].nodeValue
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error2: " + this.statusText + " " + this.status)
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
  <li><a href="reportcard.php"><span>Report Card</span></a>
  <li><a href="items.html"><span>Items</span></a>
  <li><a href="traits.php"><span>My Traits</span></a>
  <li><a href="school.php"><span>My School</span></a>
</ul>
</span>
</div>

<!-- Traits -->
<h2>Traits</h2>
<p>Who knew instilling values on your kids was so easy? Use the skill points you
earned from doggedly forcing your kids to study and practice to improve their traits so you can force them to work even more! ;D
<div class="electivelist" id='traitsList'>a</div>
<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> <a href="forums.html">Forums</a> <a href="help.html">Help</a>
<address>Copyright &copy 2011. Bearslug Entertainment. All Rights Reserved.</address>
</center>
_HTML;

  mysql_close($db_server);
?>
