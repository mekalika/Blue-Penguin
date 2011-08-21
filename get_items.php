<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    
    // Get item list
    $query = "SELECT items.*,accounts.studentID FROM items LEFT JOIN purchases
              ON purchases.itemID=items.itemID LEFT JOIN accounts ON
              purchases.studentID=accounts.studentID AND accounts.playerID=$playerID";
    $result = queryMysql($query);
    
    while($row=mysql_fetch_array($result))
    {
      $itemName         = $row['itemName'];
      $price            = $row['price'];
      $itemType         = $row['itemType'];
      $description      = $row['description'];
      $picture          = $row['picture'];
      $bonus            = $row['bonus'];
      $rank             = $row['rank'];
      $itemSkill        = $row['itemSkill'];
      $itemID           = $row['itemID'];
      $studentID        = $row['studentID'];
      
      if(is_null($studentID))
        $buttonString = "<input type=\"button\" value=\"Purchase\" onClick=\"buyItem($playerID,$itemID)\">";
      else
        $buttonString = "Purchased";

    echo <<<_HTML
<table id="events">
<tr class="eventname">
  <td colspan="2">$itemName</td>
  <td width = 15%>$$price</td>  
</tr>
<tr class="eventdescription">
<td colspan="3">$description</td></tr>
<tr>
  <td colspan="3"></td>
</tr>
<tr>
  <td width = 15%><img src="images/$picture"></td>
  <td>$itemType</td>
  <td>$buttonString</td>
</tr>
</table><br><br>
_HTML;
    }
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>