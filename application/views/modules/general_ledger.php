<!-- Page content Start -->
<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"> » General Ledger</span>
		<hr/>
	</div>
</div>
<form class="form-gl-search">
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
		<div class="alert alert-warning alert-dismissible fade in  search-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Accounts is not existing.
			</div>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-6">
			<span class="txt">Control Account:</span>
			<input type="hidden" class="form-control entry-text" value="" name="gl-search[account]" >
			<input type="hidden" class="form-control entry-code" value="" name="gl-search[sub_account]">
			<select class="form-control select2-dropdown entry-select" id="main_account" name="gl-search[main_account]">
				<option> -- Select Account Title -- </option>
				<?php
					foreach ($account_title as $title) {
						echo "<option value='".$title->account_code."'>".$title->account_code." - ".$title->account_title."</option>";
					}
				?>
			</select>
		</div>
		<div class="col-md-6">
			<span class="txt">Subsidiary Account:</span>
			<select class="form-control select2-dropdown entry-subname" id="sub_account">
				<option> -- Select Subsidiary -- </option>
			</select>
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">From:</span>
			<input type="text" class="form-control datepicker" placeholder="mm/dd/yyyy" id="from_date" name="gl-search[from_date]">
		</div>
		<div class="col-md-3">
			<span class="txt">To:</span>
			<input type="text" class="form-control datepicker" placeholder="mm/dd/yyyy" id="to_date" name="gl-search[to_date]">
		</div>
		<div class="col-md-3">
			<span class="txt">Journal:</span>
			<select id="journal" class="form-control select2-dropdown" name="gl-search[journal]">
				<option value="1">All Journals</option>
				<option value="2">Cash Receipts</option>
				<option value="3">Accounts Payable</option>
				<option value="4">Check Disbursement</option>
				<option value="5">Sales Journals</option>
				<option value="6">General Journals</option>
			</select>
		</div>
		<div class="col-md-2">
			<button class="btn btn-style-1 animate-4 margin-top-35"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>	
</form>

<!-- Searched Results Table List -->
<div class="row">
	<div class="col-md-12">
		<table class="table margin-top-30" id="datalist">
			<thead>
				<tr>
					<th>Date</th>
					<th>Payee Name</th>
					<th>Particulars</th>
					<th>TRN No</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="tran_data">

			</tbody>
		</table>
	</div>
</div>
<!-- Print Button -->
<div class="row">
	<div class=" col-md-11">
		<a href="#" class="btn-style-1 animate-4 pull-left search-result"><i class="fa fa-print"></i> Print Result </a>
	</div>
</div>
			<!-- Page content end