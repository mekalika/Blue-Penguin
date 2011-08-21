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
window.onload = getEvents($playerID, "A")
</script>
<!-- Subnavigation menu -->
<ul id="subnav">
  <li class="selected"><a href="events_academic.php">Academics</a>
  <li><a href="events_elective.php">Elective</a>
  <li><a href="events_life.php">Life</a>
</ul>

<!-- Events -->
<h2>Academic Events</h2>
<p>"Chinese mothers believe their children can be "the best" students, that "academic achievement reflects successful parenting," and that if children did not excel at school then there was "a problem" and parents "were not doing their job."<br><br> 
Well, are you doing your job?<br><br>
<a href="#math">Math</a> <a href="#science">Science</a> <a href="#english">English</a> <a href="#history">History</a> <a href="#chinese">Chinese</a>
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
