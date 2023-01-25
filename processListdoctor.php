<?php 
include 'condb.php';
if ($_GET['d'] == '1') {


	$sql = "SELECT DISTINCT payroll_doctor.CODE_NAME ,name_doctor.NAME_TITLE,name_doctor.NAME,name_doctor.LAST_NAME,name_doctor.salary,name_doctor.guarantee FROM payroll_doctor inner join name_doctor on payroll_doctor.CODE_NAME = name_doctor.CODE_NAME WHERE DUTY = '".$_POST['idstatusDoctor']."'and DATE BETWEEN  '".$_POST['year'].'-'.$_POST['month']."-01' and '".$_POST['year'].'-'.$_POST['month']."-31' ORDER BY payroll_doctor.CODE_NAME,name_doctor.NAME_TITLE,name_doctor.NAME,name_doctor.LAST_NAME ,name_doctor.salary,name_doctor.guarantee";
	
	$result = $connect->query($sql);
	$data= [];
	$l = 1; 
	while ($row = $result->fetch_assoc()) {
		$data[$l]['iddoctor'] = $row['CODE_NAME'];
		$data[$l]['namedoctor'] = $row['NAME_TITLE'].'.'.$row['NAME'].' '.$row['LAST_NAME'];
		$data[$l]['social'] = 0;
		$data[$l]['genera'] = 0;
		$data[$l]['soci'] = 0;
		$data[$l]['gene'] = 0;
		$data[$l]['doctorfree'] = 0;
		$data[$l]['sumA'] = 0;
		$data[$l]['guarantee'] = $row['guarantee'];
		$data[$l]['salary'] = $row['salary'];
		$l++;
	}  
	$data4 = [];
	




	$n = 1;
	$data1 = [];
	$data4 = [];
	$sqlarreare = "SELECT * FROM arrearedfdoctor WHERE af_date_df_doctor BETWEEN '".$_POST['year'].'-'.$_POST['month']."-01' and '".$_POST['year'].'-'.$_POST['month']."-31'";
	
	$p2 = 0;
	$p1 = 0;
	$show_arreare = $connect->query($sqlarreare);
	while ($arreare = mysqli_fetch_array($show_arreare)){

		for ($i=1; $i < $l ; $i++){

			if ($arreare['af_id_doctor'] == $data[$i]['iddoctor']) {
				$p1 = $p1 + $arreare['af_cash'] ;
				$data4[$arreare['af_id_doctor']]['id'] = $arreare['af_id_doctor'];
				if (!isset($data4[$arreare['af_id_doctor']]['pact'])) {
					$data4[$arreare['af_id_doctor']]['pact'] = $arreare['af_cash']; 

				}else{
					$data4[$arreare['af_id_doctor']]['pact'] = $data4[$arreare['af_id_doctor']]['pact'] +$arreare['af_cash'] ;

				}
				
			}
			
		}
	}
	$sqld = "SELECT * FROM payroll_doctor WHERE DUTY = '".$_POST['idstatusDoctor']."' and DATE BETWEEN '".$_POST['year'].'-'.$_POST['month']."-01' and '".$_POST['year'].'-'.$_POST['month']."-31'";
	$resultd = $connect->query($sqld);
	$sumsocial = 0;
	$sumgenera = 0;
	$sumsoci = 0;
	$sumgene = 0;
	$sumarr = 0;
	
	while ($rowd = $resultd->fetch_assoc()){

		for ($i=1; $i < $l ; $i++) { 
			if ($rowd['CODE_NAME'] == $data[$i]['iddoctor']) {



				$data[$i]['social'] = $data[$i]['social']+$rowd['OPD_SOCIAL'];
				$data[$i]['genera'] = $data[$i]['genera']+$rowd['OPD_GENERA'];
				$data[$i]['soci'] = $data[$i]['soci']+$rowd['SURGI_SOCI'];
				$data[$i]['gene'] = $data[$i]['gene']+$rowd['SURGI_GENE'];

				
				
				$data[$i]['doctorfree'] = $data[$i]['doctorfree']+$rowd['DOCTORFEE'];
				$data[$i]['sumA'] = $data[$i]['social']+$data[$i]['genera']+$data[$i]['soci']+$data[$i]['gene']+$data[$i]['doctorfree'];

				$data[$i]['sumAA'] = $data[$i]['social']+$data[$i]['genera']+$data[$i]['soci']+$data[$i]['gene']+$data[$i]['doctorfree'];

				$data[$i]['extra'] = $rowd['extra'];
				$data[$i]['TIME1'] = $rowd['TIME1'];
				$data[$i]['TIME2'] = $rowd['TIME2'];

				
				
			} 


		}
	} 
//echo $sumgene; die;
	$cont = count($data);
	if ($cont == '0') {
		echo '0';
	}else {
		if ($_POST['idstatusDoctor'] == '1') {?>

			<table id="tableSum">
				<tr>
					<th style="background: #68bcff;">ลำดับ</th>
					<th style="background: #68bcff;">ชื่อหมอ</th>
					<th style="background: #68bcff;">ว.หมอ</th>
					<th style="background: #68bcff;">OPD_SOCIAL</th>
					<th style="background: #68bcff;">OPD_GENERA</th>
					<th style="background: #68bcff;">SURGI_SOCI</th>
					<th style="background: #68bcff;width: 10px">SURGI_GENE</th>
					<th style="background: #68bcff;">DOCTORFEE</th>
					<th style="background: #68bcff;">ยอดรวมทั้งหมด</th>
					<th style="background: #68bcff;">การันตีแพทย์</th>
					<th style="background: #68bcff;">การันตี</th>
					<th style="background: #68bcff;">จัดการ</th>
				</tr>
				<?php
				$i = 1;
				$sumDoctr = 0;
				$doctorfree = 0;
				foreach ($data as $value) {
					$sumDoctr = $sumDoctr+$value['sumAA'];

					$sumgene = $sumgene + $value['gene']; 
					$sumsoci = $sumsoci + $value['soci'];
					$sumgenera = $sumgenera +$value['genera'];
					$sumsocial =  $sumsocial+$value['social'];
					$doctorfree =  $doctorfree+$value['doctorfree'];
					?>
					<tr>
						<td class="v0-<?php echo $value['iddoctor']; ?>"><?php echo $i; ?></td>
						<td class="v1-<?php echo $value['iddoctor']; ?>"><?php echo $value['namedoctor']; ?></td>
						<td class="v2-<?php echo $value['iddoctor']; ?>"><?php echo $value['iddoctor']; ?></td>
						<td class="v3-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['social']); ?></td>
						<td class="v4-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['genera']); ?></td>
						<td class="v5-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['soci']); ?></td>
						<td class="v6-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['gene']); ?></td>
						<td class="v9-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['doctorfree']); ?></td>
						<td class="v7-<?php echo $value['iddoctor']; ?>">
							<?php
							if (isset($data4[$value['iddoctor']]['id'])) {

							if ($value['iddoctor'] == $data4[$value['iddoctor']]['id']) {
								 echo number_format($value['sumA'] + $data4[$value['iddoctor']]['pact']); 
							}
							
							}else{
								echo number_format($value['sumA']); 
							}
							 ?>
								
						</td>
						<td class="v12-<?php echo $value['iddoctor']; ?> tdgarunty">

							<?php
							if ($value['guarantee'] != '') {
								echo number_format($value['guarantee']);
							}else{

								echo '0';
							}


							?>



						</td>
						<td class="v11-<?php echo $value['iddoctor']; ?> garuntystatus">
							<?php
							$sumaJ = $value['sumA'];
							if (isset($data4[$value['iddoctor']]['id'])) {
								$sumaJ = $sumaJ + 	$data4[$value['iddoctor']]['pact'];
							}			
							if ($sumaJ > $value['guarantee'] ) {
								echo 'เกินการันตี';
								$garunty = '1';
							}else{

								echo 'ไม่เกินการันตี';
								$garunty = '0';
							}


							?>
						</td>
						<td class="v8-<?php echo $value['iddoctor']; ?>">
							<div class="bt-m" id="listmonthdoctor" data-id="<?php echo $value['iddoctor'];  ?>" data-monthrun="<?php echo $_POST['year'].'-'.$_POST['month']; ?>" data-typedoctor="<?php echo $_POST['idstatusDoctor']; ?>" data-extra="<?php echo $value['extra']; ?>" data-garunty="<?php echo $garunty; ?>">รายละเอียด</div>
							<div class="bt-mm" id="printPost" data-id="<?php echo $value['iddoctor'];  ?>"  data-monthrun="<?php echo $_POST['year'].'-'.$_POST['month']; ?>" data-typedoctor="<?php echo $_POST['idstatusDoctor']; ?>" data-extra="<?php echo $value['extra']; ?>" data-garunty="<?php echo $garunty; ?>">Print
							</div>
							<div class="bt-mm bgl" id="printPostconclude" data-id="<?php echo $value['iddoctor'];  ?>">ปริ้นสรุป
							</div>
							<div class="bt-mm bgl" id="printPostconcludeDetieat" data-id="<?php echo $value['iddoctor'];  ?>" >ปริ้นสรุปละเอียด
							</div>
						</td>
					</tr>
					<?php 
					$i++;
				}
				$sumnumberdortor = $sumarr + $sumDoctr;
				?>
				<tr>
					<td></td>
					<td><p class="sumtext">ยอดรวมทั้งหมดของหมอประจำ</p></td>
					<td></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumsocial); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumgenera); ?></div></td>
					<td><div class="sumtext hg"><?php echo number_format($sumsoci); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumgene); ?></div></td>
					<td><div class="sumtext hg"><?php echo number_format($doctorfree); ?></div></td>
					<td ><div class="sumtext hg" id="sumDFfull"><?php echo number_format($sumDoctr); ?></div></td>
					<td></td>
					<td></td>	
					<td></td>	 	
				</tr>
				<tr>
					<td></td>
					<td><p class="sumtext">รวมยอดที่ถูกตัด</p></td>
					<td></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumsocial); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumgenera + $p1); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumsoci); ?></div></td>
					<td><div class="sumtext hg"><?php echo number_format($sumgene); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($doctorfree); ?></div></td>
					<td ><div class="sumtext hg" id="sumDFfull"><?php echo number_format($sumDoctr + $p1); ?></div></td>
					<td></td>
					<td></td>	
					<td></td>	 	
				</tr>
				<tr>
					<td></td>
					<td><p class="sumtext">ยอดที่ถูกตัด</p></td>
					<td></td>
					<td>0</td>
					<td><div class="sumtext hg" id="sumDFfull"><?php echo number_format( $p1); ?></div></td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td >0</td>
					<td></td>
					<td></td>	
					<td></td>	 	
				</tr>
			</table>


			<?php 

		}else{
			?>

			<table id="tableSumwen">
				<tr>
					<th style="background: #68bcff;">ลำดับ</th>
					<th style="background: #68bcff;">ชื่อหมอ</th>
					<th style="background: #68bcff;">ว.หมอ</th>
					<th style="background: #68bcff;">OPD_SOCIAL</th>
					<th style="background: #68bcff;">OPD_GENERA</th>
					<th style="background: #68bcff;">SURGI_SOCI</th>
					<th style="background: #68bcff;width: 10px">SURGI_GENE</th>
					<th style="background: #68bcff;">DOCTORFEE</th>
					<th style="background: #68bcff;">ยอดรวมทั้งหมด</th>

					<th style="background: #68bcff;">จัดการ</th>
				</tr>
				<?php
				$i = 1;
				$sumDoctr = 0;
				$sumgene = 0;
				$sumsoci = 0;
				$sumgenera = 0;
				$sumsocial =0;
				$doctorfree = 0;
				$arr = 0;
				foreach ($data as $value) {
					$sumDoctr = $sumDoctr+$value['sumAA'];
					$sumgene = $sumgene + $value['gene']; 
					$sumsoci = $sumsoci + $value['soci'];
					$sumgenera = $sumgenera +$value['genera'];
					$sumsocial =  $sumsocial+$value['social'];
					$doctorfree =  $doctorfree+$value['doctorfree'];

					?>
					<tr class="tr">
						<td class="td v0-<?php echo $value['iddoctor']; ?>"><?php echo $i; ?></td>
						<td class="td v1-<?php echo $value['iddoctor']; ?>"><?php echo $value['namedoctor']; ?></td>
						<td class="v2-<?php echo $value['iddoctor']; ?>"><?php echo $value['iddoctor']; ?></td>
						<td class="td v3-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['social']); ?></td>
						<td class="td v4-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['genera']); ?></td>
						<td class="td v5-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['soci']); ?></td>
						<td class="td v6-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['gene']); ?></td>
						<td class="td v9-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['doctorfree']); ?></td>
						<td class="td v7-<?php echo $value['iddoctor']; ?>"><?php echo number_format($value['sumAA']); ?></td>
						<td class="td v8-<?php echo $value['iddoctor']; ?>">
							<div class="bt-m" id="listmonthdoctor" data-id="<?php echo $value['iddoctor'];  ?>" data-monthrun="<?php echo $_POST['year'].'-'.$_POST['month']; ?>" data-typedoctor="<?php echo $_POST['idstatusDoctor']; ?>" data-extra="<?php echo $value['extra']; ?>" data-garunty="<?php echo $garunty; ?>">รายละเอียด</div>
							<div class="bt-mm" id="printPost" data-id="<?php echo $value['iddoctor'];  ?>"  data-monthrun="<?php echo $_POST['year'].'-'.$_POST['month']; ?>" data-typedoctor="<?php echo $_POST['idstatusDoctor']; ?>" data-extra="<?php echo $value['extra']; ?>" data-garunty="<?php echo $garunty; ?>">Print
							</div>
						</td>
					</tr>
					<?php 
					$i++;
				}

				?>
				<tr>
					<td></td>
					<td><p class="sumtext">ยอดรวมทั้งหมดของหมอเวร</p></td>
					<td></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumsocial); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumgenera); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumsoci); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($sumgene); ?></div></td>
					<td><div class="sumtext hg" ><?php echo number_format($doctorfree); ?></div></td>
					<td ><div class="sumtext hg" id="sumDFfull"><?php echo number_format($sumDoctr); ?></div></td>
					<td></td>

				</tr>
				

			</table>


			<?php 




		}


	}
}


