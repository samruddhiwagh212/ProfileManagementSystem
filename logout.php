<?php

session_start();

$_SESSION["user"] = NULL;
 $_SESSION["user_id"] = NULL;
 $_SESSION = NULL;
 
 session_unset();
 session_destroy();
  header("location:index.php");
?>
