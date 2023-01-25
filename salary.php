<?php 
include 'condb.php';
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

$sqld = "SELECT * FROM name_doctor WHERE W_DOCTOR != '' and CODE_NAME != ''ORDER BY ID DESC";
$resultd = $connect->query($sqld);
?>
<link rel="stylesheet" href="css/css.css" crossorigin="anonymous">
<script type="text/javascript" src="js/listDoctor.js"></script>
<div class="t-salary">
	<label>รายชื่อหมอ</label>
</div>
<div class="from-search">
	<div class="button addbt" id="addDoctor">เพิ่มรายชื่อหมอ</div>
	<input type="text" name="searchDoctor" id="searchDoctor" class="txetinput" placeholder="ค้นหา ว.หมอ" onkeyup="createSearch('searchDoctor','namDoctor',0)">
</div>
<table id="namDoctor">
  <tr>
    <th>ลำดับ</th>
    <th>ว.หมอ</th>
    <th>ชื่อ-นามสกุล</th>
    <th>การันตีหมอ</th>
    <th>การันตีหมอทำจริง</th>
    <th>จัดการ</th>
  </tr>
  <?php $i = 1; while ($rowd = $resultd->fetch_assoc()){
  		if ($rowd['salary'] =='') {
  			$salary = 0;
  		}else {
  			$salary = $rowd['salary'];
  		}

  		if ($rowd['guarantee'] =='') {
  			$guarantee = 0;
  		}else {
  			$guarantee = $rowd['guarantee'];
  		}
   ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $rowd['W_DOCTOR']; ?></td>
    <td><?php echo $rowd['NAME_TITLE'].'.'.$rowd['NAME'].' '.$rowd['LAST_NAME']; ?></td>
    <td><?php echo number_format($salary); ?></td>
    <td><?php echo number_format($guarantee); ?></td>
    <td>
    	<div class="button button1" id="editDoctorname" data-id="<?php echo $rowd['ID']; ?>">แก้ไข</div>
    	<div class="button button1 btD" id="deletnamDoct" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-id="<?php echo $rowd['ID']; ?>">ลบ</div>
    </td>
  </tr>
  <?php $i++; } ?>
</table>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>