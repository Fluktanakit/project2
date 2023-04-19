<?php
      if(isset($_GET['fileID'])){
      include 'condb.php';
      $stmt_m = $conn->prepare("
        SELECT f.*, t.t_name #ตารางสมาชิกเอามาทุกคอลัมภ์ , ตารางแผนกเอามาแค่ชื่อแผนก
        FROM tbl_doc_file AS f  #AS m คือการแทนชื่อตารางให้ชื่อสั้นลงในตอนที่เอาไป inner join โค้ดจะดูไม่รก
        INNER JOIN tbl_type AS t ON f.t_id=t.t_id
        WHERE f.fileID=?
        ORDER BY f.fileID ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
        ");
      $stmt_m->execute([$_GET['fileID']]);
      $row_em = $stmt_m->fetch(PDO::FETCH_ASSOC);
      //ถ้าคิวรี่ผิดพลาดให้กลับไปหน้า index
        if($stmt_m->rowCount() < 1){
            header('Location: index.php');
            exit();
         }
      }//isset
      ?>
      <div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">เพิ่มข้อมูลไฟล์เอกสาร</h3>
  </div>
  <div class="card-body">
    <form action="doc_edit_db.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>รหัสเอกสาร</label>
            <input type="text" name="fileID" value="<?= $row_em['fileID'];?>" class="form-control is-warning" placeholder="กรอกข้อมูลเอกสาร">
          </div>
        </div>
      </div>
    <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ชื่อเอกสาร</label>
            <input type="text" name="filename" value="<?= $row_em['filename'];?>" class="form-control is-warning" placeholder="กรอกข้อมูลชื่อเอกสาร">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ประเภทเอกสาร</label>
            <select name="t_id" class="custom-select rounded-0" required>
              <option value="">-เลือกประเภทเอกสาร-</option>
              <option value="<?= $row_em['t_id'];?>"><?= $row_em['t_name'];?></option>
              <?php
              include 'condb.php';
              $stmt = $conn->prepare("SELECT* FROM tbl_type");
              $stmt->execute();
              $result_t = $stmt->fetchAll();
              foreach($result_t as $row_t) {
              ?>
              <option value="<?= $row_t['t_id'];?>"><?= $row_t['t_name'];?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>*ไฟล์เอกสาร .pdf .doc*</label>
            <input type="file" name="doc_file" class="form-control" accept="appliction/pdf">
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>ส่งให้อาจารย์</label>
            <input type="text" name="m_username" class="form-control is-warning" placeholder="กรอกชื่ออาจารย์">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>หลักสูตรการศึกษา</label>
            <select name="d_id" class="custom-select rounded-0" required>
              <option value="">-เลือกหลักสูตรการศึกษา-</option>
              <?php
              include 'condb.php';
              $stmt = $conn->prepare("SELECT* FROM tbl_department");
              $stmt->execute();
              $result = $stmt->fetchAll();
              foreach($result as $row) {
              ?>
              <option value="<?= $row['d_id'];?>"><?= $row['d_name'];?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row" align="left">
        <div class="col-sm-6">
          <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
          <a href="doc.php" class="btn btn-danger" data-dismiss="modal">ยกเลิก</a>
        </div>
      </div>
    </form>
  </div>
</div>
