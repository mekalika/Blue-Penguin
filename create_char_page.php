<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
  <title>Battle of the Tiger Moms Start Playing</title>
  
  <meta name="description" content="Battle of the Tiger Moms. By M.G.Twice.">
  <meta name="copyright" content="2011© Bearslug Games">
  <meta name="keywords" content="games, facebook, google plus, fun, tiger mom">

  <link rel="stylesheet" type="text/css" href="styles/style.css"/>
  
  <script type="text/javascript" src="scripts/jquery-1.2.6.min.js"></script>
  <script type="text/javascript">
  /*
  Thanks: Bit Repository
  Source: www.bitrepository.com/web-programming/ajax/username-checker.html 
  */

  $(document).ready(function() {

    $("#name").change(function() {

      var usr = $("#name").val();

      // Check for special characters
      var specialCharFound = false;
      var iChars = /[^a-zA-Z0-9 _-]/;
      for (var i = 0; i < usr.length; i++) {
        if (usr.match(iChars)) {     
          specialCharFound = true;
        }
      }

      if ((usr.length >= 1) && (usr.length <= 20)) {
        $("#status").html(
            '<img src="images/loader.gif" align="absmiddle">' +
            '&nbsp;Checking availability...');

        $.ajax({  
          type: "POST",  
          url: "check_name_availability.php",  
          data: "name="+ usr,  
          success: function(msg) { 
   
            $("#status").ajaxComplete(function(event, request, settings) { 
              if(msg == 'OK') { 
                // Check for special characters
                if (specialCharFound == true) {
                  $("#status").html(
                      '<font color="red">Sorry, only letters, numbers, ' +
                      'spaces, - and _ are allowed.</font>');
                  $("#name").removeClass('object_ok'); // if necessary
                  $("#name").addClass("object_error");
                }
                else {
                  $("#name").removeClass('object_error'); // if necessary
                  $("#name").addClass("object_ok");
                  $(this).html('&nbsp;<img src="images/tick.gif"' +
                               ' align="absmiddle">');
                }
              }  
              else {  
                $("#name").removeClass('object_ok'); // if necessary
                $("#name").addClass("object_error");
                $(this).html(msg);
              }    
            });
          } 
        }); 

      }
      else if (usr.length > 20) {
        $("#status").html(
            '<font color="red">Name must have <strong>20</strong> ' +
            'characters or less.</font>');
        $("#name").removeClass('object_ok'); // if necessary
        $("#name").addClass("object_error");
      }
      else {
        $("#status").html(''); // removes any existing status messages
        $("#name").removeClass('object_ok'); // if necessary
        $("#name").removeClass("object_error");
      }
    
    });

  });


/**
 * Validates the create character form, preventing the user from submitting 
 * if there is any invalid input.
 * @return {boolean} Returns true if form is valid, and false otherwise. 
 */
function validateForm() {
  //var x=document.forms["create"]["name"].value
  var x = $("#name").val();
  // Check for special characters and set specialCharFound to true if found
  var specialCharFound = false;
  var iChars = /[^a-zA-Z0-9 _-]/;
  for (var i = 0; i < x.length; i++) {
    if (x.match(iChars)) {     
      specialCharFound = true;
    }
  }
  // Name must be filled in
  if (x == null || x == "") {
    $("#status").html(
        '<font color="red">Please give your kid a name.</font>');
    $("#name").removeClass('object_ok'); // if necessary
    $("#name").addClass("object_error");
    return false;
  }
  // Length cannot be longer than 20 characters
  else if (x.length > 20) {
    $("#status").html(
        '<font color="red">Name must have <strong>20</strong> characters' +
        ' or less.</font>');
    $("#name").removeClass('object_ok'); // if necessary
    $("#name").addClass("object_error");
    return false;
  }
  // Name can only have letters, numbers, spaces, - and _
  else if (specialCharFound == true) {
    $("#status").html('<font color="red">Sorry, only letters, numbers, ' +
                      'spaces, - and _ are allowed.</font>');
    $("#name").removeClass('object_ok'); // if necessary
    $("#name").addClass("object_error");
    return false;
  }
  // Check that name is unique
  $(document).ready(function() {
    $.ajax({ 
      async: false, 
      type: "POST",  
      url: "check_name_availability.php",  
      data: "name="+ x,  
      success: function(msg) {
        
          if (msg == 'OK') { 
            $("#create").submit();
            return true;
          }
          else {
            $("#name").removeClass('object_ok'); // if necessary
            $("#name").addClass("object_error");
            $("#status").html(msg);          
            return false;
          } 
      }
    });
  });
  return false;
}

  </script>
 </head>
 <div id="container">
<body>
<center>
<div align="center">
<h2 align="center">Battle of the Tiger Moms</h2>

<center>
Every tiger mom or dad needs a tiger cub, so start playing by creating 
yours!<br /><br />

<!-- The form! -->
<form id='create' action="create_character.php" 
         onsubmit="return validateForm()" method="post">
  <table width="700" border="0">  
    <tr>
      <td width="200">
        <div align="right">
        <label for='name'>Name:&nbsp;</label>
      </td>
</div>
      <td width="100">
        <input id="name" size="20" type="text" name="name" 
         onChange="javascript:

         while(''+this.value.charAt(this.value.length-1)==' ')
           this.value=this.value.substring(0,this.value.length-1);
         while(''+this.value.charAt(0)==' ')
           this.value=this.value.substring(1,this.value.length);">
       </td>
      <td width="400" align="left"><div id="status"></div></td>
    </tr> 

    <tr>
      <td width="200"><div align="right">Gender:&nbsp;</div></td>
      <td width="100"><select name="gender">
                      <option value="0">Male</option>
                      <option value="1">Female</option>
                      </select> 
      <td width="400" align="left"><div id="status"></div></td>
    </tr> 

    <tr>
      <td width="200"><div align="right"></div></td>
      <td width="100">
        <input size="20" type="submit" name='Submit' value="GIVE BIRTH!">
      </td>
      <td width="400" align="left"><div id="status"></div></td>
    </tr> 
  </table>
</form>

</div>
</center>

<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a>
        <a href="forums.html">Forums</a>
        <a href="help.html">Help</a>
<address>Copyright &copy 2011 Bearslug Games. All Rights Reserved.</address>
</center>
</div>
</body>
</html>
