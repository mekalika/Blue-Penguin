<?php // events_life.php
// Copyright 2011 Bearslug Games. All Rights Reserved.

/**
  * @fileoverview: Fills in the ID card, and loads events based on grade,
  *                checking whether the event is available or not (time-wise).
  */

  // Log in to MySQL
  require_once 'header.php';

  echo <<<_HTML
<script type="text/javascript" src="scripts/events.js"></script>
<!-- Subnavigation menu -->
<ul id="subnav">
  <li><a href="events_academic.php">Academics</a>
  <li><a href="events_elective.php">Elective</a>
  <li class="selected"><a href="events_life.php">Life</a>
</ul>

<!-- Events -->
<h2>Life Events</h2>
<p>Life events are a great opportunity to build character (motivation, pride, and battle) as well as improve other skills.<br><br>
"You need more character! When I was a kid..."<br>
<div id='eventResult'></div>
<div id='eventList'>a</div>
<script>
window.onload = getEvents($playerID, "L")
</script>
<!-- Sign and date the page, it's only polite! -->
<center><a href="tigermomgame.tumblr.com">Tiger Mom Game Blog</a>
<address>Copyright &copy 2012 Bearslug Games. All Rights Reserved.</address>
</center>
</body>
</html>


_HTML;

  mysql_close($db_server);
?>
