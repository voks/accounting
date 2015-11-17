<!-- Page content Start -->
<form class="bank-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title"> » Bank Reconciliation Balance</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible fade in  bank-alert-success" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Success!</strong> Added New Bank Account Record.
			</div>

			<div class="alert alert-warning alert-dismissible fade in  bank-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Bank Account already exist.
			</div>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-3">
			<input type="hidden" id="project_id" name="bank[project_id]" value="<?php echo $this->session->userdata('project_id') ?>" />
			<span class="txt">Bank:</span>
			<select class="form-control empty_txtbx select2-dropdown" id="bank_name" name="bank[bank_name]">
				<option> -- Select Bank -- </option>
				<?php 
					foreach ($bank_recon as $data) {
						echo "<option>".$data->sub_name."</option>";
					}
				?>
			</select>
		</div>
		<div class="col-md-2">
			<span class="txt">Month:</span>
			<select class="form-control empty_txtbx select2-dropdown" id="bank_month" name="bank[bank_month]">
				<?php 
					for ($i = 1; $i <= 12; $i++)
					{
						$month = date("F", mktime(0, 0, 0, $i+1, 0, 0, 0));
						echo '<option value="'.$month.'"';
						if ($i == date("n")) echo ' selected="selected"';
						echo '>'.$month.'</option>';
					};
				?>
			</select>
		</div>
		<div class="col-md-2">
			<span class="txt">Year:</span>
			<select class="form-control empty_txtbx select2-dropdown" id="bank_year" name="bank[bank_year]">
				<?php
				foreach(range(2005, 2020) as $year) {
					echo "\t<option value='".$year."'>".$year."</option>\n\r";
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<span class="txt">Balance:</span>
			<input type="text" class="form-control empty_txtbx amount" id="bank_balance" name="bank[bank_balance]">
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35 pull-left"><i class="fa fa-save"></i> Save Account</button>
		</div>
	</div>
</form>

<form class="searchBank-form">
	<!-- SubTitle -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title">» Accounts Record</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible fade in  search-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Bank is not existing.
			</div>
		</div>
	</div>
	<!-- Search Fields -->
	<div class="row">
		<div class="col-md-5">
			<span class="txt">Bank:</span>
			<select class="form-control select2-dropdown" id="searchBank_name" name="searchBank[searchBank_name]">
				<option> -- Select Bank -- </option>
				<?php 
					foreach ($bank_recon as $data) {
						echo "<option>".$data->sub_name."</option>";
					}
				?>
			</select>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35 pull-left"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>
</form>

<!-- Searched Results Table List -->
<div class="row">
	<div class="col-md-12">
		<table class="table margin-top-20 search-table">
			<thead>
				<tr>
					<th></th>
					<th>Bank</th>
					<th>Month</th>
					<th>Year</th>
					<th>Balance</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<button class="btn btn-style-1 pull-right">Reconcile</button>
	</div>				
</div>
<!-- Print Button -->
<div class="row">
	<div class="col-md-11">
		<a href="#" class="btn-style-1 animate-4 pull-left bankRecon-report-print"><i class="fa fa-print"></i> Print Result List</a>
	</div>
</div>