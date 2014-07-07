<!DOCTYPE html>
<html>
  <head>
    <title>Import Excel</title>
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
    <h1>Import from excel</h1>
    <form class="form-inline" role="form" action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label class="sr-only" for="exampleInputEmail2">Upload Excel File (*.xls, *.xlsx)</label>
        <input type="file" class="form-control" id="uploadedFile" name="uploadedFile">
      </div>
      <button type="submit" class="btn btn-default" name="import">Import</button>
    </form>
    <?php 
     if (isset($_POST['import'])) {
        $data = $_FILES['uploadedFile']['tmp_name'];
        require 'excel_reader2.php';
        $data = new Spreadsheet_Excel_Reader($data);
        echo "<table class='table'>";
        $baris = $data->rowcount($sheet_index=0);
        for ($i=2; $i<=$baris; $i++) {
          $id = $data->val($i,1);
          $title = $data->val($i,2);
          $author = $data->val($i,3);
          $description = $data->val($i,4);
          $on_sale = $data->val($i,5);
          $cover = $data->val($i,6);
          echo "<tr>";
          echo "<td>$id</td><td>$title</td><td>$author</td><td>$description</td><td>$on_sale</td><td>$cover</td>";
          echo "</tr>";
        }
        echo "</table>";
    }?>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>