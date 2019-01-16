<?php
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                   'recipeuser', 'recipe');

    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $query = "SELECT userid "
           . "FROM users "
           . "WHERE userid = '$userid' AND password = PASSWORD('$password')";
    $result = $pdo->query($query);
    $row = $result->fetch();
    if (!$row) {
      echo "<h2>Sorry, your user account was not validated.</h2>";
      echo "<a href=\"index.php?content=login\">Try again</a>";
      echo "<br>";
      echo "<a href=\"index.php\">Return to Home</a>";
    } else {
      $_SESSION['valid_recipe_user'] = $userid;
      echo "<h2>";
        echo "Your user account has been validated, ";
        echo "you can now post recipes and comments";
      echo "</h2>";
      echo "<br>";
      echo "<a href=\"index.php\">Return to Home</a>";
    } // end if/else
  } catch (PDOException $ex) {
    echo "<h2>";
      echo "Sorry, we cannot process your request at this time, ";
      echo "please try again later";
    echo "</h2>";
    echo "<a href=\"index.php?content=login\">Try again</a>";
    echo "<br>";
    echo "<a href=\"index.php\">Return to Home</a>";
  } // end try/catch
 ?>
