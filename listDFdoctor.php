<?php
include 'condb.php';

$sqld = "SELECT * FROM payroll_doctor WHERE DUTY = '".$_GET['idtypeDoctor']."' and DATE BETWEEN '".$_GET['dat']."-01' and '".$_GET['dat']."-31' and CODE_NAME='".$_GET['id']."'";
$resultd = $connect->query($sqld);
if ($_GET['idtypeDoctor'] == '1') {


?>
<table>
	<tr>
		<th>DATE</th>
		<th>CODE_NAME</th>
		<th>WORK</th>
		<th>OPD_SOCIAL</th>
		<th>OPD_GENERA</th>
		<th>SURGI_SOCI</th>
		<th>SURGI_GENE</th>
		<th>PT_NAME</th>
		<th>รายละเอียด</th>
	</tr>
	<?php
	$i = 1;
	while ($rowd = $resultd->fetch_assoc()){

		?>
		<tr class="O-<?php echo $rowd['RECORD']; ?>">
			<td class="D1-<?php echo $i; ?>"><?php echo $rowd['DATE']; ?></td>
			<td class="D2-<?php echo $i; ?>"><?php echo $rowd['CODE_NAME']; ?></td>
			<td class="D3-<?php echo $i; ?>"><?php echo $rowd['WORK']; ?></td>
			<td class="D4-<?php echo $i; ?>" id="sumssp"><?php echo $rowd['OPD_SOCIAL']; ?></td>
			<td class="D5-<?php echo $i; ?>" id="sumcash"><?php echo $rowd['OPD_GENERA']; ?></td>
			<td class="D6-<?php echo $i; ?>"><?php echo $rowd['SURGI_SOCI']; ?></td>
			<td class="D7-<?php echo $i; ?>"><?php echo $rowd['SURGI_GENE']; ?></td>
			<td class="D8-<?php echo $i; ?>"><div class="textcss"><?php echo $rowd['PT_NAME'] ?></div></td>
			<td>
				<?php if ($rowd['extra'] == '1') {?>
				<div class="button wb" id="detailsIPD" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $rowd['DATE']; ?>" data-typeFile="1" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">จัดการ</div>

				<div class="button wb btD" id="delIpddate" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $rowd['DATE']; ?>" data-typeFile="1" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">ลบ</div>
				<?php }  ?>
				<?php if ($rowd['extra'] == '2') {?>
				<div class="button bg wb" id="editD" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-date="<?php echo $_GET['dat']; ?>" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">แก้ไข</div>
				<div class="button wb btD" id="deleteOpd" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $_GET['dat']; ?>" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">ลบ</div>
				<?php }  ?>
				<?php if ($rowd['extra'] == '3') {?>
				<div class="button bg wb" id="editD" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-date="<?php echo $_GET['dat']; ?>" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">แก้ไข</div>
				<div class="button wb btD" id="deleteOpd" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $_GET['dat']; ?>" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">ลบ</div>
				<?php }  ?>
			</td>

		</tr>
		<?php
		$i++;
	}
	?>
</table>

<?php 
}else{ ?>
<table>
	<tr>
		<th>DATE</th>
		<th>CODE_NAME</th>
		<th>TIME1</th>
		<th>TIME2</th>
		<th>WORK</th>
		<th>OPD_SOCIAL</th>
		<th>OPD_GENERA</th>
		<th>SURGI_SOCI</th>
		<th>SURGI_GENE</th>
		<th>DOCTORFEE</th>
		<th>PT_NAME</th>
		<th>รายละเอียด</th>
	</tr>
	<?php
	$i = 1;
	while ($rowd = $resultd->fetch_assoc()){

		?>
		<tr class="O-<?php echo $rowd['RECORD']; ?>">
			<td class="D1-<?php echo $i; ?>"><?php echo $rowd['DATE']; ?></td>
			<td class="D2-<?php echo $i; ?>"><?php echo $rowd['CODE_NAME']; ?></td>
			<td class="D9-<?php echo $i; ?>"><?php echo $rowd['TIME1']; ?></td>
			<td class="D10-<?php echo $i; ?>"><?php echo $rowd['TIME2']; ?></td>
			<td class="D3-<?php echo $i; ?>"><?php echo $rowd['WORK']; ?></td>
			<td class="D4-<?php echo $i; ?>" id="sumssp"><?php echo $rowd['OPD_SOCIAL']; ?></td>
			<td class="D5-<?php echo $i; ?>" id="sumcash"><?php echo $rowd['OPD_GENERA']; ?></td>
			<td class="D6-<?php echo $i; ?>"><?php echo $rowd['SURGI_SOCI']; ?></td>
			<td class="D7-<?php echo $i; ?>"><?php echo $rowd['SURGI_GENE']; ?></td>
			<td class="D11-<?php echo $i; ?>"><?php echo $rowd['DOCTORFEE']; ?></td>
			<td class="D8-<?php echo $i; ?>"><div class="textcss"><?php echo $rowd['PT_NAME'] ?></div></td>
			<td>
				<?php if ($rowd['extra'] == '1') {?>
				<div class="button wb" id="detailsIPD" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $rowd['DATE']; ?>" data-typeFile="1" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">จัดการ</div>

				<div class="button wb btD" id="delIpddate" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $rowd['DATE']; ?>" data-typeFile="1" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">ลบ</div>
				<?php }  ?>
				<?php if ($rowd['extra'] == '2') {?>
				<div class="button bg wb" id="editD" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-date="<?php echo $_GET['dat']; ?>" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">แก้ไข</div>
				<div class="button wb btD" id="deleteOpd" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $_GET['dat']; ?>">ลบ</div>
				<?php }  ?>
				<?php if ($rowd['extra'] == '3') {?>
				<div class="button bg wb" id="editD" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-date="<?php echo $_GET['dat']; ?>" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">แก้ไข</div>
				<div class="button wb btD" id="deleteOpd" data-id="<?php echo $rowd['RECORD']; ?>" data-number="<?php echo $i; ?>" data-statusEdit="<?php echo $rowd['extra'];?>" data-iddoctor="<?php echo $rowd['CODE_NAME']; ?>" data-date="<?php echo $_GET['dat']; ?>" data-typeDoctor="<?php echo $_GET['idtypeDoctor']; ?>">ลบ</div>
				<?php }  ?>
			</td>

		</tr>
		<?php
		$i++;
	}
	?>
</table> 


<?php }