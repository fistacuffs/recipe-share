<?php
  $recipeid = $_GET['id'];

  echo "<form action=\"index.php\" method=\"post\">";
    echo "<h2>Enter your comment</h2>";
    echo "<textarea rows=\"10\" cols=\"50\" name=\"comment\"></textarea>";
    echo "<br>";

    echo "Submitted by:<input type=\"text\" name=\"poster\">";
    echo "<br>";

    echo "<input type=\"hidden\" name=\"recipeid\" value=\"$recipeid\">";
    echo "<input type=\"hidden\" name=\"content\" value=\"addcomment\">";
    echo "<br>";

    echo "<input type=\"submit\" value=\"Submit\">";
  echo "</form>";
 ?>
