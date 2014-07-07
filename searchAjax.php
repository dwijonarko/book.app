<?php session_start() ?>
<table class="table table-condensed table-hover">
  <tr>
    <th>ID</th>
    <th>TITLE</th>
    <th>AUTHOR</th>
    <th>DESCRIPTION</th>
    <th>ON Sale</th>
    <th>Cover</th>
    <th></th>
  </tr>
<?php 
//sleep(2);
try {
  $pdo = new PDO('mysql:host=localhost;dbname=pemrograman_web','root', 'root');
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
  $statement = $pdo->query("SELECT * FROM books WHERE title LIKE '$_GET[q]%'");
  while ( $row = $statement->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>";
      echo "<td>".htmlentities($row['id'])."</td>";
      echo "<td>".htmlentities($row['title'])."</td>";
      echo "<td>".htmlentities($row['author'])."</td>";
      echo "<td>".htmlentities($row['description'])."</td>";
      echo "<td>";
        echo(htmlentities( $row['on_sale'])==0) ? 'No' : 'Yes';
      echo "</td>";
      echo "<td> <img src='upload/".htmlentities($row['cover'])."' width='100px'></td>";
      if ($_SESSION['username']=='admin') {
            echo "<td><a href='edit.php?id=".htmlentities($row['id'])."'>Edit</a> 
                <a href='delete.php?id=".htmlentities($row['id'])."'>Delete</a></td>";  
          }
      echo "</tr>";
    }

}catch (Exception $error) {
    echo $error->getMessage();
  }
 ?>
 </table>