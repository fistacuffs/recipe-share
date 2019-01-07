<?php
  try {
    // connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                   'recipeuser', 'recipe');

    // separate search phrase into array of individual terms and recombine
    // with wildcards and query keywords
    $searchPhrase = $_GET['searchFor'];
    $terms = explode(" ", $searchPhrase);
    $formattedPhrase = implode("%' AND title LIKE '%", $terms);

    // build SQL query with formatted search phrase
    $query = "SELECT recipeid, title, shortdesc "
           . "FROM recipes "
           . "WHERE title LIKE '%$formattedPhrase%'";

    // execute query
    $result = $pdo->query($query);

    // output results of query
    echo "<h1>Search Results</h1>";
    echo "<br>";
    echo "<br>";
    if ($result->rowCount() == 0)
      echo "<h2>Sorry, no recipes were found containing '$searchPhrase'</h2>";
    else {
      while ($row = $result->fetch()) {
        // pull information from db query results
        $recipeid = $row['recipeid'];
        $title = $row['title'];
        $shortdesc = $row['shortdesc'];
        // create hyperlink to recipe
        echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">";
          echo "$title";
        echo "</a>";
        echo "<br>";
        echo "$shortdesc";
        echo "<br>";
        echo "<br>";
      } // end while
    } // end if/else
  } catch (PDOException $e) {
    echo "Sorry, could not connect to database server";
  } // end try/catch
 ?>
