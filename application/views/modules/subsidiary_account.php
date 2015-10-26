<!-- Page content Start -->
<form class="subAccount-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title">» Subsidiary Account</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible fade in  sub-alert-success" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Success!</strong> Added New Subsidiary Account Record.
			</div>

			<div class="alert alert-warning alert-dismissible fade in  sub-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Subsidiary Account already exist.
			</div>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<input  type="hidden" value="<?=$this->session->userdata('project_id')?>" name="subsidiary[project_id]" >
		<div class="col-md-3">
			<span class="txt">Date:</span>
			<input type="text" placeholder="mm/dd/yyy" id="sub_date" name="subsidiary[sub_date]" class="form-control datepicker main_txtbox" />
		</div>
		<div class="col-md-2">
			<span class="txt">Account Type:</span>
			<select class="form-control main_txtbox sub-accounttype select2-dropdown" id="account_type" name="subsidiary[account_type]">
				<option value="Assets"></option>
				<option value="Assets">Assets</option>
				<option value="Liabilities">Liabilities</option>
				<option value="Capital">Capital</option>
				<option value="Revenue">Revenue</option>
				<option value="Expense">Expense</option>
			</select>
		</div>
		<div class="col-md-2">
			<span class="txt">Account Code:</span>
			<input type="text" class="form-control main_txtbox sub-accountcode"  id="account_type" name="subsidiary[account_code]" Placeholder="00000"/>
		</div>
		<div class="col-md-5">
			<span class="txt">Account Title:</span>
			<select class="form-control main_txtbox select2-dropdown sub_account_title" id="account_title" name="subsidiary[account_title]">
				<option value="">-- Select Account Title --</option>
				<?php
				foreach ($account_title as $title) {
					echo "<option>".$title->account_code." - ".$title->account_title."</option>";
				}
				?>
			</select>
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Subsidairy Code:</span>
			<input type="text" data-inputmask-clearmaskonlostfocus="false" class="form-control main_txtbox sub-input-masked" id="sub_code" name="subsidiary[sub_code]" />
		</div>
		<div class="col-md-4">
			<span class="txt">Subdiary Name:</span>
			<input type="text" class="form-control main_txtbox" id="sub_name" name="subsidiary[sub_name]">
		</div>
		<div class="col-md-3">
			<span class="txt">Link to Master</span>
			<select name="subsidiary[master_link]" id="" class="form-control select2-dropdown">
				<option value="00000"> -- Select Master -- </option>
				<?php 
				foreach ($master_name as $data) {
					echo "<option value='".$data->master_code."'>".$data->master_name."</option>";
				}
				?>
			</select>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-30 pull-right"><i class="fa fa-plus"></i> Add Account </button>
		</div>
	</div>
</form>



<form class="searchSub-form">
	<!-- Sub title -->
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
				<strong>Warning!</strong> Main Account is not existing.
			</div>
		</div>
	</div>
	<!-- Search Fields -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Account Type:</span>
			<select id="searchAccount_type" name="searchAccount[searchAccount_type]" class="form-control select2-dropdown">
				<option value="Assets">Assets</option>
				<option value="Liabilities">Liabilities</option>
				<option value="Capital">Capital</option>
				<option value="Revenue">Revenue</option>
				<option value="Expense">Expense</option>
			</select>
		</div>

		<div class="col-md-2">
			<span class="txt">Subsidiary Code:</span>
			<input type="text" id="searchAccount_code" name="searchAccount[searchAccount_code]" class="form-control accountcode-placeholder" Placeholder="1000">
		</div>

		<div class="col-md-4">
			<span class="txt">Subsidiary Name:</span>
			<input type="text" class="form-control" id="searchAccount_name" name="searchAccount[searchAccount_name]">
		</div>

		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35 pull-let"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>
</form>

<!-- Account Code and Account Name details -->
<!-- <div class="row">
	<div class="col-md-3">
		<span class="txt">Account Code:</span>
	</div>
	<div class="col-md-3">
		<span class="txt">Account Tile:</span>
	</div>
</div> -->
<!-- Searched Results Table -->
<div class="row">
	<div class="col-md-10">
		<table class="table margin-top-20 search-table">
			<thead>
				<tr>
					<th>Account Type</th>
					<th>Subsidairy Code</th>
					<th>Subsidiary Name</th>
				</tr>
			</thead>
			<tbody>
				<tr>

				</tr>
			</tbody>
		</table>
	</div>
</div>
<!-- Print Button -->
<div class="row">
	<div class="col-md-11">
		<a href="#" class="btn btn-style-1 animate-4 pull-left subaccount-report-print"><i class="fa fa-print"></i> Print Result List</a>
	</div>
</div>
