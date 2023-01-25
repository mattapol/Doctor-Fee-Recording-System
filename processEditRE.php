<?php
include 'condb.php';

$table = 'payroll_doctor';

if ($_GET['status'] == 'Edit') {

	$datalo =[
		'DATE'=>$_POST['Dateregular'],
		'CODE_NAME'=>$_POST['Coderegular'],
		'TIME1'=>$_POST['time1'],
		'TIME2'=>$_POST['time2'],
		'WORK'=>$_POST['Workregular'],
		'OPD_SOCIAL'=>$_POST['Socialregular'],
		'OPD_GENERA'=>$_POST['Generaregular'],
		'SURGI_SOCI'=>$_POST['sociregular'],
		'SURGI_GENE'=>$_POST['Generegular'],
		'DOCTORFEE'=>$_POST['DOCTORFEE'],
		'PT_NAME'=>$_POST['Ptregular'],
		'DUTY'=>$_POST['typeCoderegular']
	];

	$where = 'RECORD ='.$_POST['id'];
	$id = update($table,$datalo,$where);
	if ($id) {
		$data['succeed'] = '1';
		$data['numberD'] = $_POST['numberD']; 
		$data['id'] = $_POST['id']; 
		$data['Ptregular'] = $_POST['Ptregular']; 
		$data['Generegular'] = $_POST['Generegular']; 
		$data['sociregular'] = $_POST['sociregular']; 
		$data['Generaregular'] = $_POST['Generaregular']; 
		$data['Socialregular'] = $_POST['Socialregular']; 
		$data['Workregular'] = $_POST['Workregular']; 
		$data['Dateregular'] = $_POST['Dateregular']; 
		$data['typeCoderegular'] = $_POST['typeCoderegular']; 
		$data['dateDFdoctor'] = $_POST['dateDFdoctor']; 
		$data['iddoctor'] = $_POST['Coderegular']; 
		$data['DOCTORFEE'] = $_POST['DOCTORFEE']; 
		$data['time1'] = $_POST['time1']; 
		$data['time2'] = $_POST['time2']; 
		$data['typedoctor'] = $_POST['typedoctor']; 
	}else{
		$data['succeed'] = '0'; 
	}

	echo json_encode($data);
}

if ($_GET['status'] == 'pay'){
	$table = 'arrearedfdoctor';
	
		
	$sql = "SELECT af_cash FROM arrearedfdoctor WHERE af_id = '".$_POST['id']."'";
	$result = $connect->query($sql);
	$rows = $result->fetch_assoc();

	$sumtotal = 0;
	if ($_POST['total'] >= $rows['af_cash']) {
		$sumtotal  = $_POST['total'] - $rows['af_cash'];
		$datalo =[
		'af_status_pay'=>'1',
		'af_status_pay_date'=>$_POST['year'].'-'.$_POST['month'].'-'.date('d')
		
	];

		$where = 'af_id ='.$_POST['id'];
		$id = update($table,$datalo,$where);

	}else{
		$datalo =[
		'af_status_pay'=>'1',
		'af_status_pay_date'=>$_POST['year'].'-'.$_POST['month'].'-'.date('d'),
		'af_cash' => $_POST['total']
		
	];

	$where = 'af_id ='.$_POST['id'];
	$id = update($table,$datalo,$where);
	$sumtotal = 0;
	}
	


	if ($id) {
		$data['id'] = $_POST['id']; 
		$data['succeed'] = '1'; 
		$data['total'] = $sumtotal; 
	}else{
		$data['succeed'] = '0'; 
	}

	echo json_encode($data);


}

if ($_GET['status'] == 'paybill'){
	$table = 'arrearedfdoctor';

	$sql = "SELECT * FROM arrearedfdoctor WHERE af_id_bill = '".$_POST['billpay']."' and  af_status_pay = '0'";
	$result = $connect->query($sql);
	$rows = mysqli_num_rows($result);
	if ($rows  > 0) {
		$i = 1;
		$total = $_POST['total'];
		while ($row = $result->fetch_assoc()){

			
			if ($total >= $row['af_cash']) {
				$total1 = $total - $row['af_cash'];
			}else{

				if ($total == '0') {
					$total1 = 0;
				}else{
					$total1 = $row['af_cash']; 

				}
			}
			

			

			$datalo =[
				'af_status_pay'=>'1',
				'af_status_pay_date'=>$_POST['year'].'-'.$_POST['month'].'-'.date('d'),
				'af_cash'=> $total1

			];

			$where = 'af_id ='.$row['af_id'];
			$id = update($table,$datalo,$where);
			if ($id) {
				$data[$i]['id'] = $row['af_id']; 
				$data['succeed'] = '1'; 
				$i++;
			}else{
				$data['succeed'] = '0'; 
			}
			

		}
		
	}else{
		$data['succeed'] = '3'; // ไม่พบข้อมูลหมายเลขบิลนี้ 
	}
	//echo json_encode($data);
}
?>