<?php
include 'condb.php';


if ($_GET['st']=='show') {
	//print_r($_GET); die;
	$sql = "SELECT * FROM dataipd WHERE  di_id_doctor = '".$_GET['iddoctor']."' and  di_date_df_doctor = '".$_GET['dateDF']."' and di_type_file = '".$_GET['typefile']."' and di_type_doctor = '".$_GET['tpyedoctor']."'";
	$result = $connect->query($sql);


	?>
	<table>
		<tr>
			<th>วันที่</th>
			<th>ชื่อรายการค่าแทพย์</th>
			<th>รหัสแทพย์</th>
			<th>วันที่ admit</th>
			<th>จำนวนเงิน</th>
			<th>ปกส.</th>
			<th>เงินสด</th>
			<th>ชื่อผู้ป่วย</th>
			<th>HN</th>
			<th>สิทธิ</th>
			<th>Bill No.</th>
			<th>จัดการ</th>
		</tr>
		<?php
		$service = 0;
		
			
		$sum=0;
		$sumPss = 0;
		$sumcash = 0;
		while ($objResult = mysqli_fetch_array($result)) {
			if ($objResult['di_service_charge']) {
				$service = $objResult['di_service_charge'];
			}
			if ($objResult['di_service_charge'] !='') {
				$sum = $sum + $service;
			}
			if ($objResult['di_ssp'] !='') {
				$sumPss = $sumPss + $objResult['di_ssp'];
			}
			if ($objResult['di_cash'] != '') {
				$sumcash = $sumcash + $objResult['di_cash'];
			}


			?>
			<tr class="D-<?php echo $objResult['di_id']; ?>">
				<td>
					<input type="date" class="text" name="dateDF" id="dateDF-<?php echo $objResult['di_id']; ?>" value="<?php echo $_GET['dateDF']; ?>">

				</td>
				<td><?php echo $objResult['di_details_treat']; ?></td>
				<td><?php echo $objResult['di_id_doctor']; ?></td>
				<td><?php echo $objResult['di_date_acp']; ?></td>
				<td><input type="text" name="servicecharge" id="servicecharge-<?php echo $objResult['di_id']; ?>" class="text" value="<?php echo $objResult['di_service_charge']; ?>"></td>
				<td><input type="text" name="ssp" id="ssp-<?php echo $objResult['di_id']; ?>" class="text" value="<?php echo $objResult['di_ssp']; ?>"></td>
				<td><input type="text" class="text" name="cash" id="cash-<?php echo $objResult['di_id']; ?>" value="<?php echo $objResult['di_cash']; ?>"></td>
				<td><?php echo $objResult['di_name_patient']; ?></td>
				<td><?php echo $objResult['di_HN']; ?></td>
				<td><?php echo $objResult['di_right']; ?></td>
				<td><?php echo $objResult['di_id_bill']; ?></td>
				<td>
					<?php
					if ($_GET['tpyedoctor'] == '1') {
					 if ($objResult['di_right'] != '20' ) {
						
					 ?>
					<div class="button wb btEpa" id="moveDe" data-id="<?php echo $objResult['di_id']; ?>" data-statusedit="1"data-iddoctor="<?php echo $objResult['di_id_doctor']; ?>" data-date="<?php echo $_GET['dateDF']; ?>" data-idDF="<?php echo $_GET['id']; ?>" data-typefile="1" data-typedoctor="<?php echo $_GET['tpyedoctor']; ?>"><label>ยังไม่จ่าย</label></div>
					<?php } }  ?>
					<div class="button wb btE" id="editDe" data-id="<?php echo $objResult['di_id']; ?>" data-statusedit="1"data-iddoctor="<?php echo $objResult['di_id_doctor']; ?>" data-date="<?php echo $_GET['dateDF']; ?>" data-idDF="<?php echo $_GET['id']; ?>" data-typefile="1" data-typedoctor="<?php echo $_GET['tpyedoctor']; ?>">แก้ไข</div>
					<div class="button wb btD" id="deleteDetailIPD" data-id="<?php echo $objResult['di_id']; ?>" data-iddoctor="<?php echo $objResult['di_id_doctor']; ?>" data-date="<?php echo $_GET['dateDF']; ?>" data-ssp="<?php echo $objResult['di_ssp']; ?>" data-cash="<?php echo $objResult['di_cash']; ?>" data-idDF="<?php echo $_GET['id']; ?>" data-typedoctor="<?php echo $_GET['tpyedoctor']; ?>">ลบ</div>

				</td>

			</tr>
		<?php } ?>
		<tr>
			<td class="st"></td>
			<td class="st"></td>
			<td class="st"></td>
			<td class="st">ยอดรวม</td>
			<td class="st" id="service"><?php echo $sum; ?></td>
			<td class="st" id="ssp"><?php echo $sumPss; ?></td>
			<td class="st" id="cash"><?php echo $sumcash; ?></td>
			<td class="st"></td>
			<td class="st"></td>
			<td class="st"></td>
			<td class="st"></td>


		</tr>
	</table>
	<?php 

}
if ($_GET['st']=='del'){
	
	$table1 = 'dataipd';
	$table2 = 'payroll_doctor';
	$sql = "SELECT * FROM dataipd WHERE  di_id_doctor = '".$_POST['iddoctor']."' and  di_date_df_doctor = '".$_POST['dateDF']."' and di_type_file = '".$_POST['typefile']."' and di_type_doctor = '".$_POST['tpyedoctor']."'";
	//echo $sql; die;
	$result = $connect->query($sql);
	while ($objResult = mysqli_fetch_array($result)){ 
	
	$where = 'di_id ='.$objResult['di_id'];
	delete($table1,$where);
}
	$where1 = 'RECORD  ='.$_POST['id'];
	$id = delete($table2,$where1);
	if ($id) {
		$d = explode("-",$_POST['dateDF']);
		$data['dateDF'] = $d[0].'-'.$d[1];
		$data['iddoctor'] = $_POST['iddoctor'];
		$data['succeed'] = '1';
		$data['id'] = $_POST['id'];
		$data['tpyedoctor'] = $_POST['tpyedoctor'];
		
	}else{
		$data['succeed'] = '0'; 
	}

	echo json_encode($data);

}