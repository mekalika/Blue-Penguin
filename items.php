<?php
  require_once 'botm_functions.php';
  require_once 'header.php';

  if (isset($_SESSION['playerID']))
  {
    $playerID = sanitizeString($_SESSION['playerID']);
    
    // Get all items the player has purchased
    $query = "SELECT * FROM accounts LEFT JOIN purchases ON accounts.studentID=purchases.studentID
              LEFT JOIN items ON purchases.itemID=items.itemID WHERE playerID=$playerID";
    $result = queryMysql($query);

    echo <<< _HTML
<!-- Items -->
<h2>Items</h2>
<p>These are your tools of the trade for raising the perfect tiger cub.<br><br>
_HTML;

    $time = time();
    while($row=mysql_fetch_array($result)) {
      $studentID        = $row['studentID'];
      $itemID           = $row['itemID'];
      $itemName         = $row['itemName'];
      $itemType         = $row['itemType'];
      $description      = $row['description'];
      $picture          = $row['picture'];
      $bonus            = $row['bonus'];
      $rank             = $row['rank'];
      $itemSkill        = $row['itemSkill'];
      $price            = $row['price'];
      
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
  <td>Purchased</td>
</tr>
</table><br><br>
_HTML;
    }
  }
  else
  {
    //header( 'Location: logout.php' );
  }
  
  mysql_close($db_server);
?>
