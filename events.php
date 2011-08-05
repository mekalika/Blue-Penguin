<?php // events.php
// Copyright 2011 M.G.Twice. All Rights Reserved.

/**
  * @fileoverview: Fills in the ID card, and loads events based on grade,
  *                checking whether the event is available or not (time-wise).
  */

  // Log in to MySQL
  require_once 'header.php';

  echo <<<_HTML
<script>
function getEvents(playerID)
{
  params = "playerID=" + playerID // + "&gradeLevel=" + gradeLevel
  request = new ajaxRequest()
  request.open("POST", "get_events.php", true)
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function()
  {
    if (this.readyState == 4) // readyState == 4 means the page is done loading
    {
      if (this.status == 200) // status == 200 means the query returned successfully
      {
        if (this.responseText != null)
        {
          // Write events table to the eventList DIV
          document.getElementById('eventList').innerHTML = this.responseText
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error: " + this.statusText)
    }
  }
  request.send(params)
}

function doEvent(playerID, eventID)
{
  params = "playerID=" + playerID + "&eventID=" + eventID
  request = new ajaxRequest()
  request.open("POST", "do_event.php", true)
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
  request.setRequestHeader("Content-length", params.length)
  request.setRequestHeader("Connection", "close")

  request.onreadystatechange = function()
  {
    if (this.readyState == 4) // readyState == 4 means the page is done loading
    {
      if (this.status == 200) // status == 200 means the query returned successfully
      {
        if (this.responseText != null)
        {
          // refresh header
          refreshHeader()
          
          // referesh events list
          getEvents(playerID)
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

function ajaxRequest()
{
    try
    {
        // For Non-IE Browsers
        var request = new XMLHttpRequest()
    }
    catch(e1)
    {
        try
        {
            // For IE6+
            request = new ActiveXObject("Msxml2.XMLHTTP")
        }
        catch(e2)
        {
            try
            {
                // For IE5
                request = new ActiveXObject("Microsoft.XMLHTTP")
            }
            catch(e3)
            {
                request = false
            }
        }
    }
    return request
}

function temp()
{
  document.getElementById('cash').innerHTML = "yes"
}
</script>

<!-- Subnavigation menu -->
<div id="subnavbar">
<span class="inbar">
<ul>
  <li><a href="life.html"><span>Life</span></a>
  <li><a href="academics.html"><span>Academics</span></a>
  <li><a href='javascript:;' onclick='getEvents($playerID); resetTimer();'><span>Electives</span></a>
</ul>
</span>
</div>

<!-- Events -->
<h2>Elective Events</h2>
<div class="electivelist">
<p>"Unlike your typical Western overscheduling soccer mom, the Chinese mother believes that...the only activities your children should be permitted to do are those in which they can eventually win a medal; and...that medal must be gold."<br><br>
<a href="#piano">Piano</a> <a href="#violin">Violin</a> <a href="#athletics">Athletics</a> <a href="#dance">Dance</a> <a href="#language">Language</a> <a href="#science">Science</a> <a href="#math">Math</a>
</div>
<div class="electivelist" id='eventList'>a</div>
$time
<div id='info'>b</div>
<div id='info1'>c</div>
<a href='javascript:;' onclick='temp();'>test</a>
<a href="refresh_header.php">test2</a>
<div id="test" name="timer" title=500></div><br>
<div id="test2" name="timer" title=300></div><br>
<script type="text/javascript" src="timer.js"></script>
_HTML;

  mysql_close($db_server);
?>