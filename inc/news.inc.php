<h2>What's Cooking?</h2>
<h4><em>&nbsp;&nbsp;&nbsp;latest cooking news</em></h4>
<br>
<?php
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=recipe',
                   'recipeuser', 'recipe');
  } catch (PDOException $e) {
    echo "Sorry, could not connect to database server";
  } // end try/catch

  $query = "SELECT title, date, article "
         . "FROM news "
         . "ORDER BY date DESC "
         . "LIMIT 0, 2";
  $result = $pdo->query($query);
  if ($result->rowCount() < 1) {
    echo "<h3>There are no news articles posted at this time, "
       . "please try back later.</h3>";
  } else {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $title = $row['title'];
      $date = $row['date'];
      $article = nl2br($row['article']);
      echo "<h3>$title<h3>";
      echo "<h6>date: $date</h6>";
      echo "<p>$article</p>";
    } // end while
  } // end if/else
 ?>
