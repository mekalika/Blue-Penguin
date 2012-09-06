<?php // events.php
// Copyright 2011 Bearslug Games. All Rights Reserved.

/**
  * @fileoverview: Fills in the ID card, and loads events based on grade,
  *                checking whether the event is available or not (time-wise).
  */

  // Log in to MySQL
  require_once 'header.php';

  echo <<<_HTML
<script src="scripts/sliding.js"></script>
<script src="scripts/shop.js"></script>

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
trimGlider()
</script>
<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> <a href="forums.html">Forums</a> <a href="help.html">Help</a>
<address>Copyright &copy 2011 Bearslug Games. All Rights Reserved.</address>
</center>
</body>
</html>
_HTML;

  mysql_close($db_server);
?>
