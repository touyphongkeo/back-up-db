<?php 
  header('Content-Type: text/html; charset=utf-8');
$message = '';
if(isset($_POST["import"]))
{
 if($_FILES["database"]["name"] != '')
 {
  $array = explode(".", $_FILES["database"]["name"]);
  $extension = end($array);
  if($extension == 'sql')
  {
   $connect = mysqli_connect("localhost", "root", "", "apis_yokjork");
   $output = '';
   $count = 0;
   $file_data = file($_FILES["database"]["tmp_name"]);
   foreach($file_data as $row)
   {
    $start_character = substr(trim($row), 0, 2);
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
     if($end_character == ';')
     {
      if(!mysqli_query($connect, $output))
      {
       $count++;
      }
      $output = '';
     }
    }
   }
   if($count > 0)
   {
    $message = '<label class="text-danger" style="font-family:phetsarath ot;">404 Not Found ມີຄວາມຜິດພາດໃນການນໍາເຂົ້າຖານຂໍ້ມູນ</label>';
   }
   else
   {
    $message = '<label class="text-success" style="font-family:phetsarath ot;">ນຳເຂົ້າຖານຂໍ້ມູນສຳເລັດແລ້ວ</label>';
   }
  }
  else
  {
   $message = '<label class="text-danger" style="font-family:phetsarath ot;">ໄຟລ໌ບໍ່ຖືກຕ້ອງ</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger" style="font-family:phetsarath ot;">ກະລຸນາເລືອກໄຟລ໌ sql</label>';
 }
}
?>

<!DOCTYPE html>  
<html>  
 <head>  
  <title>SQL</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
 </head>  
 <body>  
  <br /><br />  
  <div class="container" style="width:700px;">  
   <h3 style="font-family:phetsarath ot;">ຕິດຕັ້ງຖານຂໍ້ມູນ</h3>  
   <br />
   <div><?php echo $message; ?></div>
   <form method="post" enctype="multipart/form-data">
    <p><label style="font-family:phetsarath ot;">ກະລຸນາເລືອກໄຟລ໌ .sql</label>
    <input type="file" name="database" /></p>
    <br />
    <input type="submit" name="import" class="btn btn-primary" value="Import" />
    <a href='delete.php' class="btn btn-danger" style="font-family:phetsarath ot;">ລ້າງຖານຂໍ້ມູນ</a>
    <a href='back.php' class="btn btn-info" style="font-family:phetsarath ot;">back up</a>
    <a href='http://bkrms.bigclao.com/pages/tbsale/sale.php' class="btn btn-info" style="font-family:phetsarath ot;">ຍົກເລີກ</a>
   </form>
  </div>  
 </body>  
</html>