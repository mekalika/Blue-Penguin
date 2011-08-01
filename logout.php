<?php // logout.php
// Copyright 2011 M.G.Twice. All Rights Reserved.

  function logout() {
    session_start();
    $_SESSION = array();
    if (session_id() != "" || isset($_COOKIE[username])) {
      setcookie('username', '', 0,'/');
      session_destroy();
    }
    header( 'Location: index.html' );
  }

  require_once 'botm_functions.php';
  logout();
    
?>