if ($_GET['d'] == 'sumEdit') {
	$sql = "SELECT SUM(OPD_SOCIAL)AS SOCIAL,SUM(OPD_GENERA)AS GENERA,SUM(SURGI_SOCI)AS SOCI , SUM(SURGI_GENE)AS GENE , SUM(DOCTORFEE)AS DOCTORFEE FROM payroll_doctor WHERE DATE BETWEEN'".$_POST['dateDF']."-01' and '".$_POST['dateDF']."-31' and CODE_NAME = '".$_POST['iddoctor']."' and DUTY = '".$_POST['tpyedoctor']."'";
	$data = [];
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();
	$data['idDoctor'] = $_POST['iddoctor'];
	$data['dateDF'] = $_POST['dateDF'];
	$data['SOCIAL'] = $row['SOCIAL'];
	$data['GENERA'] = $row['GENERA'];
	$data['SOCI'] = $row['SOCI'];
	$data['GENE'] = $row['GENE'];
	$data['DOCTORFEE'] = $row['DOCTORFEE'];
	$data['SUM'] = $row['SOCIAL']+$row['GENERA']+$row['SOCI']+$row['GENE']+ $row['DOCTORFEE'];


	echo json_encode($data);

}

if ($_GET['d'] == 'aggregate') {
	$sql = "SELECT SUM(OPD_SOCIAL)AS SOCIAL,SUM(OPD_GENERA)AS GENERA,SUM(SURGI_SOCI)AS SOCI , SUM(SURGI_GENE)AS GENE ,SUM(DOCTORFEE)AS DOCTORFEE  FROM payroll_doctor WHERE DATE BETWEEN'".$_POST['dateDF']."-01' and '".$_POST['dateDF']."-31' and DUTY = '".$_POST['tpyedoctor']."'";
	$data = [];
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();
	$data['SUM'] = $row['SOCIAL']+$row['GENERA']+$row['SOCI']+$row['GENE']+ $row['DOCTORFEE'];


	echo json_encode($data);

}

