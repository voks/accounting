<!-- Page content Start -->
<!-- Title -->
<div class="row">
	<div class="dv-header col-md-12">
		<span class="page-title"> » Accounts Receivable</span>
		<hr/>
	</div>
</div>
<!-- First Row -->
<form class="searchAR-form">
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
		<div class="alert alert-warning alert-dismissible fade in  ar-alert-warning" role="alert">
				<strong>Warning!</strong> Accounts is not existing.
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<span class="txt">Customer:</span>
			<select class="form-control select2-dropdown" id="ar_customer" name="ar[ar_customer]">
				<?php 
				foreach ($accounts_receivable as $data) {
					echo "<option value='".$data->master_name."'>".$data->master_name."</option>";
				}
				?>
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
		<table class="table margin-top-30 search-table">
			<thead>
				<tr>
					<th>OR #</th>
					<th>OR Date</th>
					<th>Particulars</th>
					<th>Debit</th>
					<th>Credit</th>
					<th colspan="2" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody id="datalist">

			</tbody>
		</table>
	</div>
</div>
<!-- Print Button -->
<div class="row">
	<div class=" col-md-11">
		<a href="#" class="btn-style-1 animate-4 pull-left print-ar-list"><i class="fa fa-print"></i> Print Result </a>
	</div>
</div>
<!-- Page content end -->