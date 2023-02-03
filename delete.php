<?php
header('Content-Type: text/html; charset=utf-8');//ໃຫ້ຊອບພອດພາສາລາວ
$mysqli = new mysqli("localhost", "root", "", "apis_yokjork");//ຄຳສັງເຊື່ອມຕໍຖານຂໍ້ມູນ
$mysqli->query('SET foreign_key_checks = 0');//ຄຳສັງຍຸດການທຳງານຂອງຖານຂໍ້ມູນ
if ($result = $mysqli->query("SHOW TABLES"))//ການສະແດງຕາຕະລາງໃນຖານຂໍ້ມູນມາທັງໜົດ
{
    while($row = $result->fetch_array(MYSQLI_NUM)){
        $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);//ຄຳສັງລົບຕາຕະລາງໃນຖານຂໍ້ມູນ
        echo "<script>alert('ຂໍ້ມູນສຳເລັດ');location='index.php'</script>";
    }
   
}
$mysqli->query('SET foreign_key_checks = 1');//ເມືອລົບຂໍຕາຕະລາງໃນຖານຂໍ້ມູນສຳເລັດແລ້ວໃຫ້ ຖານຂໍ້ມູນກັບມາໃສງານ ແລະ ພ້ອມຕິດຕັ້ງຂໍ້ມູນໃຫມ່ເຂົ້າໄດ້ເລີຍ
$mysqli->close();


?>