<pre>
<?php
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=pemrograman_web','root', 'root');
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    $statement = $pdo->query("SELECT title FROM books WHERE title LIKE '$_GET[q]%'");
    while ( $row = $statement->fetch(PDO::FETCH_ASSOC)) {
      echo $row['title']."<br>";
    }
  }catch (Exception $error) {
      echo $error->getMessage();
    }
?>
</pre>