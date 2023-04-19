<?php 
if(isset($_GET['fileID'])){
    include 'condb.php';
//ประกาศตัวแปรรับค่าจาก param method get
$fileID = $_GET['fileID'];
$stmt = $conn->prepare('DELETE FROM tbl_doc_file     WHERE fileID=:fileID');
$stmt->bindParam(':fileID', $fileID , PDO::PARAM_INT);
$stmt->execute();

  if($stmt->rowCount() > 0){
        echo '<script>       
              window.location = "doc.php"; //หน้าที่ต้องการให้กระโดดไป
              </script>';
    }else{
       echo '<script>         
              window.location = "doc.php"; //หน้าที่ต้องการให้กระโดดไป
             </script>';
    }
$conn = null;
} //isset
?>