if ($_GET['d'] == 'editIPD'){

	$table = 'dataipd';
	$table1 = 'payroll_doctor';
	$datalo =[
		'di_date_df_doctor'=>$_POST['dateDF'],
		'di_service_charge'=>$_POST['servicecharge'],
		'di_ssp'=>$_POST['ssp'],
		'di_cash'=>$_POST['cash']
	];

	$where = 'di_id  ='.$_POST['id'];
	$id = update($table,$datalo,$where);
	if ($id) {
		$data['status'] = '1';

		$sql = "SELECT SUM(di_service_charge)AS service, SUM(di_ssp) AS ssp , SUM(di_cash)AS cash FROM dataipd WHERE  di_id_doctor = '".$_POST['iddoctor']."' and  di_date_df_doctor = '".$_POST['dateEdit']."' and di_type_file = '1' and di_type_doctor = '".$_POST['tpyedoctor']."'";
		$result = $connect->query($sql);
		$rowd = $result->fetch_assoc();
		$data['service'] = $rowd['service'];
		$data['ssp'] = $rowd['ssp'];
		$data['cash'] = $rowd['cash'];
		$monthY = explode("-",$_POST['dateDF']);
		$monthD = $monthY[0].'-'.$monthY[1];
		//print_r($monthY); die;
		$data['dateDF'] = $monthD;
		$data['iddoctor'] = $_POST['iddoctor'];
		$data['tpyedoctor'] = $_POST['tpyedoctor'];

		$datasum =[
			'OPD_SOCIAL'=>$rowd['ssp'],
			'OPD_GENERA'=>$rowd['cash']
		];
		$where1 = 'RECORD  ='.$_POST['idDF'];
		update($table1,$datasum,$where1);


	}else{

		$data['status'] = '0';
	}
	
	echo json_encode($data);

}

