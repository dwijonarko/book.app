<?php 
session_start();
if (isset($_SESSION['login'])&& $_SESSION['login']==true) {
    if ($_SESSION['username']!='admin') {
      header( "refresh:1;insert.php" );
      echo "<p>Halaman khusus Admin</p>";
    }else{ 
      if (isset($_GET['id'])) {
        try {
          $pdo = new PDO('mysql:host=localhost; dbname=pemrograman_web','root', 'root');
          $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );  
          $statement = $pdo->query("DELETE FROM books WHERE id='$_GET[id]'");
          if ($statement==true){
              header("Location:insert.php");
            }   
        } catch (Exception $error) {
          echo $error->getMessage();
        }
      }else{
        header("location:insert.php");
      }
    }
}else{
  header( "refresh:1;index.php" );
  echo "Anda harus login dulu";
}
 ?>
