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
<script type="text/javascript" src="scripts/events.js"></script>

<!-- Subnavigation menu -->
<ul id="subnav">
  <li><a href="events_academic.php">Academics</a>
  <li class="selected"><a href="events_elective.php">Elective</a>
  <li><a href="events_life.php">Life</a>
</ul>

<!-- Events -->
<h2>Elective Events</h2>
<p>"Unlike your typical Western overscheduling soccer mom, the Chinese mother believes that...the only activities your children should be permitted to do are those in which they can eventually win a medal; and...that medal must be gold."<br><br>
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
<div id='eventResult'></div>
<div id='eventList'>a</div>
</center>
<script>
window.onload = getEvents($playerID, 'E')
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