if ($_GET['d'] == 'deletedetailIPD'){
	$table = 'dataipd';
	$table1 = 'payroll_doctor';
	$where = 'di_id ='.$_POST['id'];
	$id = delete($table,$where);
	if ($id) {
		$data['succeed'] = '1'; 
		$sql = "SELECT SUM(di_service_charge)AS service, SUM(di_ssp) AS ssp , SUM(di_cash)AS cash FROM dataipd WHERE  di_id_doctor = '".$_POST['iddoctor']."' and  di_date_df_doctor = '".$_POST['dateM']."' and di_type_file = '1' and di_type_doctor = '".$_POST['tpyedoctor']."'";
		$result = $connect->query($sql);
		$rowd = $result->fetch_assoc();
		$data['service'] = $rowd['service'];
		$data['ssp'] = $rowd['ssp'];
		$data['cash'] = $rowd['cash'];
		$monthY = explode("-",$_POST['dateM']);
		$monthD = $monthY[0].'-'.$monthY[1];
		//print_r($monthY); die;
		$data['dateDF'] = $monthD;
		$data['iddoctor'] = $_POST['iddoctor'];
		$data['id'] = $_POST['id'];
		$data['tpyedoctor'] = $_POST['tpyedoctor'];

		$datasum =[
			'OPD_SOCIAL'=>$rowd['ssp'],
			'OPD_GENERA'=>$rowd['cash']
		];
		$where1 = 'RECORD  ='.$_POST['idDF'];
		update($table1,$datasum,$where1);

	}else{
		$data['succeed'] = '0'; 
	}

	echo json_encode($data);
}

