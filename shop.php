<?php // events.php
// Copyright 2011 Bearslug Games. All Rights Reserved.

/**
  * @fileoverview: Fills in the ID card, and loads events based on grade,
  *                checking whether the event is available or not (time-wise).
  */

  // Log in to MySQL
  require_once 'header.php';

  echo <<<_HTML
<script>
function getItems(playerID)
{
  params = "playerID=" + playerID // + "&gradeLevel=" + gradeLevel
  request = new ajaxRequest()
  request.open("POST", "get_items.php", false)
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
          // Write items table to the itemList DIV
          document.getElementById('itemList').innerHTML = this.responseText
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error: " + this.statusText)
    }
  }
  request.send(params)
}

function buyItem(playerID, itemID)
{
  params = "playerID=" + playerID + "&itemID=" + itemID
  request = new ajaxRequest()
  request.open("POST", "buy_item.php", true)
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
          getItems(playerID)
          
          // Display stat increases
          document.getElementById('info').innerHTML = this.responseText
          
          // debug
          //document.getElementById('info1').innerHTML = this.responseText
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

<!-- Events -->
<h2>Hobby Superstore</h2>
<p>Here you can purchase the supplies and equipment you need for your electives!<br>
<center>
<div class="control-panel">
<ul class="control-list">
  <li id="1">Athletics</li>
  <li id="2">Dance</li>
  <li id="3">Language</li>
  <li id="4">Math</li>
  <li id="5">Piano</li>
  <li id="6">Science</li>
  <li id="7">Violin</li>
</ul>
</div>
<div id='itemList'></div>
<div id='info'></div>
<div id='info1'></div>
</center>
<script>
window.onLoad = getItems($playerID)
</script>
<script src="scripts/sliding.js"></script>
<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> <a href="forums.html">Forums</a> <a href="help.html">Help</a>
<address>Copyright &copy 2011 Bearslug Games. All Rights Reserved.</address>
</center>
</body>
</html>
_HTML;

  mysql_close($db_server);
?>
