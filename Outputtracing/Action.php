<?php
  if (!isset($_COOKIE['user'])) {
    setcookie(
      'user',
      'Alice',
      time() + 3600
    ); // 1 hour
  } else {
    setcookie(
      'user',
      'Bob',
      time() + 3600
    );
  }
  header("Location: display.php");
  $_S
?>