<?php
include 'condb.php';


	$sql = "SELECT * FROM payroll_doctor WHERE RECORD='".$_GET['id']."' ";
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();

	?>

	<div class="from-edit">
		<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
		<input type="hidden" name="numberD" id="numberD" value="<?php echo $_GET['numberD']; ?>">
		<input type="hidden" name="typedoctor" id="typedoctor" value="<?php echo $_GET['typedoctor']; ?>">
		<input type="hidden" name="dateDFdoctor" id="dateDFdoctor" value="<?php echo $_GET['dateDFdoctor']; ?>">
		<div class="from-input-edit">
			<label>DATE</label>
			<input type="date" name="Dateregular" id="Dateregular" class="inputText" value="<?php echo $row['DATE']; ?>">
		</div>
		<div class="from-input-edit">
			<label>CODE_NAME</label>
			<input type="text" name="Coderegular" id="Coderegular" class="inputText" value="<?php echo $row['CODE_NAME']; ?>">
		</div>
		<div class="from-input-edit">
			<label>เปลี่ยนประเภทหมอ</label>
			<select name="typeCoderegular" id="typeCoderegular">
				<?php
				if ($row['DUTY'] == '1') {
					?>
					<option value="1">หมอประจำ</option>
					<option value="2">หมอเวร</option>
					<?php
				}else{
					?>
					<option value="2">หมอเวร</option>
					<option value="1">หมอประจำ</option>
					<?php

				}
				?>
				
				
			</select>
		</div>
		<div class="from-input-edit">
			<label>TIME1</label>
			<input type="text" name="time1" id="time1" class="inputText" value="<?php echo $row['TIME1']; ?>">
		</div>
		<div class="from-input-edit">
			<label>TIME2</label>
			<input type="text" name="time2" id="time2" class="inputText" value="<?php echo $row['TIME2']; ?>">
		</div>
		<div class="from-input-edit">
			<label>WORK</label>
			<input type="text" name="Workregular" id="Workregular" class="inputText" value="<?php echo $row['WORK']; ?>">
		</div>
		<div class="from-input-edit">
			<label>OPD_SOCIAL</label>
			<input type="text" name="Socialregular" id="Socialregular"class="inputText" value="<?php echo $row['OPD_SOCIAL']; ?>">
		</div>
		<div class="from-input-edit">
			<label>OPD_GENERA</label>
			<input type="text" name="Generaregular" id="Generaregular" class="inputText" value="<?php echo $row['OPD_GENERA']; ?>">
		</div>
		<div class="from-input-edit">
			<label>SURGI_SOCI</label>
			<input type="text" name="sociregular" id="sociregular" class="inputText" value="<?php echo $row['SURGI_SOCI']; ?>">
		</div>
		<div class="from-input-edit">
			<label>SURGI_GENE</label>
			<input type="text" name="Generegular" id="Generegular" class="inputText" value="<?php echo $row['SURGI_GENE']; ?>">
		</div>
		<div class="from-input-edit">
			<label>DOCTORFEE</label>
			<input type="text" name="DOCTORFEE" id="DOCTORFEE" class="inputText" value="<?php echo $row['DOCTORFEE']; ?>">
		</div>
		<div class="from-input-edit">
			<label>PT_NAME</label>
			<input type="text" name="Ptregular" id="Ptregular" class="inputText" value="<?php echo $row['PT_NAME']; ?>">
		</div>
	</div>




	<?php

?>