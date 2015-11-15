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
			<input type="hidden" class="form-control entry-text" value="" id="ctr_acct" name="trial[ctr_acct]">
			<select class="form-control select2-dropdown entry-select" >
				<option value=""> -- Select Account Title -- </option>
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
				<!-- <option value="1">All Journals</option>
				<option value="3">Accounts Payable</option>
				<option value="2">Cash Receipts</option>
				<option value="4">Check Disbursement</option>
				<option value="6">General Journals</option>
				<option value="5">Sales Journals</option> -->
				<option value="">All Journals</option>
				<option value="ap">Accounts Payable</option>
				<option value="cr">Cash Receipts</option>
				<option value="cd">Check Disbursement</option>
				<option value="gj">General Journals</option>
				<option value="sj">Sales Journals</option>
			</select>
		</div>
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
				<?php 
					// $sumd=0;
					// $sumc=0;
					// foreach ($trial as $key) {
					// 	echo "	
					// 			<tr>
					// 				<td>".element('subcode',$key)."</td>
					// 				<td class='title'>".element('title',$key)."</td>
					// 				<td>".element('debit',$key)."</td>
					// 				<td>".element('credit',$key)."</td>
					// 				<td>
					// 					<a href='#' data-ac='".element('code',$key)."' data-sb='".element('subcode',$key)."' class='btn-style-1 animate-4 viewLedger'><i class='fa fa-eye'></i></a>
					// 				</td>
					// 			</tr>
					// 		";
					// 		$sumd+=element('debit',$key);
					// 		$sumc+=element('credit',$key);
					// }
					// 	echo "
					// 			<tr>
					// 				<td></td>
					// 				<td class='title'>Total:</td>
					// 				<td>".$sumd."</td>
					// 				<td>".$sumc."</td>
					// 			</tr>"
					// 		;
				?>
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