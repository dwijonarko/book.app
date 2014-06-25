<?php session_start() ;
if (isset($_SESSION['login'])&& $_SESSION['login']==true) {
?>
<!DOCTYPE html>
<html>
  <head>
    <title>PDo MySQL</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
      padding-top: 20px;
      padding-bottom: 20px;
    }

    .navbar {
      margin-bottom: 20px;
    }
    </style>
  </head>
  <body>
  <div class="container">
  <?php include "navbar.php" ?>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">  <fieldset>
    <legend>Form Input Buku</legend>
  
  <form action="ajaxSave.php" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal" id="ajaxForm">
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Title</label>
    <div class="col-sm-10">
      <input type="text" id="title" name="title" required class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="author" class="col-sm-2 control-label">Author</label>
    <div class="col-sm-10">
      <input type="text" id="author" name="author" required class="form-control">        
    </div>
  </div>
  <div class="form-group">
    <label for="decription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <textarea name="description" id="description" cols="30" rows="10" required class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="on_sale" class="col-sm-2 control-label">On Sale</label>
    <div class="col-sm-10 col-sm-offset-2">
      <div class="checkbox">
        <label for="yes"><input type="radio" name="on_sale" value="1" id="yes" checked="true">Yes</label>
        <label for="no"><input type="radio" name="on_sale" value="0" id="no">No</label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="cover" class="col-sm-2 control-label" >Cover</label>
    <div class="col-sm-10">
          <input type="file" name="cover" class="form-control" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" name="submit" value="Save" class="btn btn-default"> <input type="reset" class="btn btn-default">
    </div>    
  </div>
  </form>
</fieldset>
<div class="ajaxLoading"></div>
<div id="ajaxResult">
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
    $pdo = new PDO('mysql:host=localhost; dbname=pemrograman_web', 'root', 'root');
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    
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
  </div>
  </fieldset>
</div>
    <div class="col-md-2"></div>
  </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    $('#ajaxForm').submit(function(e){
        var postData = new FormData(this);
        var postURL = $(this).attr("action");
        $(".ajaxLoading").html("<img src='images/loading.gif'>");
        $.ajax({
          url:postURL,
          type:"POST",
          data:postData,
          mimeType:"multipart/form-data",
          contentType:false,
          cache:false,
          processData:false,
          success: function(msg, status, xhr){ 
            var ct = xhr.getResponseHeader("content-type") || "";
            if (ct.indexOf('html') > -1) {
             $("#ajaxResult").html(msg);
             $('#ajaxForm')[0].reset();
             $(".ajaxLoading").html(""); 
            }
            if (ct.indexOf('json') > -1) {
              var obj = $.parseJSON(msg);
              alert(obj["msg"]);
             // $("#ajaxResult").html(obj["response"]);
              // $('#ajaxForm')[0].reset();
              // $(".ajaxLoading").html("");  
            } 
          }
          ,
          error:function(msg){
            $("#ajaxResult").append(msg)
          }
        });

        e.preventDefault();
      });
  </script>
  </body>
</html>

<?php    
}else{
      header( "refresh:2;index.php" );
      echo("Login dulu");
}
?>
