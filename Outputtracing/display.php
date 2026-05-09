<html><head></head>
<body>
<?php
  if (isset($_COOKIE['user'])) {
    echo "<p>Welcome back, "
       . $_COOKIE['user']
       . "!</p>";
  } else {
    echo "<p>No user cookie found.</p>";
  }
?>
<button>
  <a href="action.php">
    Set Cookie
  </a>
</button>
</body></html>