<!-- Page content Start -->

<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title">Dashboard</span>
	</div>
</div>
<!-- First Row -->
<div class="row">
	<div class="col-md-2">
		<span class="txt">Sort by:</span>
		<select class="form-control main_txtbox select2-dropdown" id="sel-opt" name="">
			<option value="1">Monthly</option>
			<option value="2">Quarterly</option>
			<option value="3">Yearly</option>
		</select>
	</div>
	<div class="col-md-2 month">
		<span class="txt">Month:</span>
		<select class="form-control main_txtbox select2-dropdown" id="" name="">
			<?php 
			for ($i = 1; $i <= 12; $i++)
			{
				$month = date("F", time(0, 0, 0, $i+1, 0, 0, 0));
				echo '<option value="'.$month.'"';
				if ($i == date("n")) echo ' selected="selected"';
				echo '>'.$month.'</option>';
			};
			?>
		</select>
	</div>
	<div class="col-md-2 quarter" style="display:none;">
		<span class="txt">Quarter:</span>
		<select class="form-control main_txtbox select2-dropdown" id="" name="">
			<option value="1">First Quarter</option>
			<option value="2">Second Quarter</option>
			<option value="3">Third Quarter</option>
			<option value="4">Fourth Quarter</option>
		</select>
	</div>
	<div class="col-md-2">
		<span class="txt">Year:</span>
		<select class="form-control main_txtbox select2-dropdown" id="" name="">
			<?php
			foreach(range(2005, 2020) as $year) {
				echo "\t<option value='".$year."'>".$year."</option>\n\r";
			}
			?>
		</select>
	</div>
</div>
<!-- Divider -->
<div class="row">
	<div class="col-md-12">
		<div><hr/></div>
	</div>
</div>
<!-- Chart Tilte -->
<div class="row">
	<div class="col-md-12">
		<span class="page-subtitle">Sales</span>
	</div>
</div>
<!-- Actual Chart -->
<div class="row">
	<div class="col-md-6">
		<div id="chart1"></div>
	</div>
	<div class="col-md-6">
		<div id="chart2"></div>
	</div>
</div>
<!-- Divider -->
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<!-- Chrat title -->
<div class="row">
	<div class="col-md-12">
		<span class="page-subtitle">Cost of Goods Sold</span>
	</div>
</div>
<!-- Actual Chart -->
<div class="row">
	<div class="col-md-6">
		<div id="chart3"></div>
	</div>
	<div class="col-md-6">
		<div id="chart4"></div>
	</div>
</div>
<!-- Divider -->
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<!-- Chrat title -->
<div class="row">
	<div class="col-md-12">
		<span class="page-subtitle">Expenses</span>
	</div>
</div>
<!-- Actual Chart -->
<div class="row">
	<div class="col-md-6">
		<div id="chart5"></div>
	</div>
	<div class="col-md-6">
		<div id="chart6"></div>
	</div>
</div>
<!-- Divider -->
<div class="row">
	<div class="col-md-12">
		<hr>
	</div>
</div>
<!-- Chrat title -->
<div class="row">
	<div class="col-md-12">
		<span class="page-subtitle">Profit Summary</span>
	</div>
</div>
<!-- Actual Chart -->
<div class="row">
	<div class="col-md-6">
		<div id="chart7"></div>
	</div>
	<div class="col-md-6">
		<div id="chart8"></div>
	</div>
</div>

<!-- Page content end