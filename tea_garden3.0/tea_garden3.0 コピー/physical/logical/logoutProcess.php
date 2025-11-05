<?php
  session_start();
  // unset($_SESSION['user_id']);
  // unset($_SESSION['myOrderhistory']);
  $_SESSION = array();
  session_destroy();
  header('Location: ./view/loginScreen.php');
  exit();
?>