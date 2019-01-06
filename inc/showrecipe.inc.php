<?php
  // instantiate mysql interface and connect to mysql recipe database
  $con = new mysqli("localhost", "recipeuser", "recipe", "recipe");
  /* $con = mysql_connect("localhost", "test", "test") or die('Sorry, could not connect to server');
  mysql_select_db("recipe", $con) or die('Sorry, could not connect to database'); */

  // copy recipe id from get request array
  $recipeid = $_GET['id'];

  // SQL query for recipe with this recipeid
  $query = "SELECT title, poster, shortdesc, ingredients, directions "
         . "FROM recipes "
         . "WHERE recipeid = $recipeid";
  $result = $con->query($query)
      or die('Sorry, could not find recipe requested');
  /* $result = mysql_query($query) or die('Sorry, could not find recipe requested'); */

  $row = $result->fetch_assoc();
  /* $row = mysql_fetch_array($result, MYSQL_ASSOC) or die('No records retrieved'); */
  $title = $row['title'];
  $poster = $row['poster'];
  $shortdesc = $row['shortdesc'];
  $ingredients = nl2br($row['ingredients']);
  $directions = nl2br($row['directions']);

  echo "<h2>$title</h2>";
  echo "by $poster <br><br>\n";
  echo "$shortdesc<br><br>\n";
  echo "<h3>Ingredients:</h3>\n";
  echo "$ingredients<br><br>\n";
  echo "<h3>Directions:</h3>\n";
  echo "$directions<br><br>\n";

  // SQL query for number of comments for this recipeid
  $query = "SELECT COUNT(commentid) AS numcomments "
         . "FROM comments "
         . "WHERE recipeid = $recipeid";
  $result = $con->query($query);
  $row = $result->fetch_assoc();
  /* $result = mysql_query($query);
  $row = mysql_fetch_array($result); */

  if ($row['numcomments'] == 0) {
    echo "No comments posted yet.&nbsp;&nbsp;\n";
    echo "<a href=\"index.php?content=newcomment&id=$recipeid\"> "
       . "Add a comment</a>\n";
    echo "&nbsp;&nbsp;&nbsp;"
       . "<a href=\"print.php?id=$recipeid\" target=\"blank\">"
       . "Print recipe</a>\n";
    echo "<hr>\n";
  } else {
    echo $row['numcomments'] . "\n";
    echo "&nbsp;comments posted.&nbsp;&nbsp;\n";
    echo "<a href=\"index.php?content=newcomment&id=$recipeid\">"
       . "Add a comment</a>\n";
    echo "<hr>\n";
    echo "<h2>Comments:</h2>\n";
    // SQL query for comments on this recipeid
    $query = "SELECT date, poster, comment "
           . "FROM comments "
           . "WHERE recipeid = $recipeid "
           . "ORDER BY commentid DESC";
    $result = $con->query($query);
    /* $result = mysql_query($query) or die ('Could not retrieve comments'); */
    while ($row = $result->fetch_assoc()) {
    /* while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { */
      $date = $row['date'];
      $poster = $row['poster'];
      $comment = nl2br($row['comment']);
      echo "$date - posted by $poster<br>\n";
      echo "$comment\n";
      echo "<br><br>\n";
    } // end while
  } // end if/else
 ?>
