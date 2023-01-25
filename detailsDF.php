<?php
include 'condb.php';
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
			</tr>
			<?php
			$sum=0;
			$sumPss = 0;
			$sumcash = 0;
			while ($objResult = mysqli_fetch_array($result)) {
				if ($objResult['di_service_charge'] !='') {
					$sum = $sum + $objResult['di_service_charge'];
				}
				if ($objResult['di_ssp'] !='') {
					$sumPss = $sumPss + $objResult['di_ssp'];
				}
				if ($objResult['di_cash'] != '') {
					$sumcash = $sumcash + $objResult['di_cash'];
				}
				

				?>
				<tr>
					<td><?php echo $_GET['dateDF']; ?></td>
					<td><?php echo $objResult['di_details_treat']; ?></td>
					<td><?php echo $objResult['di_id_doctor']; ?></td>
					<td><?php echo $objResult['di_date_acp']; ?></td>
					<td><?php echo $objResult['di_service_charge']; ?></td>
					<td><?php echo $objResult['di_ssp']; ?></td>
					<td><?php echo $objResult['di_cash']; ?></td>
					<td><?php echo $objResult['di_name_patient']; ?></td>
					<td><?php echo $objResult['di_HN']; ?></td>
					<td><?php echo $objResult['di_right']; ?></td>
					<td><?php echo $objResult['di_id_bill']; ?></td>


				</tr>
			<?php }  ?>
			<tr>
					<td class="st"></td>
					<td class="st"></td>
					<td class="st"></td>
					<td class="st">ยอดรวม</td>
					<td class="st"><?php echo $sum; ?></td>
					<td class="st"><?php echo $sumPss; ?></td>
					<td class="st"><?php echo $sumcash; ?></td>
					<td class="st"></td>
					<td class="st"></td>
					<td class="st"></td>
					<td class="st"></td>


				</tr>
		</table>