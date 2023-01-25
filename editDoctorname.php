<?php
include 'condb.php';

$sqld = "SELECT * FROM name_doctor WHERE ID  = '".$_GET['id']."' ";
$resultd = $connect->query($sqld);
$rowd = $resultd->fetch_assoc();
 ?>
 <div class="form-Editdoctor">
 	<input type="hidden" class="txetinput" name="id" id="id" value="<?php echo $_GET['id'];  ?>">
 	<div class="form-input-Edit">
 		<label>ว.หมอ</label>
 		<input type="text" class="txetinput" name="iddoctor" id="iddoctor" value="<?php echo $rowd['W_DOCTOR'];  ?>" placeholder="ใส่ ว. ด้วย">
 	</div>
 	<div class="form-input-Edit">
 		<label>คำนำหน้า</label>
 		<input type="text" class="txetinput" name="nameTitle" id="nameTitle" value="<?php echo $rowd['NAME_TITLE'];  ?>">
 	</div>
 	<div class="form-input-Edit">
 		<label>ชื่อ</label>
 		<input type="text" class="txetinput" name="name" id="name" value="<?php echo $rowd['NAME'];  ?>">
 	</div>
 	<div class="form-input-Edit">
 		<label>นามสกุล</label>
 		<input type="text" class="txetinput" name="fname" id="fname" value="<?php echo $rowd['LAST_NAME'];  ?>">
 	</div>
 	<div class="form-input-Edit">
 		<label>การันตีหมอ</label>
 		<input type="number" class="txetinput" name="salary" id="salary" value="<?php echo $rowd['salary'];  ?>">
 	</div>
 	<div class="form-input-Edit">
 		<label>การันตีหมอทำจริง</label>
 		<input type="number" class="txetinput" name="guarantee" id="guarantee" value="<?php echo $rowd['guarantee'];  ?>">
 	</div>

 </div>