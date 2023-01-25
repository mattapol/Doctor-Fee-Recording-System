<?php 
include 'condb.php';
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

$sqld = "SELECT * FROM setupdf where sf_id  = '1'";

$resultd = $connect->query($sqld);
$rowd = $resultd->fetch_assoc();
?>
<script type="text/javascript" src="js/listDoctor.js"></script>
<div class="from-set">
	<div class="t-set">ตั้งค่า</div>
	<div class="setup-class">
		<div class="t-vat">ตั้งค่า หักภาษี %</div>
		<div class="form-vat">
			<div class="f-v">
				<input type="hidden" name="id" value="<?php echo $rowd['sf_id']; ?>" id="id">
				<input type="number" name="tax" id="tax" class="txetinput" value="<?php echo $rowd['sf_setup']; ?>">
			</div>
			<div class="fv">
				
			</div>
			<div class="button bt" id="setupDoctor">ตั้งค่า</div>
		</div>
	</div>
</div>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>