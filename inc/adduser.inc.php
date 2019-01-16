<?php
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                   'recipeuser', 'recipe');

    $userid = trim($_POST['userid']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $baduser = 0;

    // Ensure user entered a user id
    if ($userid == '' || $password == '') {
      echo "<h2>Sorry, you must enter a user name and password.</h2>";
      echo "<br>";
      echo "<a href=\"index.php?content=register\">Try again</a>";
      echo "<br>";
      echo "<a href=\"index.php\">Return to Home</a>";
      $baduser = 1;
    } // end if

    // Ensure confirmation password matches original
    if ($password != $password2) {
      echo "<h2>Sorry, the passwords you entered did not match.</h2>";
      echo "<br>";
      echo "<a href=\"index.php?content=register\">Try again</a>";
      echo "<br>";
      echo "<a href=\"index.php\">Return to Home</a>";
      $baduser = 1;
    } // end if

    // Check if user id already exists in database
    $query = "SELECT userid "
           . "FROM users "
           . "WHERE userid='$userid'";
    $result = $pdo->query($query);
    $row = $result->fetch();
    if ($row['userid'] == $userid) {
      echo "<h2>Sorry, that user name is already taken.</h2>";
      echo "<br>";
      echo "<a href=\"index.php?content=register\">Try again</a>";
      echo "<br>";
      echo "<a href=\"index.php\">Return to Home</a>";
      $baduser = 1;
    } // end if

    if ($baduser != 1) {
      // All checks passed. Register user in database
      $query = "INSERT INTO users "
             . "VALUES("
             . "'$userid', "
             . "PASSWORD('$password'), "
             . "'$fullname', "
             . "'$email')";
      $result = $pdo->query($query);

      // set session variable
      if ($result) {
        $_SESSION['valid_recipe_user'] = $userid;
        echo "<h2>";
          echo "Your registration request has been approved ";
          echo "and you are now logged in!";
        echo "</h2>";
        echo "<a href=\"index.php\">Return to Home</a>";
      } else {
        echo "<h2>";
          echo "Sorry, there was a problem processing your login request";
        echo "</h2>";
        echo "<br>";
        echo "<a href=\"index.php?content=register\">Try again</a>";
        echo "<br>";
        echo "<a href=\"index.php\">Return to Home</a>";
      } // end if/else
    } // end if
  } catch (PDOException $ex) {
    echo "<h2>";
      echo "Sorry, we cannot process your request at this time, ";
      echo "please try again later";
    echo "</h2>";
    echo "<a href=\"index.php?content=register\">Try again</a>";
    echo "<br>";
    echo "<a href=\"index.php\">Return to Home</a>";
  } // end try/catch
 ?>
