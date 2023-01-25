<div class="fom-date" style="padding: 23px;">
	<div class="from-bill">
	<label>Bill No.</label>
	<input type="text" name="billpay" id="billpay">
	</div>
	<label>เลือกเดือนที่ต้องการจ่ายยอดค้าง</label>
	<table class="table-m">
		<tr>
			<td class="td-m">
				<div class="from-y">
					<select name="monthspaybill" id="monthspaybill">
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
					<select name="yearspayBill" id="yearspayBill">
						<option value="">เลือกปี</option>
						<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option> 
						<option value="<?php echo $yy['1']['1']; ?>"><?php echo $yy['1']['1']; ?></option>
						<option value="<?php echo $yy['2']['2']; ?>"><?php echo $yy['2']['2']; ?></option>

					</select>

				</div>
			</td>



		</tr>
	</table>
	<input type="hidden" name="total" id="total" value="<?php echo $_GET['total']; ?>">
</div>