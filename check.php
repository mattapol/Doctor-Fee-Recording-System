<?php include 'condb.php';
     
 	$CODE_N = $_POST['code_name']; 
	
	$Query = mysqli_query($connect, "SELECT * FROM name_doctor WHERE CODE_NAME= '".$CODE_N."'");

	$Row = mysqli_fetch_array($Query);
	if($Row){
		echo $Row['NAME_TITLE'] . ".";
		echo "" .$Row['NAME'] . " ";
		echo $Row['LAST_NAME'];
	}else{
		echo "ไม่พบรายชื่อในฐานข้อมูล";
	}
?>