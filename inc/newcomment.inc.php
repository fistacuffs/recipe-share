<?php
  $recipeid = $_GET['id'];

  if (!isset($_SESSION['valid_recipe_user'])) {
    echo "<h2>Sorry, you do not have permission to post comments</h2>";
    echo "<br>";
    echo "<a href=\"index.php?content=login\">";
      echo "Please login to post comments";
    echo "</a>";
    echo "<br>";
    echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">";
      echo "Go back to recipe";
    echo "</a>";
  } else {
    $userid = $_SESSION['valid_recipe_user'];

    echo "<form action=\"index.php\" method=\"post\">";
      echo "<h2>Enter your comment</h2>";
      echo "<textarea rows=\"10\" cols=\"50\" name=\"comment\"></textarea>";
      echo "<br>";

      echo "<input type=\"hidden\" name=\"poster\" value=\"$userid\">";
      echo "<input type=\"hidden\" name=\"recipeid\" value=\"$recipeid\">";
      echo "<input type=\"hidden\" name=\"content\" value=\"addcomment\">";

      echo "<br>";
      echo "<input type=\"submit\" value=\"Submit\">";
    echo "</form>";
  }
 ?>
