<?php
include 'condb.php';
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

if ($_GET['mode'] == 'lestdoctor') {
	
	if ($_POST['numberDoctor'] == '') {

		$sqld = "SELECT * FROM payroll_doctor WHERE type_treat = '".$_POST['typefiles']."' and  DUTY = '".$_POST['typedoctor']."' and DATE = '".$_POST['testdate6']."'";
		$resultd = $connect->query($sqld);

	}else{

		$sqld = "SELECT * FROM payroll_doctor WHERE type_treat = '".$_POST['typefiles']."' and  DUTY = '".$_POST['typedoctor']."' and DATE = '".$_POST['testdate6']."' and CODE_NAME = '".$_POST['numberDoctor']."'";
		$resultd = $connect->query($sqld);

	}
	?>
	<div style="width: 100%;height: 306px;overflow: overlay;margin-bottom: 10px;">
		<table>
			<tr>
				<th>ลำดับ</th>
				<th>ว.หมอ</th>
				<th>วันที่อัพโหลด</th>
				<th>PT_NAME</th>

			</tr>
			<?php
			$i = 1; 
			while ($rowd = $resultd->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $rowd['CODE_NAME'];  ?></td>
					<td><?php echo $rowd['DATE'];  ?></td>
					<td><?php echo $rowd['PT_NAME'];  ?></td>
				</tr>




				<?php
				$i++;  }
				?>
			</table>
		</div>
		<?php 




	}

	if ($_GET['mode'] == 'deleteDoctor') {

		if ($_POST['numberDoctor'] == '') {

			$sqld = "SELECT * FROM payroll_doctor WHERE type_treat = '".$_POST['typefiles']."' and  DUTY = '".$_POST['typedoctor']."' and DATE = '".$_POST['testdate6']."'";
			$resultd = $connect->query($sqld);
			while ($rowd = $resultd->fetch_assoc()){
				$table1 = 'payroll_doctor';
				$where = 'RECORD ='.$rowd['RECORD'];
				$id = delete($table1,$where);
				if ($id) {
					$data['succeed'] = '1';
				}else{

					$data['succeed'] = '0';	
				}


			}

			if ($_POST['typefiles'] == '1') {

				$sqldD = "SELECT * FROM dataipd WHERE  di_date_df_doctor = '".$_POST['testdate6']."'";
				$resultdD = $connect->query($sqldD);
				while ($rowdD = $resultdD->fetch_assoc()){
					$table = 'dataipd';
					$wheres = 'di_id  ='.$rowdD['di_id'];
					delete($table,$wheres);


				}
				
			}

		}else{

			$sqld = "SELECT * FROM payroll_doctor WHERE type_treat = '".$_POST['typefiles']."' and  DUTY = '".$_POST['typedoctor']."' and DATE = '".$_POST['testdate6']."' and CODE_NAME = '".$_POST['numberDoctor']."'";
			$resultd = $connect->query($sqld);
			$rowd = $resultd->fetch_assoc();
			if ($rowd) {
				$table1 = 'payroll_doctor';
				$where = 'RECORD ='.$rowd['RECORD'];
				$id = delete($table1,$where);
				if ($id) {
					$data['succeed'] = '1';
				}else{

					$data['succeed'] = '0';	
				}

				if ($_POST['typefiles'] == '1') {

					$sqldD = "SELECT * FROM dataipd WHERE  di_date_df_doctor = '".$_POST['testdate6']."' and di_id_doctor = '".$_POST['numberDoctor']."'";
					$resultdD = $connect->query($sqldD);
					while ($rowdD = $resultdD->fetch_assoc()){
						$table = 'dataipd';
						$wheres = 'di_id  ='.$rowdD['di_id'];
						delete($table,$wheres);


					}
				}
				
			}
			


		}




echo json_encode($data);

	}
?>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>