if ($_GET['d'] == 'moveDF'){
	$table = 'dataipd';
	$table1 = 'payroll_doctor';
	$table2 = 'arrearedfdoctor';


	$sqldt = "SELECT * from dataipd WHERE  di_id = '".$_POST['id']."'";
	//echo $sqldt; die;
	$resultdt = $connect->query($sqldt);
	$rowddt = $resultdt->fetch_assoc();

	$datasum =[
		'af_details_trat'	=>$rowddt['di_details_treat'],
		'af_date_acp'		=>$rowddt['di_date_acp'],
		'af_sercicce_charge'=>$rowddt['di_service_charge'],
		'af_ssp'			=>$rowddt['di_ssp'],
		'af_cash'			=>$rowddt['di_cash'],
		'af_name_patient'	=>$rowddt['di_name_patient'],
		'af_HN'				=>$rowddt['di_HN'],
		'af_riht'			=>$rowddt['di_right'],
		'af_id_bill'		=>$rowddt['di_id_bill'],
		'af_id_doctor'		=>$rowddt['di_id_doctor'],
		'af_date_df_doctor'	=>$rowddt['di_date_df_doctor'],
		'af_type_file'		=>$rowddt['di_type_file'],
		'af_type_doctor'	=>$rowddt['di_type_doctor'],
		'af_arreare'		=>$rowddt['di_arreare']
	];
	insert($table2,$datasum);





	$where = 'di_id ='.$_POST['id'];
	$id = delete($table,$where);
	if ($id) {
		$data['succeed'] = '1'; 
		$sql = "SELECT SUM(di_service_charge)AS service, SUM(di_ssp) AS ssp , SUM(di_cash)AS cash FROM dataipd WHERE  di_id_doctor = '".$_POST['iddoctor']."' and  di_date_df_doctor = '".$_POST['dateM']."' and di_type_file = '1' and di_type_doctor = '".$_POST['tpyedoctor']."'";
		$result = $connect->query($sql);
		$rowd = $result->fetch_assoc();
		$data['service'] = $rowd['service'];
		$data['ssp'] = $rowd['ssp'];
		$data['cash'] = $rowd['cash'];
		$monthY = explode("-",$_POST['dateM']);
		$monthD = $monthY[0].'-'.$monthY[1];
		//print_r($monthY); die;
		$data['dateDF'] = $monthD;
		$data['iddoctor'] = $_POST['iddoctor'];
		$data['id'] = $_POST['id'];
		$data['tpyedoctor'] = $_POST['tpyedoctor'];

		$datasum =[
			'OPD_SOCIAL'=>$rowd['ssp'],
			'OPD_GENERA'=>$rowd['cash']
		];
		$where1 = 'RECORD  ='.$_POST['idDF'];
		update($table1,$datasum,$where1);

	}else{
		$data['succeed'] = '0'; 
	}

	echo json_encode($data);
}

