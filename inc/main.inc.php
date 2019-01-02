<h2 align="center">The Latest Recipes</h2>
<br>
<?php
  // instantiate PDO and connect to mysql recipe database
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                   'recipeuser', 'recipe');
  } catch (PDOException $e) {
    echo "Sorry, could not connect to database server";
  } // end try/catch

  // SQL query for last five recipes from database
  $query = "SELECT recipeid, title, poster, shortdesc "
         . "FROM recipes "
         . "ORDER BY recipeid DESC "
         . "LIMIT 0, 5";
  $result = $pdo->query($query);
  // Check if query returned any rows
  if (!$result) {
    echo "<h3>There are no recipes posted at this time, "
       . "please try back later.</h3>";
  } else {
    // iterate through each row returned
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $recipeid = $row['recipeid'];
      $title = $row['title'];
      $poster = $row['poster'];
      $shortdesc = $row['shortdesc'];
      echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">$title</a> "
         . "submitted by $poster<br>\n";
      echo "$shortdesc<br><br>\n";
    } // end while
  } // end if/else

  /*
  $con = mysql_connect("localhost", "test", "test") or die('Sorry, could not connect to database server');
  mysql_select_db("recipe", $con) or die('Sorry, could not connect to database');
  $query = "SELECT recipeid, title, poster, shortdesc FROM recipes ORDER BY recipeid DESC LIMIT 0, 5";
  $result = mysql_query($query) or die('Sorry, could not get recipes at this time');
  if (mysql_num_rows($result) == 0) {
    echo "<h3>Sorry, there are no recipes posted at this time, please try back later.</h3>";
  } else {
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
      $recipeid = $row['recipeid'];
      $title = $row['title'];
      $poster = $row['poster'];
      $shortdesc = $row['shortdesc'];
      echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">$title</a> submitted by $poster<br>\n";
      echo "$shortdesc<br><br>\n";
    } // end while
  } // end if/else */
 ?>
