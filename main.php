<?php // main.php
// Copyright 2011 Bearslug Games. All Rights Reserved.
  require_once 'header.php';
  
  echo <<<_HTML
<!-- Main content -->
<br>

<!-- General announcements -->
<div id="announce">
<center><strong>ANNOUNCEMENTS</strong></center>
<hr>
<p>Welcome to Battle of the Tiger Moms! Your
goal is to get your kid admission to top colleges at all costs. To 
succeed, you must push them in every way while making friends with other Tiger 
Moms. Each week in real life is equal to one grade here, and everyone is in the
same grade at the same time. Good luck!
<p class="date">October 7, 2011</p>
<p>Today is launch day! Our current priority is to release the "Compete"
feature, so be on the lookout for that. For now, we're sparing your
 Preschooler from being compared to your friends' kids.</p>
<p class="signature">Bearslug Games
</div>
<br>

<!-- Links to highlights of the game. -->
<!-- TODO: Make this into pretty images. -->
<center>
<a href="events_academic.php">Study</a>: Keep those grades up!</br>
<a href="reportcard.php">Report Card</a>: Keep an eye on your kid's progress.<br>
<a href="shop.php">Shop</a>: Your kid needs supplies for your chosen hobbies!<br><br>
</center>

<!-- Player-specific announcements -->
<!-- TODO: If player has skill points to spend, say so. -->
<!-- TODO: Tell player move to a better school district by inviting their friends. -->

<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> 
        <a href="forums.html">Forums</a>
        <a href="help.html">Help</a>
<address>Copyright &copy 2011 Bearslug Games. All Rights Reserved.</address>
</center>

<form action="logout.php" method="post"><pre>
<input type="submit" value="Logout" />
</pre></form>
Player ID: $playerID<br>
Student ID: $studentID

</body>
</html>
_HTML;

  mysql_close($db_server);
?>
