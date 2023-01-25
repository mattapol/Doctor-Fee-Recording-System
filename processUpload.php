<?php
include 'vendor/autoload.php';
include 'condb.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

$sta = '';
$fileName = $_FILES['file']['name'];
$manty = explode(".",$fileName);
$type =  $manty[1];
$namefile =  date('YmdHis');
$nameimgSql = $namefile.'.'.$type;
$froder = 'uploadExcel';
$tmp = $_FILES["file"]["tmp_name"];
$status = 'insert';
$nameUpdate = '';
$sta = flieDUpload($tmp,$froder,$type,$namefile,$status,$nameUpdate);
if ($sta == '1') {

	$spreadsheet = new Spreadsheet();
	$spreadsheet->getProperties()->setCreator('Maarten Balliauw')
	->setLastModifiedBy('Maarten Balliauw')
	->setTitle('Office 2007 XLSX Test Document')
	->setSubject('Office 2007 XLSX Test Document')
	->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
	->setKeywords('office 2007 openxml php')
	->setCategory('Test result file');

// Add some data
	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	$reader->setReadDataOnly(true);
	$worksheet = $reader->load("uploadExcel/".$nameimgSql);
	$worksheett = $worksheet->getActiveSheet();
	$highestRow = $worksheett->getHighestRow(); // e.g. 10
	$highestColumn = $worksheett->getHighestColumn(); // e.g 'F'
	$sheetData = $worksheett->ToArray(null,true,true,true);

	


	$table = 'dataipd';
	$table1 = 'payroll_doctor';
	if ($_POST['typefile'] == '1') {

		$sql = "SELECT * FROM payroll_doctor WHERE DUTY = '".$_POST['typeDoctor']."' and date = '".$_POST['dateUp']."' and type_treat = '".$_POST['typefile']."'";

		$result = $connect->query($sql);
		$row = $result->fetch_assoc();
		if (isset($row['RECORD']) == '') {
		$data = [];
		$data1 = [];
		$data2 = [];
		$n = 1;

		$L = 1;
		$k = 1;
		$dotor = '';
		if ($_POST['typefilsDoctor'] != '') {
			$statusfile = '3';
		}else{
			$statusfile = '1';
		}
		
		if ($sheetData[6]['D'] == 'รหัสแพทย์') {

			for ($i=6; $i <= $highestRow ; $i++){

				if ($sheetData[$i]['D'] == 'รหัสแพทย์') {
					$names = explode("R",$sheetData[$i]['E']);
					if ($names[0] != '') {
						$dotor = $names[0];
					}else{
						$dotor = $names[1];

					}


					$data[$n]['dotor'] = $dotor;
					$data[$n]['namedotor'] = $sheetData[$i]['I'];
					$n++;
				}else{
					if ($sheetData[$i]['E'] != '' && $sheetData[$i]['E'] != 'ยอดรวม') { 			
						$data1[$L]['detDF'] = $sheetData[$i]['C'];
						$data1[$L]['datenameDF'] = $sheetData[$i]['E'];
						$data1[$L]['guaranteeDF'] = $sheetData[$i]['G'];
						$data1[$L]['service_charge'] = $sheetData[$i]['F'];
						$data1[$L]['cashDF'] = $sheetData[$i]['H'];
						$data1[$L]['HN'] = $sheetData[$i]['K'];
						$data1[$L]['right'] = $sheetData[$i]['L'];
						$data1[$L]['name'] = $sheetData[$i]['I'];
						$data1[$L]['BillDF'] = $sheetData[$i]['M'];
						$data1[$L]['dotor'] = $dotor;
						$data1[$L]['dateDF'] = $_POST['dateUp'];
						$data1[$L]['WORKDF'] = $sheetData[1]['A'];

						$datalo =[
							'di_details_treat'=>$sheetData[$i]['C'],
							'di_date_acp'=>$sheetData[$i]['E'],
							'di_service_charge'=>$sheetData[$i]['F'],
							'di_ssp'=>$sheetData[$i]['G'],
							'di_cash'=> $sheetData[$i]['H'],
							'di_name_patient'=>$sheetData[$i]['I'],
							'di_HN'=>$sheetData[$i]['K'],
							'di_right'=>$sheetData[$i]['L'],
							'di_id_bill'=>$sheetData[$i]['M'],
							'di_id_doctor'=>$dotor,
							'di_date_df_doctor'=>$_POST['dateUp'],
							'di_type_file'=> $statusfile,
							'di_type_doctor'=>$_POST['typeDoctor']

						];
						insert($table,$datalo);
						$L++;
					}
					if ($sheetData[$i]['F'] != '') {
						$data2[$k]['dotor'] = $dotor;
						$data2[$k]['guaranteeDF'] = $sheetData[$i]['G'];
						$data2[$k]['cashDF'] = $sheetData[$i]['H'];
						$k++;
					}

				}


			} 


			$data4 = [];
			for ($p=1; $p < $n ; $p++) { 
				$data4[$p]['IDDotor'] = $data[$p]['dotor'];
				$data4[$p]['name'] = '';
				for ($u=1; $u < $L ; $u++) { 
					if ($data[$p]['dotor'] == $data1[$u]['dotor']){

						$name = explode(" ",$data1[$u]['name']);
						if (count($name) > 2) {
							$f = 1;
						}else{
							$f = 0;
						}

						if ($data4[$p]['name'] == '') {
							$data4[$p]['name'] = $name[$f];
						}else{
							$data4[$p]['name'] .= ','.$name[$f];

						}
						$names = explode(",",$data4[$p]['name']);
						$fruit_array = array_unique($names);
						$data4[$p]['dateDF'] = $data1[$u]['dateDF'];
						$data4[$p]['WORKDF'] = $data1[$u]['WORKDF'];
						$data4[$p]['namecut'] = '';
						foreach ($fruit_array as  $values) {
							if ($data4[$p]['namecut'] == '') {
								$data4[$p]['namecut'] = $values;
							}else{
								$data4[$p]['namecut'] .= ','.$values;

							}
						}

					}
				}
				for ($g=1; $g < $k; $g++) { 
					if ($data[$p]['dotor'] == $data2[$g]['dotor']) {
						$data4[$p]['guaranteeDF'] = $data2[$g]['guaranteeDF'];
						$data4[$p]['cashDF'] = $data2[$g]['cashDF'];
					}
				}
			}

			for ($ii=1; $ii < $p; $ii++) { 

				$dataI =[
					'DATE'=>$_POST['dateUp'],
					'CODE_NAME'=>$data4[$ii]['IDDotor'],
					'TIME1'=>'',
					'TIME2'=>'',
					'WORK'=> $data4[$ii]['WORKDF'],
					'OPD_SOCIAL'=>$data4[$ii]['guaranteeDF'],
					'OPD_GENERA'=>$data4[$ii]['cashDF'],
					'SURGI_SOCI'=> '',
					'SURGI_GENE'=> '',
					'DOCTORFEE'=> '',
					'PT_NAME'=> $data4[$ii]['namecut'],
					'DUTY'=> $_POST['typeDoctor'],
					'type_treat'=> $statusfile,
					'extra'=> '1'

				];
				insert($table1,$dataI);

			}

			unlink("uploadExcel/".$nameimgSql);
			?>
			
			<table>
				<tr>
					<th>วันที่</th>
					<th>ID Doctor</th>
					<th>WORK</th>
					<th>OPD_SOCIAL</th>
					<th>OPD_GENERA</th>
					<th>SURGI_SOCI</th>
					<th>SURGI_GENE</th>
					<th>PT_NAME</th>
					<th>รายละเอียด</th>
				</tr>
				<?php
				foreach ($data4 as $value) {
					?>
					<tr>
						<td><?php echo $value['dateDF']; ?></td>
						<td><?php echo $value['IDDotor']; ?></td>
						<td><?php echo $value['WORKDF']; ?></td>
						<td><?php echo $value['guaranteeDF']; ?></td>
						<td><?php echo $value['cashDF']; ?></td>
						<td><?php echo ''; ?></td>
						<td><?php echo ''; ?></td>
						<td><?php echo $value['namecut'] ?></td>
						<td><div class="button" id="listdocyor" data-id="<?php echo $value['IDDotor']; ?>" data-tpyedoctor="<?php echo $_POST['typeDoctor']; ?>" data-typefile="<?php echo $statusfile; ?>" data-date-doctor="<?php echo $value['dateDF']; ?>">รายละเอียด</div></td>

					</tr>
				<?php } ?>
			</table>

			<?php 

		}else{
			echo 0;
		}

      }else{
      	echo 1;
      }
      unlink("uploadExcel/".$nameimgSql);
	}else{
		//typefilsDoctor = 1 ไฟล์ที่มีเวลาจะเป็น ot  2= ไฟล์ที่ไม่มีเวลา
		//print_r($sheetData); die;
		if ($_POST['typefilsDoctor'] == '1') {
			$dataOT = [];
			for ($i=2; $i <= $highestRow ; $i++){
				if (isset($sheetData[$i]['B']) ) {
					$names = explode("R",$sheetData[$i]['B']);
					if ($names[0] != '') {
						$dotor = $names[0];
					}else{
						$dotor = $names[1];

					}
				}
				

				$datalo =[
					'DATE'=>$sheetData[$i]['A'],
					'CODE_NAME'=>$dotor,
					'TIME1'=>$sheetData[$i]['C'].'.00',
					'TIME2'=>$sheetData[$i]['D'].'.00',
					'WORK'=> $sheetData[$i]['E'],
					'OPD_SOCIAL'=>$sheetData[$i]['F'],
					'OPD_GENERA'=>$sheetData[$i]['G'],
					'SURGI_SOCI'=> '',
					'SURGI_GENE'=> '',
					'DOCTORFEE'=> $sheetData[$i]['H'],
					'PT_NAME'=>$sheetData[$i]['I'],
					'DUTY'=> $_POST['typeDoctor'],
					'type_treat'=> '2',
					'extra'=> '3'

				];
				insert($table1,$datalo);
				

				$dataOT[$i]['DATE'] = $sheetData[$i]['A'];
				$dataOT[$i]['NAME'] = $sheetData[$i]['B'];
				$dataOT[$i]['TIME1'] = $sheetData[$i]['C'];
				$dataOT[$i]['TIME2'] = $sheetData[$i]['D'];
				$dataOT[$i]['WORK'] = $sheetData[$i]['E'];
				$dataOT[$i]['OPD_SOCIAL'] = $sheetData[$i]['F'];
				$dataOT[$i]['OPD_GENERA'] = $sheetData[$i]['G'];
				$dataOT[$i]['DOCTORFEE'] = $sheetData[$i]['H'];
				$dataOT[$i]['PT_NAME'] = $sheetData[$i]['I'];
				

				
			}
			?>

			<table>
				<tr>
					<th>DATE</th>
					<th>NAME</th>
					<th>TIME1</th>
					<th>TIME2</th>
					<th>WORK</th>
					<th>OPD_SOCIAL</th>
					<th>OPD_GENERA</th>
					<th>DOCTORFEE</th>
					<th>PT_NAME</th>


				</tr>
				<?php
				foreach ($dataOT as $value) {
					?>
					<tr>
						<td><?php echo $value['DATE']; ?></td>
						<td><?php echo $value['NAME']; ?></td>
						<td><?php echo $value['TIME1']; ?></td>
						<td><?php echo $value['TIME2']; ?></td>
						<td><?php echo $value['WORK']; ?></td>
						<td><?php echo $value['OPD_SOCIAL']; ?></td>
						<td><?php echo $value['OPD_GENERA']; ?></td>
						<td><?php echo $value['DOCTORFEE']; ?></td>
						<td><?php echo $value['PT_NAME'] ?></td>
						

					</tr>
				<?php } ?>
			</table>



			<?php
			unlink("uploadExcel/".$nameimgSql);
		}else{
			$dataOPD = [];
			$dotor = '';
			for ($i=2; $i < $highestRow ; $i++){
				if (isset($sheetData[$i]['B']) ) {
					$names = explode("R",$sheetData[$i]['B']);
					if ($names[0] != '') {
						$dotor = $names[0];
					}else{
						$dotor = $names[1];

					}
				}
				
				// $excelDate = $sheetData[$i]['A']; //2018-11-03
				// $miliseconds = ($excelDate - (25567 + 2)) * 86400 * 1000;
				// $seconds = $miliseconds / 1000;
				// $dates = date("Y-m-d", $seconds);
				$datalo =[
					'DATE'=>$sheetData[$i]['A'],
					'CODE_NAME'=>$dotor,
					'TIME1'=>'',
					'TIME2'=>'',
					'WORK'=> $sheetData[$i]['C'],
					'OPD_SOCIAL'=>$sheetData[$i]['D'],
					'OPD_GENERA'=>$sheetData[$i]['E'],
					'SURGI_SOCI'=> $sheetData[$i]['F'],
					'SURGI_GENE'=> $sheetData[$i]['G'],
					'DOCTORFEE'=> '',
					'PT_NAME'=>$sheetData[$i]['H'],
					'DUTY'=> $_POST['typeDoctor'],
					'type_treat'=> '2',
					'extra'=> '2'

				];
				insert($table1,$datalo);
				

				$dataOPD[$i]['DATE'] = $sheetData[$i]['A'];
				$dataOPD[$i]['NAME'] = $sheetData[$i]['B'];
				$dataOPD[$i]['WORK'] = $sheetData[$i]['C'];
				$dataOPD[$i]['OPD_SOCIAL'] = $sheetData[$i]['D'];
				$dataOPD[$i]['OPD_GENERA'] = $sheetData[$i]['E'];
				$dataOPD[$i]['SURGI_GENE'] = $sheetData[$i]['G'];
				$dataOPD[$i]['DOCTOR_FEE'] = '';
				$dataOPD[$i]['SURGI_SOCI'] = $sheetData[$i]['F'];
				$dataOPD[$i]['PT_NAME'] = $sheetData[$i]['H'];
				
			}
			// echo '<pre>';
			// print_r($dataOPD);
			// echo '</pre>';

			?>

			<table>
				<tr>
					<th>DATE</th>
					<th>NAME</th>
					<th>WORK</th>
					<th>OPD_SOCIAL</th>
					<th>OPD_GENERA</th>
					<th>DOCTOR_FEE</th>
					<th>SURGI_SOCI</th>
					<th>SURGI_GENE</th>
					<th>PT_NAME</th>

				</tr>
				<?php
				foreach ($dataOPD as $value) {
					?>
					<tr>
						<td><?php echo $value['DATE']; ?></td>
						<td><?php echo $value['NAME']; ?></td>
						<td><?php echo $value['WORK']; ?></td>
						<td><?php echo $value['OPD_SOCIAL']; ?></td>
						<td><?php echo $value['OPD_GENERA']; ?></td>
						<td><?php echo $value['DOCTOR_FEE']; ?></td>
						<td><?php echo $value['SURGI_SOCI']; ?></td>
						<td><?php echo $value['SURGI_GENE']; ?></td>
						<td><?php echo $value['PT_NAME'] ?></td>
						

					</tr>
				<?php } ?>
			</table>



			<?php
			unlink("uploadExcel/".$nameimgSql);
		}


	}	

}
?>
<?php 
}else{
     header("Location: login.php");
     exit();
}
?>