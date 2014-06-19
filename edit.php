<?php 
session_start();
if (isset($_SESSION['login'])&& $_SESSION['login']==true) {
    if ($_SESSION['username']!='admin') {
      header( "refresh:1;insert.php" );
      echo "<p>Halaman khusus Admin</p>";
    }else{ ?>
      <html>
        <head>
          <title>Edit Data</title>
          <link rel="stylesheet" href="css/bootstrap.min.css">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
          <body>
    <?php 
    try {
      if (!isset($_GET['id'])) {
        header("Location:insert.php");
      }
      $pdo = new PDO('mysql:host=localhost; dbname=pemrograman_web','root', 'root');
      $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );  
      $statement = $pdo->query("SELECT * FROM books WHERE id='$_GET[id]'");
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      if (empty($row)) {
        header("Location:insert.php");
      }
      
      if (isset($_POST['submit'])) {
      $title = htmlentities($_POST['title']);
      $author = htmlentities($_POST['author']);
      $description = htmlentities($_POST['description']);
      $on_sale=htmlentities($_POST['on_sale']);
      $id=htmlentities($_GET['id']);

      /*query*/
      $sql ="UPDATE `books` SET `title` = :title,
                              `author`= :author,
                              `description`= :description,
                              `on_sale`=:on_sale 
                          WHERE `id`=:id";
      $q = $pdo->prepare($sql);
      $q->execute(array(':id'=>$id,
                        ':author'=>$author,
                        ':title'=>$title,
                        ':description'=>$description,
                        ':on_sale'=>$on_sale)
                  );
        if ($q->execute()==true){
          header("Location:insert.php");
        }
      }

    } catch (Exception $error) {
      echo $error->getMessage();
    }
    ?>
    <div class="container">
    <?php include "navbar.php" ?>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <fieldset>
        <form action="" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal">
        <div class="form-group">
          <label for="title" class="col-sm-2 control-label">Title</label>
          <div class="col-sm-10">
            <input type="text" id="title" name="title" required class="form-control" value="<?php echo $row['title']?>">
          </div>
        </div>
        <div class="form-group">
          <label for="author" class="col-sm-2 control-label">Author</label>
          <div class="col-sm-10">
            <input type="text" id="author" name="author" required class="form-control" value="<?php echo $row['author']?>">        
          </div>
        </div>
        <div class="form-group">
          <label for="decription" class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
            <textarea name="description" id="description" cols="30" rows="10" required class="form-control"><?php echo $row['description']?>"</textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="on_sale" class="col-sm-2 control-label">On Sale</label>
          <div class="col-sm-10 col-sm-offset-2">
            <div class="checkbox">
              <label for="yes"><input type="radio" name="on_sale" value="1" id="yes" <?php echo  (htmlentities($row['on_sale'])==1) ? "checked='true'" : ""; ?>> Yes</label>
      <label for="no"><input type="radio" name="on_sale" value="0" id="no" <?php echo  (htmlentities($row['on_sale'])==0) ? "checked='true'" : ""; ?> >No</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="cover" class="col-sm-2 control-label" >Cover</label>
          <div class="col-sm-10">
                <input type="file" name="cover" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="submit" value="Save" class="btn btn-default"> <input type="reset" class="btn btn-default">
          </div>    
        </div>
        </form>
        </fieldset>
      </div>
      </div>
    </row>
  </body>
</html>
<?php
  }
}else{
  header( "refresh:1;index.php" );
  echo "Anda harus login dulu";
}
?>

