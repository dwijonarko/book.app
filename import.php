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
        try {
        $pdo = new PDO('mysql:host=localhost;dbname=pemrograman_web','root', 'root');
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $sql ="INSERT INTO books (title,author,description,on_sale,cover) VALUES (:title,:author,:description,:on_sale,:cover)";
        $data = $_FILES['uploadedFile']['tmp_name'];
        $q = $pdo->prepare($sql);
        require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($data);
        echo "<p> Last imported data</p>";
        echo "<table class='table'>";
        foreach ($objPHPExcel->getActiveSheet()->getRowIterator(3) as $row){
          echo "<tr>";
          $val=array();
          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          
          foreach ($cellIterator as $index => $cell) {
              $val[]=$cell->getValue();
          }
          if($q->execute(array(':author'=>$val[1],':title'=>$val[2],':description'=>$val[3],':on_sale'=>$val[4],':cover'=>$val[5]))){
            echo "<td>$val[0]</td><td>$val[1]</td><td>$val[2]</td><td>$val[3]</td><td>$val[4]</td><td>$val[5]</td>";
          }
          echo "</tr>";
        }
        echo "</table>";
      }catch(Exception $error) {
        echo $error->getMessage();
      }
    }
    ?>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