if ($_GET['d'] == 'deletedetailOPDA'){
	$table1 = 'payroll_doctor';
	$where = 'RECORD  ='.$_POST['id'];
	$id = delete($table1,$where);
	if ($id){
		$data['succeed'] = '1'; 
		$data['id'] = $_POST['id'];
		$data['dateDF'] = $_POST['dateM']; 
		$data['iddoctor'] = $_POST['iddoctor'];  
		$data['typedoctor'] = $_POST['typedoctor'];  
	}else{
		$data['succeed'] = '0'; 
	}
	echo json_encode($data);

}

if ($_GET['d'] == 'idedit'){
	$iddocto = explode(".",$_POST['idDoctor']);
	$table1 = 'name_doctor';
	$datasum =[
		'CODE_NAME'=>$iddocto[1],
		'NAME_TITLE'=>$_POST['nameTitle'],
		'NAME'=>$_POST['name'],
		'LAST_NAME'=>$_POST['fname'],
		'W_DOCTOR'=>$_POST['idDoctor'],
		'salary'=>$_POST['salary'],
		'guarantee'=>$_POST['guarantee']
	];
	$where1 = 'ID   ='.$_POST['id'];
	$id = update($table1,$datasum,$where1);
	if ($id){
		$data['succeed'] = '1'; 

	}else{
		$data['succeed'] = '0'; 
	}
	echo json_encode($data);

}
if ($_GET['d'] == 'delnamDoctor'){

	$table1 = 'name_doctor';
	$where = 'ID  ='.$_POST['id'];
	$id = delete($table1,$where);
	if ($id){
		$data['succeed'] = '1'; 

	}else{
		$data['succeed'] ='0';
	}
	echo json_encode($data);

}
if ($_GET['d'] == 'addDotoe'){
	$table = 'name_doctor';
	$iddocto = explode(".",$_POST['idDoctor']);
	$datasum =[
		'CODE_NAME'=>$iddocto[1],
		'NAME_TITLE'=>$_POST['nameTitle'],
		'NAME'=>$_POST['name'],
		'LAST_NAME'=>$_POST['fname'],
		'W_DOCTOR'=>$_POST['idDoctor'],
		'salary'=>$_POST['salary'],
		'guarantee'=>$_POST['guarantee']
	];
	$id = insert($table,$datasum);
	if ($id){
		$data['succeed'] = '1'; 

	}else{
		$data['succeed'] ='0';
	}
	echo json_encode($data);

}

if ($_GET['d'] == 'updateT'){
	$table1 = 'setupdf';
	$datasum =[
		'sf_setup'=>$_POST['tax']
	];
	$where1 = 'sf_id='.$_POST['id'];
	$id = update($table1,$datasum,$where1);
	if ($id){
		$data['succeed'] = '1'; 

	}else{
		$data['succeed'] = '0'; 
	}
	echo json_encode($data);



}

if ($_GET['d'] == 'liserseltpay'){

	if ($_POST['monthsDoctor'] == '0') {
		$sql = "SELECT * FROM arrearedfdoctor WHERE  af_id_doctor = '".$_POST['idstatusDoctor']."' and af_status_pay_date BETWEEN '".$_POST['yearsdortor']."-01-01' and '".$_POST['yearsdortor']."-12-31' and  af_status_pay = '1'";
	}else{
		$sql = "SELECT * FROM arrearedfdoctor WHERE  af_id_doctor = '".$_POST['idstatusDoctor']."' and af_status_pay_date BETWEEN '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-01' and '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-31' and  af_status_pay = '1'";

	}
//echo $sql; die;
	$result = $connect->query($sql);
	?>
	<table>
		<tr>
			<th>วันที่ออก DF</th>
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
		$sum=0;
		$sumPss = 0;
		$sumcash = 0;
		while ($objResult = mysqli_fetch_array($result)) {
			if ($objResult['af_sercicce_charge'] !='') {
				$sum = $sum + $objResult['af_sercicce_charge'];
			}
			if ($objResult['af_ssp'] !='') {
				$sumPss = $sumPss + $objResult['af_ssp'];
			}
			if ($objResult['af_cash'] != '') {
				$sumcash = $sumcash + $objResult['af_cash'];
			}


			?>
			<tr class="D-<?php echo $objResult['af_id']; ?>">
				<td><?php echo $objResult['af_date_df_doctor']; ?></td>
				<td><?php echo $objResult['af_details_trat']; ?></td>			
				<td><?php echo $objResult['af_id_doctor']; ?></td>
				<td><?php echo $objResult['af_date_acp']; ?></td>
				<td><?php echo $objResult['af_sercicce_charge']; ?></td>
				<td><?php echo $objResult['af_ssp']; ?></td>
				<td><?php echo $objResult['af_cash']; ?></td>
				<td><?php echo $objResult['af_name_patient']; ?></td>
				<td><?php echo $objResult['af_HN']; ?></td>
				<td><?php echo $objResult['af_riht']; ?></td>
				<td><?php echo $objResult['af_id_bill']; ?></td>
				<td>				
					<div class="button wb btEpas" id="retrd" data-id="<?php echo $objResult['af_id']; ?>">คืน</div>
				</td>

			</tr>
		<?php }  ?>
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
			<td class="st"><div class="button pt" id="Printlistsspay">จ่าย <i class='fas fa-print'></i></div></td>
			<td class="st"></td>


		</tr>
	</table>
	<?php 

}

