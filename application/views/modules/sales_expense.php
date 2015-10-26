<!-- Page content Start -->
<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"> » Sales and Expense</span>
		<hr/>
	</div>
</div>
<!-- First Row -->
<div class="row">
	<div class="row">
		<!-- <div class="col-md-2">
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
				//<?php 
				//for ($i = 1; $i <= 12; $i++)
				//{
				//	$month = date("F", mktime(0, 0, 0, $i+1, 0, 0, 0));
				//	echo '<option value="'.$month.'"';
				//	if ($i == date("n")) echo ' selected="selected"';
				//	echo '>'.$month.'</option>';
				//};
				//?>
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
				//<?php
				//foreach(range(2005, 2020) as $year) {
				//	echo "\t<option value='".$year."'>".$year."</option>\n\r";
				//}
				//?>
			</select>
		</div> -->
		<div class="col-md-2">
			<span class="txt">Date To</span>
			<input type="text"placeholder="mm/dd/yyyy" class="form-control datepicker">
		</div>
		<div class="col-md-2">
			<span class="txt">Date From</span>
			<input type="text" placeholder="mm/dd/yyyy" class="form-control datepicker">
		</div>
		<div class="col-md-2">
			<span class="txt">Report</span>
			<select name="" id="" class="form-control select2-dropdown">
				<option value="1">Sales</option>
				<option value="2">Expense</option>
			</select>
		</div>
		<div class="col-md-4">
			<span class="txt">Report Description</span>
			<select name="" id="" class="form-control select2-dropdown">
				<option value="1">CASH REWARD</option>
				<option value="2">AGS</option>
			</select>
		</div>
		<div class="col-md-2 margin-top-30">
			<button class="btn btn-style-1"><i class="fa fa-refresh"></i> Generate</button>
		</div>
	</div>
<!-- Page content end -->