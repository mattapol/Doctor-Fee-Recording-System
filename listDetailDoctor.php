
<link rel="stylesheet" href="css/listDoctor.css" crossorigin="anonymous">
<script type="text/javascript" src="js/listDoctor.js"></script>
<?php 
include 'condb.php';

?>

<div class="tab">
	<button class="tablinks" onclick="openmenu(event, 'London')">ข้อมูลหมอประจำ</button>
	<button class="tablinks" onclick="openmenu(event, 'Paris')">ข้อมูลหมอเวร</button>
	<button class="tablinks" onclick="openmenu(event, 'arrears')">ข้อมูลค้างจ่าย DF</button>
	<button class="tablinks" onclick="openmenu(event, 'pays')">ข้อมูลจ่ายยอดค้าง</button>
</div>

<div id="London" class="tabcontent">
	<h3>รายงานข้อมูลหมอประจำ</h3>
	
	<div class="fom-date">
		<table class="table-m">
			<tr>
				<td class="td-m">
					<div class="from-y">
						<select name="month" id="month">
							<option value="">เลือกเดือน</option>
							<option value="01">มกราคม</option>
							<option value="02">กุมภาพันธ์</option>
							<option value="03">มีนาคม</option>
							<option value="04">เมษายน</option>
							<option value="05">พฤษภาคม</option>
							<option value="06">มิถุนายน</option>
							<option value="07">กรกฏาคม</option>
							<option value="08">สิงหาคม</option>
							<option value="09">กันยายน</option>
							<option value="10">ตุลาคม</option>
							<option value="11">พฤศจิกายน</option>
							<option value="12">ธันวาคม</option>
						</select>

					</div>
				</td>
				<td class="td-m">
					<?php
					$y = date('Y');
					$yy = [];
					for ($i=1; $i < 3; $i++) { 
						$yy[$i][$i] = $y-$i;
					}

					?>
					<div class="from-y">
						<select name="year" id="year">
							<option value="">เลือกปี</option>
							<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option> 
							<option value="<?php echo $yy['1']['1']; ?>"><?php echo $yy['1']['1']; ?></option>
							<option value="<?php echo $yy['2']['2']; ?>"><?php echo $yy['2']['2']; ?></option>
							
						</select>

					</div>
				</td>
				<td class="td-m">
					<div class="button button1" id="listDoctorRegular" data-id="1">ค้นหา</div>
				</td>
				<td class="td-m">
				</td>
				<td class="td-m">
					<div class="from-add">
						<input type="text" name="searchName" class="txt" id="searchtable" onkeyup="createSearch('searchtable','tableSum',2)" placeholder="ค้นหา..">
					</div>
				</td>

			</tr>
		</table>
	</div>
	<div class="listDoctorRegulard"></div>
</div>

<div id="Paris" class="tabcontent">
	<h3>รายงานข้อมูลหมอเวร</h3>
	<div class="fom-date">
		<table class="table-m">
			<tr>
				<td class="td-m">
					<div class="from-y">
						<select name="months" id="months">
							<option value="">เลือกเดือน</option>
							<option value="01">มกราคม</option>
							<option value="02">กุมภาพันธ์</option>
							<option value="03">มีนาคม</option>
							<option value="04">เมษายน</option>
							<option value="05">พฤษภาคม</option>
							<option value="06">มิถุนายน</option>
							<option value="07">กรกฏาคม</option>
							<option value="08">สิงหาคม</option>
							<option value="09">กันยายน</option>
							<option value="10">ตุลาคม</option>
							<option value="11">พฤศจิกายน</option>
							<option value="12">ธันวาคม</option>
						</select>

					</div>
				</td>
				<td class="td-m">
					<?php
					$y = date('Y');
					$yy = [];
					for ($i=1; $i < 3; $i++) { 
						$yy[$i][$i] = $y-$i;
					}

					?>
					<div class="from-y">
						<select name="years" id="years">
							<option value="">เลือกปี</option>
							<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option> 
							<option value="<?php echo $yy['1']['1']; ?>"><?php echo $yy['1']['1']; ?></option>
							<option value="<?php echo $yy['2']['2']; ?>"><?php echo $yy['2']['2']; ?></option>
							
						</select>

					</div>
				</td>
				<td class="td-m">
					<div class="button button1" id="listDoctorRegularss" data-id="2">ค้นหา</div>
				</td>
				<td class="td-m">
				</td>
				<td class="td-m">
					<div class="from-add">
						<input type="text" name="searchName" class="txt" id="searchtable1" onkeyup="createSearch('searchtable1','tableSumwen',2)" placeholder="ค้นหา..">
					</div>
				</td>

			</tr>
		</table>
	</div>
	<div class="listDoctorRegular1"></div>
</div>

