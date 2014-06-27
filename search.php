<!DOCTYPE html>
<html lang="en">
  <head>
    <title>AJAX search data</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
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
      <form action="save.php" class="form-inline" role="form" id="ajaxForm">
        <div class="form-group">
          <input type="text" name="inputAjax" id="inputAjax"  placeholder="Insert your name here" class="form-control">
        </div>
      </form>
      <div class="ajaxLoading"></div>
      <div id="ajaxResult">Hasil:<br></div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $("#inputAjax").keyup(function(){
      if ($(this).val()!==''){
        var formData = $("#inputAjax").val();
        var formAction = $("#ajaxForm").attr("action");
        $(".ajaxLoading").html("<img src='images/loading.gif'>");
        $.ajax({
          url:formAction,
          type:"GET",
          data:"q="+formData,
          success:function(msg){
            $("#ajaxResult").html(msg);
            $(".ajaxLoading").html("");
          },
          error:function(msg){
            $("#ajaxResult").append(msg)
          }
        });        
      }else{
        $("#ajaxResult").html("");
      }

    });
    </script>
  </body>
</html>