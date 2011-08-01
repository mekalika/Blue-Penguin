<?php // main.php
// Copyright 2011 M.G.Twice. All Rights Reserved.
  require_once 'header.php';
  
  echo <<<_HTML
<!-- Main content -->
<p>This is the home page. It should contain new announcements, in general for everyone, or specifically for the player ("You have skill points to spend!" or "Rumor has it that Kate has a new boyfriend! Squash him...") 

<p>There should also be a box that reminds you to invite friends ("Move to a better school district by inviting your friends to play!") 

<p>You can update your status message from here as well as from the report card page.

<p>Lastly, there can be (pretty/image) links to other sections of the game - events, shop, compete.

<!-- Sign and date the page, it's only polite! -->
<center><a href="blog.html">Blog</a> 
        <a href="forums.html">Forums</a>
        <a href="help.html">Help</a>
<address>Copyright &copy 2011 M.G.Twice. All Rights Reserved.</address>
</center>

<form action="logout.php" method="post"><pre>
<input type="submit" value="Logout" />
</pre></form>
Player ID: $playerID<br>
Student ID: $studentID

</body>
</html>
_HTML;
?>