if ($_GET['d'] == 'liserselt'){

	$name = "SELECT NAME_TITLE, NAME, LAST_NAME ,salary,guarantee  FROM name_doctor WHERE CODE_NAME='".$_POST['idstatusDoctor']."'";
  $show_name = $connect->query($name);
  $sn = mysqli_fetch_array($show_name);
 
	 $sqlarreare = "SELECT sum(af_cash) as cach  FROM arrearedfdoctor WHERE af_id_doctor='".$_POST['idstatusDoctor']."'and af_date_df_doctor BETWEEN '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-01' and '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-31' ";
  $show_arreare = $connect->query($sqlarreare);
  $arreare = mysqli_fetch_array($show_arreare);
  if ($arreare['cach'] == '') {
    $arr = 0;
  }else{
    $arr = $arreare['cach'];
  }

  $sqls = "SELECT sum(af_cash) as cachs FROM arrearedfdoctor  WHERE  af_id_doctor = '".$_POST['idstatusDoctor']."' and af_date_df_doctor BETWEEN '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-01' and '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-31' and  af_status_pay = '1'";
  //secho $sqls; die;
  $arreared = $connect->query($sqls);
  $arrearedpay = mysqli_fetch_array($arreared);


  $sum = "SELECT SUM(OPD_SOCIAL),  SUM(OPD_GENERA), SUM(SURGI_SOCI), SUM(SURGI_GENE), SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE) 
  FROM payroll_doctor 
  WHERE DUTY = '1' and DATE BETWEEN '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-01' and '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-31' and CODE_NAME='".$_POST['idstatusDoctor']."'";
  //echo $sum; die;
  $summed = $connect->query($sum);
  $remaining  = 0;
  $perchen = 0;
  $conghern = 0 ;
  $perchen1 = 0;
  $sumDF = 0;
  $arrearsDFs = 0 ;
  $suning = 0;
while($roww = $summed->fetch_assoc()) { 
  $sumDF = $roww["SUM(OPD_SOCIAL) + SUM(OPD_GENERA) + SUM(SURGI_SOCI) + SUM(SURGI_GENE)"] +$arr;
}

	 $remaining = $sumDF - $sn['guarantee'];
	 $conghern = $remaining - $arr;
	 if ($conghern >= $arr) {
	    $perchen1 = $arr;
	 }else{
	 	$perchen1 = $remaining;
	 }

	 if ($perchen1 >= $arrearedpay['cachs']) {
	 	$arrearsDFs = $perchen1 - $arrearedpay['cachs'];
	 }




	if ($_POST['monthsDoctor'] == '0') {
		$sql = "SELECT * FROM arrearedfdoctor WHERE  af_id_doctor = '".$_POST['idstatusDoctor']."' and af_date_df_doctor BETWEEN '".$_POST['yearsdortor']."-01-01' and '".$_POST['yearsdortor']."-12-31' and  af_status_pay = '0'";
	}else{
		$sql = "SELECT * FROM arrearedfdoctor WHERE  af_id_doctor = '".$_POST['idstatusDoctor']."' and af_date_df_doctor BETWEEN '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-01' and '".$_POST['yearsdortor']."-".$_POST['monthsDoctor']."-31' and  af_status_pay = '0'";

	}
	$result = $connect->query($sql);
	?>
	<table>
		<tr>
			<th>วันที่ออก DF</th>
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
		$sum=0;
		$sumPss = 0;
		$sumcash = 0;
		while ($objResult = mysqli_fetch_array($result)) {
			if ($objResult['af_sercicce_charge'] !='') {
				$sum = $sum + $objResult['af_sercicce_charge'];
			}
			if ($objResult['af_ssp'] !='') {
				$sumPss = $sumPss + $objResult['af_ssp'];
			}
			if ($objResult['af_cash'] != '') {
				$sumcash = $sumcash + $objResult['af_cash'];
			}


			?>
			<tr class="D-<?php echo $objResult['af_id']; ?>">
				<td><?php echo $objResult['af_date_df_doctor']; ?></td>
				<td><?php echo $objResult['af_details_trat']; ?></td>			
				<td><?php echo $objResult['af_id_doctor']; ?></td>
				<td><?php echo $objResult['af_date_acp']; ?></td>
				<td><?php echo $objResult['af_sercicce_charge']; ?></td>
				<td><?php echo $objResult['af_ssp']; ?></td>
				<td><?php echo $objResult['af_cash']; ?></td>
				<td><?php echo $objResult['af_name_patient']; ?></td>
				<td><?php echo $objResult['af_HN']; ?></td>
				<td><?php echo $objResult['af_riht']; ?></td>
				<td><?php echo $objResult['af_id_bill']; ?></td>
				<td>

					<div class="button wb btEpa" id="pay" data-total="<?php echo  $arrearsDFs; ?>" data-id="<?php echo $objResult['af_id']; ?>">จ่าย</div>
					<div class="button wb btEpas" id="retrd" data-id="<?php echo $objResult['af_id']; ?>">คืน</div>
					
					

				</td>

			</tr>
		<?php }  ?>
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
			<td class="st"><div class="button pts total" id="paybill" data-total="<?php echo $sumcash; ?>">จ่ายตามบิล </div></td>


		</tr>
	</table>
	<?php 

}

