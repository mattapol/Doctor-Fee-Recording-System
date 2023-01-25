<?php
include 'like.php';
ini_set("memory_limit","10M");
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
?>
<script src="js/jquery.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
<script src="js/sweetalert.min.js"></script>
<link rel="stylesheet" href="<?php echo $lines; ?>css/css.css" crossorigin="anonymous">
<script type="text/javascript">

	var lines = '<?php echo $lines; ?>';
</script>
<link rel="stylesheet" href="css/jquery.datetimepicker.css" crossorigin="anonymous">

<script type="text/javascript" src="plugin/search/search.js"></script>
<link rel="stylesheet" href="plugin/myModal/myModal.css" crossorigin="anonymous">
<script type="text/javascript" src="plugin/myModal/myModal.js"></script>
<script type="text/javascript" src="<?php echo $lines;  ?>js/uplosdfile.js"></script>
<link rel="stylesheet" type="text/css" href="plugin/reload/reload.css?v=01" />

<script src="plugin/reload/reload.js?v=01"></script>

<div class="from-upload">
	<div class="Navigation">
		<ul>
			<li>
				<a class="activess" id="activess" href="<?php echo $lines; ?>">
				<i class='fas fa-home'></i> หน้าหลัก</a>
			</li>
			<li>
				<a href="<?php echo $lines; ?>uploadDF.php">
				<i class='fas fa-file-upload'></i> อัพโหลดข้อมูล</a>
			</li>
			<li>
				<a href="#contact" class="" id="list-details-doctor">
				<i class='fas fa-chart-bar'></i> ออกรายงานข้อมูล DF แพทย์</a>
			</li>	
			<li>
				<a href="#contact" class="" id="list-salary-doctor">
				<i class='fas fa-clipboard-check'></i> เพิ่มรายชื่อหมอ</a>
			</li>
			<li>
				<a href="#contact" class="" id="list-set">
				<i class='fas fa-cog'></i> ตั้งค่า</a>
			</li>
			<li>
				<a href="logout.php" onclick="return confirm('Do you want to Logout?')">
				<i class="fas fa-sign-out-alt"></i> Logout </a>
			</li>

		</ul>
	</div>
	<div class="from-list">
		<div class="from-delete-m ">
			<div class="button btcore" id="deleteUploadText">
				ลบข้อมูลที่อัพโหลด
			</div>
		</div>
	<form  name="frmUpdload" id="frmUpdload" method="POST" enctype="multipart/form-data">
		<div class="form-upload-f">
			<div class="form-up">
				<input type="text" name="testdate5" class="date datetimepicker"placeholder="วันที่ต้องการอัพโหลด"  id="testdate5" value="" autocomplete="off">

			</div>
			<div class="form-up">
				<select name="typefile" id="typefile">
					<option value="">ประเภทไฟล์ที่อัพโหลด</option>
					<option value="1">IPD</option>
					<option value="2">OPD</option>
				</select>

			</div>
			<div class="form-up">
				<select name="typeDoctor" id="typeDoctor">
					<option value="">ประเภทหมอ</option>
					<option value="1">หมอประจำ</option>
					<option value="2">หมอเวร</option>
				</select>

			</div>
			<div class="form-up">
				<select name="typefilsDoctor" id="typefilsDoctor">
					<option value="">รูปแบบไฟล์</option>
					<option value="1">ไฟล์ OPD ที่มีเวลา</option>
					<option value="2">ไฟล์ OPD ที่ไม่มีเวลา</option>
				</select>

			</div>

			<div class="form-up">
				<div class="from-file">
					<label class="file">
						<input type="file" multiple class="choose" id="file" name="file">
						<span class="file-custom"></span>
					</label>
				</div>
			</div>
			<div class="form-sub">
				<input type="submit" name="submit" id="submit" class="button button1" value="อัพโหลด">
			</div>
			
		</div>
	</form>
	</div>
	<div class="bill-VS"></div>

	<div class="list"></div>
	<div class="listEdit"></div>
</div>
<div class="loading"></div>
<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>