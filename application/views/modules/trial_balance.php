<!-- Page content Start -->
<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"> » Trial Balance</span>
		<hr/>
	</div>
</div>
<form class="form_trail">
	<!-- First Row -->
	<div class="row dv-container">
		<div class="col-md-6">
			<span class="txt">Control Account:</span>
			<input type="hidden" class="form-control entry-text" value="none" id="ctr_acct" name="trial[ctr_acct]">
			<select class="form-control select2-dropdown entry-select" >
				<option value="none"> -- Select Account Title -- </option>
				<?php
				foreach ($trial_balance as $title) {
					echo "<option>".$title->account_code." - ".$title->account_title."</option>";
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<span class="txt">From:</span>
			<input type="text" placeholder="mm/dd/yyyy" class="form-control datepicker" id="from_date" name="trial[from_date]">
		</div>
		<div class="col-md-3">
			<span class="txt">To:</span>
			<input type="text" placeholder="mm/dd/yyyy" class="form-control datepicker" id="to_date" name="trial[to_date]">
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-4">
			<span class="txt">Journal:</span>
			<select class="form-control select2-dropdown" id="journal_type" name="trial[journal_type]">
				<option value="all">All Journals</option>
				<option value="ap">Accounts Payable</option>
				<option value="cr">Cash Receipts</option>
				<option value="cd">Check Disbursement</option>
				<option value="gj">General Journals</option>
				<option value="sj">Sales Journals</option>
			</select>
		</div>
		<!-- <div class="col-md-2">
			<span class="txt">&nbsp;</span>
			<label><input type="checkbox" name="trial[listing]"  value="0" class="listing" id="trans"> Group by Title</label>
		</div> -->
		<div class="col-md-2">
			<button class="btn btn-style-1 animate-4 margin-top-35"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>
</form>

<!-- Searched Results Table List -->
<!--Workng but not responsive-->
<div class="row">
	<div class="col-md-12">
		<table class="table" id="datalist">
			<thead>
				<tr>
					<th class="text-center">Code</th>
					<th class="text-center">Title</th>
					<th class="text-center">Debit</th>
					<th class="text-center">Credit</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody class="tbtran_data">
			</tbody>
		</table>
	</div>
</div>
<!-- Print Button -->
<div class="row">
	<div class=" col-md-11">
		<a href="#" class="btn-style-1 print-trial-list animate-4 pull-left"><i class="fa fa-print"></i> Print Result </a>
	</div>
</div>
<!-- Page content end -->