if ($_GET['d'] == 'uturdD'){
	$table2 = 'dataipd';
	$table1 = 'payroll_doctor';
	$table = 'arrearedfdoctor';


	$sqldt = "SELECT * from arrearedfdoctor WHERE  af_id = '".$_POST['id']."'";
	$resultdt = $connect->query($sqldt);
	$rowddt = $resultdt->fetch_assoc();

	$datasum =[
		'di_details_treat'	=>$rowddt['af_details_trat'],
		'di_date_acp'		=>$rowddt['af_date_acp'],
		'di_service_charge'=>$rowddt['af_sercicce_charge'],
		'di_ssp'			=>$rowddt['af_ssp'],
		'di_cash'			=>$rowddt['af_cash'],
		'di_name_patient'	=>$rowddt['af_name_patient'],
		'di_HN'				=>$rowddt['af_HN'],
		'di_right'			=>$rowddt['af_riht'],
		'di_id_bill'		=>$rowddt['af_id_bill'],
		'di_id_doctor'		=>$rowddt['af_id_doctor'],
		'di_date_df_doctor'	=>$rowddt['af_date_df_doctor'],
		'di_type_file'		=>$rowddt['af_type_file'],
		'di_type_doctor'	=>$rowddt['af_type_doctor'],
		'di_arreare'		=>$rowddt['af_arreare']
	];
	$id =  insert($table2,$datasum);
	if ($id){
		$data['succeed'] = '1'; 
		$data['id'] = $_POST['id']; 

		
		$data['succeed'] = '1'; 
		$sql = "SELECT SUM(di_service_charge)AS service, SUM(di_ssp) AS ssp , SUM(di_cash)AS cash FROM dataipd WHERE  di_id_doctor = '".$rowddt['af_id_doctor']."' and  di_date_df_doctor = '".$rowddt['af_date_df_doctor']."' and di_type_file = '1' and di_type_doctor = '".$rowddt['af_type_doctor']."' and di_date_df_doctor = '".$rowddt['af_date_df_doctor']."'";
		$result = $connect->query($sql);
		$rowd = $result->fetch_assoc();

		$datasum =[
			'OPD_SOCIAL'=>$rowd['ssp'],
			'OPD_GENERA'=>$rowd['cash']
		];
		$where1 = "CODE_NAME  ='".$rowddt['af_id_doctor']."'and DATE ='".$rowddt['af_date_df_doctor']."'";
		update($table1,$datasum,$where1);
		$where = 'af_id  ='.$_POST['id'];
		
		delete($table,$where);
		$data['succeed'] ='1';
		$sqldtsm = "SELECT sum(af_sercicce_charge) as serviceCharge , sum(af_cash) as cash from arrearedfdoctor WHERE  af_id_doctor = '".$rowddt['af_id_doctor']."' and  af_date_df_doctor = '".$rowddt['af_date_df_doctor']."'";
		$resultdtsm = $connect->query($sqldtsm);
		$rowddtsm = $resultdtsm->fetch_assoc();

		
		$data['serviceCharge'] =$rowddtsm['serviceCharge'];
		$data['cash'] =$rowddtsm['cash'];


	}else{
		$data['succeed'] ='0';
	}
	echo json_encode($data);
}
?>