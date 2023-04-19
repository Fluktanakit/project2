<?php 
//print_r($_POST);
//exit();
if (isset($_POST['m_name'])) {
     include 'condb.php';
     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
      echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      
   
    $m_username = $_POST['m_username'];
    $m_password = $_POST['m_password'];
    $m_name = $_POST['m_name'];
    $d_id = $_POST['d_id'];
    $m_level = $_POST['m_level'];
    //sql insert
    $stmt = $conn->prepare("INSERT INTO tbl_member (m_username, m_password, m_name, d_id, m_level)
    VALUES (:m_username, :m_password, :m_name, :d_id, :m_level)");
    $stmt->bindParam(':m_username', $m_username, PDO::PARAM_STR);
    $stmt->bindParam(':m_password', $m_password, PDO::PARAM_STR);
    $stmt->bindParam(':m_name', $m_name, PDO::PARAM_STR);
    $stmt->bindParam(':d_id', $d_id, PDO::PARAM_INT);
    $stmt->bindParam(':m_level', $m_level, PDO::PARAM_STR);
    $result = $stmt->execute();
    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
            if($result){
                echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เพิ่มข้อมูลสมาชิกสำเร็จ",
                          type: "success"
                      }, function() {
                          window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            }else{
               echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เกิดข้อผิดพลาด",
                          type: "error"
                      }, function() {
                          window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
            } //else ของ if result      
        }else{ //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
            echo '<script>
                         setTimeout(function() {
                          swal({
                              title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
                              type: "error"
                          }, function() {
                              window.location = "member.php"; //หน้าที่ต้องการให้กระโดดไป
                          });
                        }, 1000);
                    </script>';
  
    $conn = null; //close connect db
    } //isset
?>