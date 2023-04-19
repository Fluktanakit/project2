<?php
include 'condb.php';
$stmtDoc = $conn->prepare("
SELECT * #ตารางเอามาทุกคอลัมภ์
FROM tbl_doc_file AS f
INNER JOIN tbl_type AS t ON f.t_id=t.t_id
INNER JOIN tbl_department AS d ON f.d_id=d.d_id
ORDER BY f.fileID ASC #เรียงลำดับข้อมูลจากน้อยไปมาก
");
$stmtDoc->execute();
$resultDoc = $stmtDoc->fetchAll();
?>
<table id="example1" class="table table-bordered table-striped dataTable">
  <thead>
    <tr role="row" class="info">
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 10%;">รหัสเอกสาร</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">ชื่อหนังสือ/ประเภท</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 15%;">วันที่อัพโหลด</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 10%;">สถานะ</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 20%;">แผนก/ผู้ใช้</th>
      <th  tabindex="0" rowspan="1" colspan="1" style="width: 17%;">จัดการส่วนข้อมูล</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultDoc as $row_Doc) { ?>
    <tr>
      <td>
        <?php echo $row_Doc['fileID'];?>
      </td>
      <td>
        <?php echo $row_Doc['filename']; ?>
        <br>
        ประเภท: <font color="blue"><?php echo $row_Doc['t_name']; ?></font><br>
        <font color="red"><?php echo $row_Doc['doc_file']; ?></font>
      </td>
      <td>
        วันที่อัพ: <?php echo date('d/m/Y',strtotime($row_Doc['date_up'])); ?>
      </td>
      <td align="center"> <?php
        $st = $row_Doc['status'];
        $us = $row_Doc['m_username'];
        if ($us != '' && $st == 0) {
        echo $row_Doc['m_username'];
        echo "<br><span class='badge badge-warning'>";
          echo "ยังไม่อ่าน";
        echo "</span>";
        }elseif ($st == 1) {
        echo $row_Doc['m_username'];
        echo "<br><span class='badge badge-success'>";
          echo "อ่านแล้ว";
        echo "</span>";
        }
      ?></td>
      <td>
        <?php echo $row_Doc['d_name'];?>
      </td>
      <td>
        <a class="btn btn-info btn-sm" href="#">
          <i class="fas fa-folder">
          </i>
          View
        </a>
        <a class="btn btn-warning btn-sm" href="doc.php?act=edit&fileID=<?php echo $row_Doc['fileID']; ?>">
          <i class="fas fa-pencil-alt">
          </i>
          Edit
        </a>
        <a class="btn btn-danger btn-sm" href="doc_del.php?fileID=<?= $row_Doc['fileID'];?>"  onclick="return confirm('ยืนยันการลบข้อมูล !!');">
          <i class="fas fa-trash">
          </i>
          Delete
        </a>
      </td>
      <?php } ?>
    </tr>
  </tbody>
</table>