<!doctype html>
<html xmlns="http://wwww.w3.org/1999/xhtml">

<head>
  <link rel="stylesheet" type="text/css" href="styles/print.css" />
  <title>The Recipe Center</title>
</head>

<body>
  <?php
    try {
      // connect to database
      $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                     'recipeuser', 'recipe');

      // copy recipe id from GET variable array and build SQL query to search
      // for it
      $recipeid = $_GET['id'];
      $query = "SELECT title, poster, shortdesc, ingredients, directions "
             . "FROM recipes "
             . "WHERE recipeid = $recipeid";

      // execute query
      $result = $pdo->query($query);

      if ($row = $result->fetch()) {
        $title = $row['title'];
        $poster = $row['poster'];
        $shortdesc = $row['shortdesc'];
        $ingredients = nl2br($row['ingredients']);
        $directions = nl2br($row['directions']);

        echo "<h2>$title</h2>";
        echo "posted by $poster";
        echo "<br>";
        echo $shortdesc;
        echo "<h3>Ingredients:</h3>";
        echo $ingredients;
        echo "<br>";
        echo "<h3>Directions:</h3>";
        echo $directions;
      } else {
        echo "<h2>No records retrieved</h2>";
      } // end if/else
    } catch (PDOException $ex) {
      echo "Sorry, could not connect to database server";
    } // end try/catch
   ?>
</body>

</html>
