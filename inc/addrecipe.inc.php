<?php
  $title = addslashes($_POST['title']);
  $poster = addslashes($_POST['poster']);
  $shortdesc = addslashes($_POST['shortdesc']);
  $ingredients = addslashes(htmlspecialchars($_POST['ingredients']));
  $directions = addslashes(htmlspecialchars($_POST['directions']));

  if (trim($poster) == "") {
    echo "<h2>Sorry, each recipe must have a poster</h2>";
  } else {
    try {
      $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                     'recipeuser', 'recipe');
    } catch (PDOException $e) {
      echo "Sorry, could not connect to database server";
    } // end try/catch

    $query = "INSERT INTO recipes("
           . "  title, shortdesc, poster, ingredients, directions) "
           . "VALUES("
           . "  '$title', '$shortdesc', '$poster', '$ingredients', "
           . "  '$directions')";
    $result = $pdo->query($query);

    if ($result) {
      echo "<h2>Recipe posted</h2>";
    } else {
      echo "<h2>Sorry, there was a problem posting your recipe</h2>";
    } // end if/else
  } // end if/else
 ?>
