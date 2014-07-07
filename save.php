<?php session_start() ?>
<fieldset>
  <legend>Daftar Buku</legend>

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
  try {
    $pdo = new PDO('mysql:host=localhost;
    dbname=pemrograman_web',
    'root', 'root');
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    
    if (isset($_POST['submit'])) {

      $allowedExts = array("gif","jpeg","jpg","png");
      $temp = explode(".",$_FILES["cover"]["name"]);
      $extension = end($temp);
      if(
        (
          ($_FILES["cover"]["type"]== "image/gif")||
          ($_FILES["cover"]["type"]== "image/jpeg")||
          ($_FILES["cover"]["type"]== "image/jpg")||
          ($_FILES["cover"]["type"] == "image/pjpeg")||
              ($_FILES["cover"]["type"] == "image/x-png")||
              ($_FILES["cover"]["type"] == "image/png")
        )&& ($_FILES["cover"]["size"] < 100000)
         && in_array($extension,$allowedExts)
        ){
        if($_FILES["cover"]["error"]==0){
              if(file_exists("upload/" . $_FILES["cover"]["name"])){
                echo $_FILES["cover"]["name"] . " already exists. ";
              }else{
                move_uploaded_file($_FILES["cover"]["tmp_name"],"upload/" . $_FILES["cover"]["name"]);
                $title = htmlentities($_POST['title']);
                $author = htmlentities($_POST['author']);
                $description = htmlentities($_POST['description']);
                $on_sale=htmlentities($_POST['on_sale']);
                $cover = htmlentities($_FILES['cover']["name"]);

                /*query*/
                $sql ="INSERT INTO books (title,author,description,on_sale,cover) VALUES (:title,:author,:description,:on_sale,:cover)";
                $q = $pdo->prepare($sql);
                $q->execute(array(':author'=>$author,
                                  ':title'=>$title,
                                  ':description'=>$description,
                                  ':on_sale'=>$on_sale,
                                  ':cover'=>$cover)
                            );
              }
        }else{
            echo $_FILES["files"]["error"]."<br>";
        }
      }else{
        echo "Invalid file";
      }   
    }
    $statement = $pdo->query("SELECT * FROM books");
    while ( $row = $statement->fetch(PDO::FETCH_NUM)) {
      echo "<tr>";
      echo "<td>".htmlentities($row[0])."</td>";
      echo "<td>".htmlentities($row[1])."</td>";
      echo "<td>".htmlentities($row[2])."</td>";
      echo "<td>".htmlentities($row[3])."</td>";
      echo "<td>";
        echo(htmlentities( $row[4])==0) ? 'No' : 'Yes';
      echo "</td>";
      echo "<td> <img src='upload/".htmlentities($row[5])."' width='100px'></td>";
      if ($_SESSION['username']=='admin') {
            echo "<td><a href='edit.php?id=".htmlentities($row[0])."'>Edit</a> 
                <a href='delete.php?id=".htmlentities($row[0])."'>Delete</a></td>";  
          }
      echo "</tr>";
    }
  } catch (Exception $error) {
    echo $error->getMessage();
  }

  ?>
  </table>
  </fieldset>