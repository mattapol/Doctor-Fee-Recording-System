<?php



function flieDUpload($tmp,$froder,$type,$namefile,$status,$nameUpdate){


	if ($status == '') {
		return 0;
	}

	if ($status == 'insert') {

		$fileContent = file_get_contents($tmp);
		file_put_contents($froder.'/'.$namefile.'.'.$type, $fileContent);
		return 1;
	}

	if ($status == 'update') {
		
		$mantypu = explode(".",$nameUpdate);
		$typeup =  $mantypu[1];
		$namefileup =  $mantypu[0];
		@unlink($froder.'/'.$namefileup.'.'.$typeup);

		$fileContent = file_get_contents($tmp);
		file_put_contents($froder.'/'.$namefile.'.'.$type, $fileContent);

	}

	if ($status == 'delete') {
		$mantypu = explode(".",$nameUpdate);
		$typeup =  $mantypu[1];
		$namefileup =  $mantypu[0];

		@unlink($froder.'/'.$namefileup.'.'.$typeup);
	}





}



function insert($table,$data)
{
	global $connect;		
	$fields=""; $values="";
	$i=1;
	foreach($data as $key=>$val)
	{
		if($i!=1) { $fields.=", "; $values.=", "; }
		$fields.="$key";
		$values.="'$val'";
		$i++;
	}
	$sql = "INSERT INTO $table ($fields) VALUES ($values)";
		if($connect->query($sql)) { 
			$id = mysqli_insert_id($connect);
		return  $id ;
	} else {
	 	echo $sql;
 }
}

function update($table,$data,$where)
{
	global $connect;			
	$modifs="";
	$i=1;
	foreach($data as $key=>$val)
	{
		if($i!=1){ $modifs.=", "; }
		$modifs.=$key.' = "'.$val.'"'; 
		$i++;
	}
	$sql = ("UPDATE $table SET $modifs WHERE $where");
	if($connect->query($sql)) { return true; } 
	else { die("SQL Error: <br>".$sql."<br>".$connect->error); return false; }
}

function delete($table, $where)
{
	global $connect;			
	$sql = "DELETE FROM $table WHERE $where";
	if($connect->query($sql)) { return true; } 
	else { die("SQL Error: <br>".$sql."<br>".$connect->error); return false; }
}



function previweSelectEdit($tabeld,$where)
{   global $connect;	
	$sql = 'select * from ' . $tabeld.' WHERE '.$where;
	$result = mysqli_query($connect,$sql);
	$res = mysqli_fetch_assoc($result);
	if ($res ) {
		return $res;
	}else{
		echo $sql;

	}
	
}



 ?>