<div id="arrears" class="tabcontent">
	<h3>รายงานค้างจ่าย DF</h3>
	<div class="fom-date">
		
		<table class="table-m">
			<tr>
				<td class="td-m">
					<?php 
					$sql = "SELECT DISTINCT af_id_doctor,NAME_TITLE,NAME,LAST_NAME FROM arrearedfdoctor INNER JOIN name_doctor on arrearedfdoctor.af_id_doctor = name_doctor.CODE_NAME ORDER BY af_id_doctor,NAME_TITLE,NAME,LAST_NAME ";
					$result = $connect->query($sql);
					?>
					<div class="from-y">
						<select name="searchNaDoctor" id="searchNaDoctor">
							<option value="">เลือกแพทย์</option>
							<?php while ($row = $result->fetch_assoc()){ ?>
							<option value="<?php echo $row['af_id_doctor']; ?>"><?php echo $row['NAME_TITLE'].'.'.$row['NAME'].' '.$row['LAST_NAME']; ?></option>
							<?php } ?>
						</select>

					</div>
				</td>
				<td class="td-m">
					<div class="from-y">
						<select name="monthsDoctor" id="monthsDoctor">
							<option value="">เลือกเดือน</option>
							<option value="0">ทั้งหมด</option>
							<option value="01">มกราคม</option>
							<option value="02">กุมภาพันธ์</option>
							<option value="03">มีนาคม</option>
							<option value="04">เมษายน</option>
							<option value="05">พฤษภาคม</option>
							<option value="06">มิถุนายน</option>
							<option value="07">กรกฏาคม</option>
							<option value="08">สิงหาคม</option>
							<option value="09">กันยายน</option>
							<option value="10">ตุลาคม</option>
							<option value="11">พฤศจิกายน</option>
							<option value="12">ธันวาคม</option>
						</select>

					</div>
				</td>
				<td class="td-m">
					<?php
					$y = date('Y');
					$yy = [];
					for ($i=1; $i < 3; $i++) { 
						$yy[$i][$i] = $y-$i;
					}

					?>
					<div class="from-y">
						<select name="yearsdortor" id="yearsdortor">
							<option value="">เลือกปี</option>
							<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option> 
							<option value="<?php echo $yy['1']['1']; ?>"><?php echo $yy['1']['1']; ?></option>
							<option value="<?php echo $yy['2']['2']; ?>"><?php echo $yy['2']['2']; ?></option>
							
						</select>

					</div>
				</td>
				<td class="td-m">
					<div class="button button1" id="liststale" data-id="2">ค้นหา</div>
					<div class="button pt" id="Printlistss">Print <i class='fas fa-print'></i></div>

				</td>
				<td class="td-m">

				</td>
				<td class="td-m">
					<div class="from-add">
						<input type="text" name="searchName" class="txt" id="searchtable" onkeyup="createSearch('searchtable','tableSum',2)" placeholder="ค้นหา..">
					</div>
				</td>

			</tr>
		</table>
	</div>
	<div class="listDoctorRegular2"></div>
</div>

<div id="pays" class="tabcontent">
	<h3>จ่ายยอดที่ค้าง</h3>
	<div class="fom-date">
		<table class="table-m">
			<tr>
				<td class="td-m">
					<?php 
					$sql = "SELECT DISTINCT af_id_doctor,NAME_TITLE,NAME,LAST_NAME FROM arrearedfdoctor INNER JOIN name_doctor on arrearedfdoctor.af_id_doctor = name_doctor.CODE_NAME WHERE af_status_pay = '1' ORDER BY af_id_doctor,NAME_TITLE,NAME,LAST_NAME ";
					$result = $connect->query($sql);
					?>
					<div class="from-y">
						<select name="searchNaDoctorpay" id="searchNaDoctorpay">
							<option value="">เลือกแพทย์</option>
							<?php while ($row = $result->fetch_assoc()){ ?>
							<option value="<?php echo $row['af_id_doctor']; ?>"><?php echo $row['NAME_TITLE'].'.'.$row['NAME'].' '.$row['LAST_NAME']; ?></option>
							<?php } ?>
						</select>

					</div>
				</td>
				<td class="td-m">
					<div class="from-y">
						<select name="monthsDoctdpay" id="monthsDoctdpay">
							<option value="">เลือกเดือน</option>
							<option value="0">ทั้งหมด</option>
							<option value="01">มกราคม</option>
							<option value="02">กุมภาพันธ์</option>
							<option value="03">มีนาคม</option>
							<option value="04">เมษายน</option>
							<option value="05">พฤษภาคม</option>
							<option value="06">มิถุนายน</option>
							<option value="07">กรกฏาคม</option>
							<option value="08">สิงหาคม</option>
							<option value="09">กันยายน</option>
							<option value="10">ตุลาคม</option>
							<option value="11">พฤศจิกายน</option>
							<option value="12">ธันวาคม</option>
						</select>

					</div>
				</td>
				<td class="td-m">
					<?php
					$y = date('Y');
					$yy = [];
					for ($i=1; $i < 3; $i++) { 
						$yy[$i][$i] = $y-$i;
					}

					?>
					<div class="from-y">
						<select name="yearsdortorpay" id="yearsdortorpay">
							<option value="">เลือกปี</option>
							<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option> 
							<option value="<?php echo $yy['1']['1']; ?>"><?php echo $yy['1']['1']; ?></option>
							<option value="<?php echo $yy['2']['2']; ?>"><?php echo $yy['2']['2']; ?></option>
							
						</select>

					</div>
				</td>
				<td class="td-m">
					<div class="button button1" id="liststalepay" data-id="2">ค้นหา</div>
					
				</td>
				<td class="td-m">

				</td>
				<td class="td-m">
					<div class="from-add">
						<input type="text" name="searchName" class="txt" id="searchtable" onkeyup="createSearch('searchtable','tableSum',2)" placeholder="ค้นหา..">
					</div>
				</td>

			</tr>
		</table>
	</div>
	<div class="listDoctorRegular3"></div>
</div>

<div class="listDetalM"></div>
<div class="report_left_inner"></div>


