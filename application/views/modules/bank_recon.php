<!-- Page content Start -->
<form class="searchBank-form">
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
			<div class="alert alert-warning alert-dismissible fade in  search-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Bank is not existing.
			</div>
		</div>
	</div>
	<!-- Search Fields -->
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
		<div class="col-md-6">
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
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35 pull-left"><i class="fa fa-search"></i> Search Cheques</button>
		</div>
	</div>
</form>

<!-- Searched Results Table List -->
<div class="row">
	<div class="col-md-12">
		<table class="table fixed-table table-condensed margin-top-30 search-table">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Date</th>
					<th>Bank</th>
					<th>Memo/Payee</th>
					<th>Deposit</th>
					<th>Withdrawal</th>
				</tr>
			</thead>
		</table>
		<div class="div-table-content">
			<table class="table fixed-table table-condensed search-table">
				<tbody class="tran_data">
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr><tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
					<tr>
						<td><input type="checkbox"/></td>
						<td>5654</td>
						<td>10/06/2015</td>
						<td>Cash in Bank - BDO San Juan</td>
						<td>Sommer Systems</td>
						<td>0.00</td>
						<td>15,000.00</td>
					</tr>
				</tbody>
			</table>
		</div>
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