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
          
          // Restore slider page
          setPage()
          
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