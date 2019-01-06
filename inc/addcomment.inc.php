<?php
  $recipeid = $_POST['recipeid'];
  $poster = addslashes($_POST['poster']);
  $comment = addslashes(htmlspecialchars($_POST['comment']));
  $date = date("Y-m-d");

  try {
    $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                   'recipeuser', 'recipe');

    $query = "INSERT INTO comments("
           . "recipeid, poster, date, comment) "
           . "VALUES("
           . "$recipeid, '$poster', '$date', '$comment')";

    $result = $pdo->query($query);

    if ($result)
      echo "<h2>Comment posted</h2>";
    else
      echo "<h2>Sorry, there was a problem posting your comment</h2>";
  } catch (PDOException $e) {
    echo "Sorry, could not connect to database server";
  } // end try/catch

  echo "<a href=\"index.php?content=showrecipe&id=$recipeid\">";
    echo "Return to recipe";
  echo "</a>";
 ?>
