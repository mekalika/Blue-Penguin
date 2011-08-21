// Copyright 2011 Bearslug Games. All Rights Reserved.

/**
  * @fileoverview: Fills in the ID card, and loads events based on grade,
  *                checking whether the event is available or not (time-wise).
  */

function getEvents(playerID, type)
{
  params = "playerID=" + playerID  + "&type=" + type
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
          
          // Reset timers
          resetCountdownTimer()
        }
        else alert("Ajax error: No data received")
      }
      else alert("Ajax error: " + this.statusText)
    }
  }
  request.send(params)
}

function doEvent(playerID, eventID, type)
{
  params = "playerID=" + playerID + "&eventID=" + eventID + "&type=" + type
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
          resetCountupTimers()
          
          // refresh events list
          getEvents(playerID, type)
          
          // Display stat increases
          document.getElementById('eventResult').innerHTML = this.responseText
          
          // debug
          //document.getElementById('info1').innerHTML = this.responseText
        }
        else alert("Ajax error1: No data received")
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
          motivationTime        = this.responseXML.getElementsByTagName('motivationTime')
          prideTime             = this.responseXML.getElementsByTagName('prideTime')
          battleTime            = this.responseXML.getElementsByTagName('battleTime')
          
          // Update ID card info
          document.getElementById('currMotivation').innerHTML = currMotivation[0].childNodes[0].nodeValue
          document.getElementById('maxMotivation').innerHTML = maxMotivation[0].childNodes[0].nodeValue
          document.getElementById('currPride').innerHTML = currPride[0].childNodes[0].nodeValue
          document.getElementById('maxPride').innerHTML = maxPride[0].childNodes[0].nodeValue
          document.getElementById('cash').innerHTML = cash[0].childNodes[0].nodeValue
          document.getElementById('gradeString').innerHTML = gradeString[0].childNodes[0].nodeValue
          document.getElementById('motivationTimer').title = motivationTime[0].childNodes[0].nodeValue
          document.getElementById('prideTimer').title = prideTime[0].childNodes[0].nodeValue
          document.getElementById('battleTimer').title = battleTime[0].childNodes[0].nodeValue
          
          // debug
          //document.getElementById('info1').innerHTML = "success"
        }
        else alert("Ajax error2: No data received")
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
