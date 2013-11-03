<?php
require_once("php-sdk/facebook.php");
  echo <<<_HTML
Hello world!<p></p>

<a href="signon.php">Play!</a><p></p>
<!--
<a href="create_char_page.php">Create character</a><p></p>
<a href="events.php">Events</a><p></p>
<a href="test.php">Test</a><p></p>
<a href="example.php">Test1</a><p></p>
-->
_HTML;

//$response = file_get_contents("https://graph.facebook.com/209275?fields=id,name");
  echo <<<_HTML
Goodbye world!<p></p>
_HTML;
?>
