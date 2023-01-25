<script type="text/javascript" src="js/daleteUp.js"></script>

<div class="from-delModl">
	<div class="from-date-delete">
		<label>เลือกวันที่ต้องการลบ</label>
		<input type="text" name="testdate6"  class="date datetimepicker"placeholder="เลือกวันที่ลบ"  id="testdate6"  autocomplete="off">
	</div>
	<div class="from-date-delete">
		<label>เลือกประเภทไฟล์ที่ต้องการลบ</label>
		<select name="typefiles" id="typefiles">
			<option value="">ประเภทไฟล์ที่อัพโหลด</option>
			<option value="1">IPD</option>
			<option value="2">OPD</option>
		</select>
	</div>
	<div class="from-date-delete">
		<label>เลือกประเภทหมอที่ต้องการลบ</label>
		<select name="typedoctor" id="typedoctor">
			<option value="">เลือกประเภทหมอที่ต้องการลบ</option>
			<option value="1">หมอประจำ</option>
			<option value="2">หมอเวร</option>
		</select>
	</div>
	<div class="from-date-delete">
		<label>** หมายเหตุ (กรณีต้องการลบข้อมูลเฉพาะหมอ ใส่ ว.หมอ)</label>
		<input type="text" name="numberDoctor" class="date" id="numberDoctor">
	</div>
	<div class="from-date-delete tbl">
		<div class="button" id="listuploadDelete">แสดงรายการที่ต้องการลบ</div>
	</div>
	<div class="listDeleteUp"></div>
</div>

