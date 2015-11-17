	<!-- Page content Start -->
	<form class="mgt-form">
		<!-- Title -->
		<div class="row">
			<div class="dv-header col-md-12">
				<span class="page-title"> » Management Report</span>
				<hr/>
			</div>
		</div>
		<!-- Alerts -->
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success alert-dismissible fade in  bank-alert-success" role="alert">
					<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Success!</strong> New Bank Account is Added.
				</div>

				<div class="alert alert-warning alert-dismissible fade in  bank-alert-warning" role="alert">
					<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Warning!</strong> Bank Account is already exist.
				</div>
			</div>
		</div>
		<!-- First Row -->
		<div class="row">

			<!-- <div class="col-md-2">
				<span class="txt">Sort by:</span>
				<select class="form-control empty_txtbx select2-dropdown" id="sel-opt" name="">
					<option value="1">Monthly</option>
					<option value="2">Quarterly</option>
					<option value="3">Yearly</option>
				</select>
			</div>
			<div class="col-md-2 month">
				<span class="txt">Month:</span>
				<select class="form-control empty_txtbx select2-dropdown" id="" name="">
					<?php 
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
				<select class="form-control empty_txtbx select2-dropdown" id="" name="">
					<option value="1">First Quarter</option>
					<option value="2">Second Quarter</option>
					<option value="3">Third Quarter</option>
					<option value="4">Fourth Quarter</option>
				</select>
			</div>

			<div class="col-md-2">
				<span class="txt">Year:</span>
				<select class="form-control empty_txtbx select2-dropdown" id="" name="">
					<?php
					//foreach(range(2005, 2020) as $year) {
					//	echo "\t<option value='".$year."'>".$year."</option>\n\r";
					//}
					?>
				</select>
			</div> -->

			<div class="col-md-3">
				<span class="txt">From</span>
				<input type="text" placeholder="mm/dd/yyyy" id="mgt_date_fr" name="mgt[mgt_date_fr]" class="form-control datepicker">
			</div>
			<div class="col-md-3">
				<span class="txt">To</span>
				<input type="text" placeholder="mm/dd/yyyy" id="mgt_date_to" name="mgt[mgt_date_to]" class="form-control datepicker">
			</div>

			<div class="col-md-4">
				<span class="txt">Report:</span>
				<select name="mgt[mgt_report_type]" id="mgt_report_type" class="form-control select2-dropdown">
					<option value="1">Attachement of Financial Statement</option>
					<option value="2">Balance Sheet</option>
					<option value="3">Bank Reconciliation</option>
					<!-- <option value="4">Cash Position</option>  -->
					<option value="5">Profit and Loss</option>
					<!-- <option value="5">Income Statement</option> -->
					<!-- <option value="6">Profit and Loss</option> -->
					<option value="7">Schedule of Accounts Payable - Trade</option>
					<option value="8">Schedule of Accounts Payable - Non-Trade</option>
					<option value="9">Schedule of Accounts Payable - Other</option>
					<option value="10">Schedule of Accounts Receivable - Trade</option>
					<option value="11">Schedule of Accounts Receivable - Non-Trade</option>
					<option value="12">Schedule of Accounts Receivable - Other</option>
					<option value="13">Schedule of Advances of Employee</option>
					<option value="14">Schedule of Advances of Officers</option>
					<option value="15">Statement of Cash Flow</option>
					<option value="16">Statement of Operating Expenses</option>
					<!-- <option value="17">Trial Balance</option>
					<option value="18">Taxes and Licenses</option>
					<option value="19">Prepaid Expenses</option>
					<option value="20">Security Deposits</option>
					<option value="21">Prepaid Rent</option>
					<option value="22">Computer Equipment</option>
					<option value="23">Office Furnitures</option>
					<option value="24">Intangible Assets</option>
					<option value="25">Leashold Improvement</option> -->
				</select>
			</div>
			<div class="col-md-2">
				<a href="#" class="btn btn-style-1 animate-4 margin-top-35 pull-left management-report-print"><i class="fa fa-refresh"></i> Generate</a>
			</div>
		</div>
	</form>