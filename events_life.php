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
<script>
window.onload = getEvents($playerID, "L")
</script>
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
$time
<div id='info'>b</div>
<div id='info1'>c</div>
<a href='javascript:;' onclick='temp();'>test</a>
<a href="refresh_header.php">test2</a>
<div id="test" name="countdownTimer" title=500></div><br>
<div id="test2" name="countdownTimer" title=300></div><br>

<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> <a href="forums.html">Forums</a> <a href="help.html">Help</a>
<address>Copyright &copy 2011 Bearslug Games. All Rights Reserved.</address>
</center>
</body>
</html>


_HTML;

  mysql_close($db_server);
?>