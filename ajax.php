<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax Practice</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <style>
  .form-group{
    width: 30%;
  }
  .ajaxLoading{
   height:20px; width:100%; clear:both;
  }
  </style>
    <div class="container">
    <h1>Ajax practice</h1>
      <form action="ajaxSave.php" class="form-inline" role="form" id="ajaxForm" method="POST">
        <div class="form-group">
          <input type="text" name="inputAjax" id="inputAjax"  placeholder="Insert your name here" class="form-control">
        </div>
        <input type="submit" name="btnAjax" value="simpan" id="btnAjax" class="btn btn-primary">
      </form>
      <div class="ajaxLoading"></div>
      <div id="ajaxResult">Hasil:<br></div>
    </div>
  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
      $('#ajaxForm').submit(function(e){
        var postData = $(this).serializeArray();
        var postURL = $(this).attr("action");
        $(".ajaxLoading").html("<img src='images/loading.gif'>");
        $.ajax({
          url:postURL,
          type:"POST",
          data:postData,
          success:function(msg){
            $("#ajaxResult").append(msg);
            $('#ajaxForm')[0].reset();
             $(".ajaxLoading").html("");
          },
          error:function(msg){
            $("#ajaxResult").append(msg)
          }
        });

        e.preventDefault();
      });
    </script>
  </body>
</html>