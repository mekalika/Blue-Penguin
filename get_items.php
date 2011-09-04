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
    
    $alt = 0;
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
        $buttonString = "<i>Purchased</i>";
    
      if ($alt % 2 == 0) {
    echo <<<_HTML
<table id="items">
<tr class="itemname">
  <td><img src="images/gr_piano.jpg"></td>
  <td width = 75%>
    <table width=100%>
      <tr>
        <td><strong>$itemName</strong><br>$$price</td>
      </tr>
      <tr class="itemdescription">
        <td>$description</td>
      </tr>
      <tr>
        <td align=right>$buttonString</td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <th colspan="2">Extra notes</th></td>
</tr>
</table><br>
_HTML;
      }
      else {
    echo <<<_HTML
<table id="altitems">
<tr class="altitemname">
  <td><img src="images/pianokeys.jpg"></td>
  <td width = 75%>
    <table width=100%>
      <tr>
        <td><strong>$itemName</strong><br>$$price</td>
      </tr>
      <tr class="altitemdescription">
        <td>$description</td>
      </tr>
      <tr>
        <td align=right>$buttonString</td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <th colspan="2">Extra notes</th></td>
</tr>
</table><br>
_HTML;
      
      }
      $alt++;
    }
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>
