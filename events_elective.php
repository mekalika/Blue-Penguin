<?php // events.php
// Copyright 2011 Bearslug Games. All Rights Reserved.

/**
  * @fileoverview: Fills in the ID card, and loads events based on grade,
  *                checking whether the event is available or not (time-wise).
  */

  // Log in to MySQL
  require_once 'header.php';
  require_once 'events.php';

  echo <<<_HTML
<script>
window.onload = getEvents($playerID, "E")
</script>

<!-- Subnavigation menu -->
<ul id="subnav">
  <li><a href="events_academic.php">Academics</a>
  <li class="selected"><a href="events_elective.php">Elective</a>
  <li><a href="events_life.php">Life</a>
</ul>

<!-- Events -->
<h2>Elective Events</h2>
<p>"Unlike your typical Western overscheduling soccer mom, the Chinese mother believes that...the only activities your children should be permitted to do are those in which they can eventually win a medal; and...that medal must be gold."<br><br>
<a href="#piano">Piano</a> <a href="#violin">Violin</a> <a href="#athletics">Athletics</a> <a href="#dance">Dance</a> <a href="#language">Language</a> <a href="#science">Science</a> <a href="#math">Math</a>
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
