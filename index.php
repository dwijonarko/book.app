<?php session_start()?>
<!DOCTYPE html>
<html>
  <head>
    <title>My Book App</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
  
  <div class="container">
      <form class="form-signin" role="form" action="" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      </form>
    </div>
<?php 
try {
  $pdo = new PDO('mysql:host=localhost;dbname=pemrograman_web','root', 'root');
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
  
  if (isset($_POST['login'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql ="SELECT username FROM users WHERE username=:username AND password=:password";
    $q = $pdo->prepare($sql);
    $q->execute(array(':username'=>$username,
                      ':password'=>sha1($password))
                );
    if ($q->execute()==true) {
      $row = $q->fetch(PDO::FETCH_ASSOC);
      if (!empty($row) && count($row)==1) {
        $_SESSION['username'] =  $row['username'];
        $_SESSION['login']=true;
        // if ($_SESSION['username']=="admin") {
        //   header("Location:index2.php"); //khusus admin
        // }else if($_SESSION['username']=="user"){
        //   header("Location:index4.php"); //khusus user
        // }
        header("Location:insert.php"); 
      }else{
        echo "Username atau password salah";
      }
        //echo $_SESSION['username'];
    }
  }
} catch (Exception $error) {
  echo $error->getMessage();
}
?>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>