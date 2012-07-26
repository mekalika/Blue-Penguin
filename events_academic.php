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
  <li class="selected"><a href="events_academic.php">Academics</a>
  <li><a href="events_elective.php">Elective</a>
  <li><a href="events_life.php">Life</a>
</ul>

<!-- Events -->
<h2>Academic Events</h2>
<p>"Chinese mothers believe their children can be "the best" students, that "academic achievement reflects successful parenting," and that if children did not excel at school then there was "a problem" and parents "were not doing their job."<br><br> 
Well, are you doing your job?<br><br>
<center>
<div class="control-panel">
<ul class="control-list">
  <li id ="1">Chinese</li>
  <li id ="2">English</li>
  <li id ="3">History</li>
  <li id ="4">Math</li>
  <li id ="5">Science</li>
</ul>
</div>
<div id='eventResult'></div>
<div id='eventList'>a</div>
</center>
<script>
window.onload = getEvents($playerID, "A")
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
