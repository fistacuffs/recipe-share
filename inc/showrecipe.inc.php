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
  $totrecords = $row['numcomments'];
  /* $result = mysql_query($query);
  $row = mysql_fetch_array($result); */

  if ($totrecords == 0) {
    echo "No comments posted yet.&nbsp;&nbsp;\n";
    echo "<a href=\"index.php?content=newcomment&id=$recipeid\"> "
       . "Add a comment</a>\n";
    echo "&nbsp;&nbsp;&nbsp;"
       . "<a href=\"print.php?id=$recipeid\" target=\"blank\">"
       . "Print recipe</a>\n";
    echo "<hr>\n";
  } else {
    // get comments page number from request array
    if (!isset($_GET['page']))
      $thispage = 1;
    else
      $thispage = $_GET['page'];

    // calc pages
    $recordsperpage = 5;
    $offset = ($thispage - 1) * $recordsperpage;
    $totpages = ceil($totrecords / $recordsperpage);

    echo $totrecords . "\n";
    echo "&nbsp;comments posted.&nbsp;&nbsp;\n";
    echo "<a href=\"index.php?content=newcomment&id=$recipeid\">"
       . "Add a comment</a>\n";
    echo "<hr>\n";
    echo "<h2>Comments:</h2>\n";
    // SQL query for this page of comments on this recipeid
    $query = "SELECT date, poster, comment "
           . "FROM comments "
           . "WHERE recipeid = $recipeid "
           . "ORDER BY commentid DESC "
           . "LIMIT $offset, $recordsperpage";
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

    // comment page navigation
    // previous page link
    if ($thispage > 1) {
      $page = $thispage - 1;
      $prevpage = "<a href=\"index.php?content=showrecipe"
                . "&id=$recipeid&page=$page\">Previous</a>";
    } else {
      $prevpage = "";
    } // end if/else

    // individual page links if multiple pages
    $bar = "";
    if ($totpages > 1) {
      for ($page = 1; $page <= $totpages; $page++) {
        if ($page == $thispage)
          $bar .= "$page";
        else
          $bar .= " <a href=\"index.php?content=showrecipe"
                . "&id=$recipeid&page=$page\">$page</a> ";
      } // end for
    } // end if

    // next page link
    if ($thispage < $totpages) {
      $page = $thispage + 1;
      $nextpage = " <a href=\"index.php?content=showrecipe"
                . "&id=$recipeid&page=$page\">Next</a>";
    } else
      $nextpage = "";

    echo "GoTo: " . $prevpage . $bar . $nextpage;
  } // end if/else
 ?>
