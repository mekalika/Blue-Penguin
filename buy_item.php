<?php
  require_once 'botm_functions.php';
  session_start();

  if (isset($_POST['playerID']) && isset($_POST['itemID']) &&
      time() < $termEnd && time() > $termStart)
  {
    $playerID = sanitizeString($_POST['playerID']);
    $itemID = sanitizeString($_POST['itemID']);

    // Retrieve item properties
    $query = "SELECT * FROM items WHERE itemID=$itemID";
    $result = queryMysql($query);
    $row=mysql_fetch_array($result);
    $itemName   = $row['itemName'];
    $price      = $row['price'];
    $itemType   = $row['itemType'];
    echo "itemName: $itemName Price: $price<br>";

    // Retreive character properties
    $query = "SELECT * FROM characters,accounts WHERE accounts.studentID=characters.studentID
              AND accounts.playerID=$playerID";
    $result = queryMysql($query);
    $row=mysql_fetch_array($result);
    $studentID          = $row['studentID'];
    $expense            = $row['expense'];
    $cash = getCash($expense);
    echo "studentID: $studentID Cash: $cash";

    // See if item is already owned
    $query = "SELECT * FROM purchases WHERE studentID=$studentID AND itemID=$itemID";
    $purchased = queryMysql($query);

    // Check if you can buy the item
    if ($cash >= $price && mysql_num_rows($purchased) == 0)
    {
      // OK, you can buy the item
      // Increment expense
      $expense += $price;
      $query = "UPDATE characters SET expense=$expense";
      $result = queryMysql($query);

      // Update purchases table
      $query = "INSERT INTO purchases (studentID, itemID) VALUES ($studentID, $itemID)";
      $result = queryMysql($query);
    }
  }

  mysql_close($db_server);
?>
