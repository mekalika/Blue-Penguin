<?php
  require_once 'botm_functions.php';
  require_once 'header.php';

  if (isset($_SESSION['playerID']))
  {
    $playerID = sanitizeString($_SESSION['playerID']);
    
    // Get all items the player has purchased
    $query = "SELECT * FROM purchases LEFT JOIN accounts ON accounts.studentID=purchases.studentID
              LEFT JOIN items ON purchases.itemID=items.itemID WHERE playerID=$playerID";
    $result = queryMysql($query);

    echo <<< _HTML
<!-- Subnavigation menu -->
<ul id="subnav">
  <li><a href="reportcard.php">Report Card</a>
  <li class="selected"><a href="items.php">Items</a>
  <li><a href="traits.php">My Traits</a>
  <li><a href="school.php">My School</a>
</ul>

<!-- Items -->
<h2>Items</h2>
<p>These are your tools of the trade for raising the perfect tiger cub.<br><br>
_HTML;

    $time = time();
    $alt = 0;
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
  <td><img src="images/gr_piano.jpg"></td>
  <td width = 75%>
    <table width=100%>
      <tr>
        <td><strong>$itemName</strong><br>$$price</td>
      </tr>
      <tr class="altitemdescription">
        <td>$description</td>
      </tr>
      <tr>
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
  
  mysql_close($db_server);
?>
