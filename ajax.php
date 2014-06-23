<!DOCTYPE html>
<html>
  <head>
    <title>AJAX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="container">
    <h1>AJAX Example</h1>
    <form action="" role="form" id="formInput">
      <div class="form-group">
      <input type="text" name="username" class="form-input" id="username">
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
      </div>
    </form>
    <div class="result"></div>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $('#formInput').submit(function(e){
      var username = $('#username').val();
      $(".result").html(username);
      e.preventDefault();
    });
    </script>
  </body>
</html>