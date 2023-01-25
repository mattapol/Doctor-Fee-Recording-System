<div class="fom-date" style="padding: 23px;">
	<table class="table-m">
		<tr>
			<td class="td-m">
				<div class="from-y">
					<select name="dayconclude" id="dayconclude">
						<option value="">เลือกวัน</option>
						<option value="01">1</option>
						<option value="02">2</option>
						<option value="03">3</option>
						<option value="04">4</option>
						<option value="05">5</option>
						<option value="06">6</option>
						<option value="07">7</option>
						<option value="08">8</option>
						<option value="09">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>

				</div>
			</td>
			<td class="td-m">
				<div class="from-y">
					<select name="monthsconclude" id="monthsconclude">
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
					<select name="yearsconclude" id="yearsconclude">
						<option value="">เลือกปี</option>
						<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option> 
						<option value="<?php echo $yy['1']['1']; ?>"><?php echo $yy['1']['1']; ?></option>
						<option value="<?php echo $yy['2']['2']; ?>"><?php echo $yy['2']['2']; ?></option>

					</select>

				</div>
			</td>



		</tr>
	</table>
	<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">
</div>