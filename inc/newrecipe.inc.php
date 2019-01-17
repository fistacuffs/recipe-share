<?php
  if (!isset($_SESSION['valid_recipe_user'])) {
    echo "<h2>Sorry, you do not have permission to post recipes</h2>";
    echo "<br>";
    echo "<a href=\"index.php?content=login\">";
      echo "Please login to post recipes";
    echo "</a>";
    echo "<br>";
    echo "<a href=\"index.php\">Return to Home</a>";
  } else {
    $userid = $_SESSION['valid_recipe_user'];

    echo "<form action=\"index.php\" method=\"post\">";
      echo "<h2>Enter your new recipe</h2>";
      echo "<br>";

      echo "Title:";
      echo "<input type=\"text\" size=\"40\" name=\"title\">";
      echo "<br>";

      echo "<input type=\"hidden\" name=\"poster\" value=\"$userid\">";

      echo "Short Desccription:";
      echo "<br>";
      echo "<textarea rows=\"5\" cols=\"50\" name=\"shortdesc\"></textarea>";
      echo "<br>";

      echo "<h3>Ingredients (one item per line)</h3>";
      echo "<textarea rows=\"10\" cols=\"50\" name=\"ingredients\"></textarea>";
      echo "<br>";

      echo "<h3>Directions</h3>";
      echo "<textarea rows=\"10\" cols=\"50\" name=\"directions\"></textarea>";
      echo "<br>";

      echo "<input type=\"submit\" value=\"Submit\">";
      echo "<input type=\"hidden\" name=\"content\" value=\"addrecipe\">";
    echo "</form>";
  } // end if/else
 ?>
