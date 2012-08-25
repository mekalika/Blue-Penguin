<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']))
  {
    $playerID = sanitizeString($_POST['playerID']);
    
    // Get item list
    $query = "SELECT items.*,accounts.studentID FROM items LEFT JOIN purchases
              ON purchases.itemID=items.itemID LEFT JOIN accounts ON
              purchases.studentID=accounts.studentID AND accounts.playerID=$playerID ORDER BY items.itemType,items.price";
    $result = queryMysql($query);
    
    $alt = 0;
    $prevItemType = '';
    echo '<div id="wrapper"><div class="gliding">';
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

      /*if ($prevItemType != $itemType) {
        if ($prevItemType != '') {
          echo '</span>';
        }
        echo '<span class="gliding-content" title=$category>';
        echo "<h2>$itemType</h2>";
        $prevItemType = $itemType;
      }*/
      // Sort events into categories for slider
      if ($prevItemType != $itemType && $itemType != '') {
        if ($prevItemType != '') {
          echo '</span>';
        }
        echo "<span class=\"gliding-content\" title=$itemType>";
        echo "<h2>$itemType</h2>";
        $prevItemType = $itemType;
      }

      if ($alt % 2 == 0) {
    echo <<<_HTML
<table id="items">
<tr class="itemname">
  <td><img src="$picture" width="128" height="128"></td>
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
  <td><img src="$picture" width="128" height="128"></td>
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
  echo "</div></div>";
  }
  else
  {
    //header( 'Location: logout.php' );
  }
?>
