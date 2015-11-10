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
<!-- Page content end-->

<!-- CR Edit Trasaction Modal-->
<div class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" id="cr_edit_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<h4 class="modal-title" id="">Edit Transaction</h4>
			</div>
			<div class="modal-body">
				<!-- First Row -->
				<div class="row">
					<div class="col-md-2">
						<span class="txt">OR #:</span>
						<input type="text" class="form-control cr_ornum">
					</div>
					<div class="col-md-2">
						<span class="txt">OR Date:</span>
						<input type="text" class="form-control cr_ordate">
					</div>
					<div class="col-md-5">
						<span class="txt">Customer:</span>
						<input type="text" class="form-control cr_cust">
					</div>
					<div class="col-md-3">
						<span class="txt">BI #:</span>
						<input type="text" class="form-control cr_bino">
					</div>
				</div>
				<!-- Second Row -->
				<div class="row">
					<div class="col-md-4">
						<span class="txt">Bank:</span>
						<input type="text" class="form-control cr_bank">
					</div>
					<div class="col-md-3">
						<span class="txt">OR Amount:</span>
						<input type="text" class="form-control cr_amt">
					</div>
					<div class="col-md-5">
						<span class="txt">Particulars:</span>
						<input type="text" class="form-control cr_part">
					</div>
				</div>
				<!-- fourth Row: Adding Accounts -->
				<div class="row">
					<div class="col-md-12">
						<div class="table" >
							<table class="table" id="cr_edit_table">
								<thead>
									<tr>
										<th>Account Code</th>
										<th>Title</th>
										<th>Debit (DR)</th>
										<th>Credit (CR)</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<tr>
										<td>TOTAL</td><td ></td>
										<td><input type="text" class="form-control entry-debit-total totdr" readonly="true" value=""></td>
										<td><input type="text" class="form-control entry-credit-total totcr" readonly="true" value=""></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-style-1"><i class="fa fa-save"></i> Update Transaction</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!-- AP Edit Trasaction Modal-->
<div class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" id="ap_edit_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<h4 class="modal-title" id="">Edit Transaction</h4>
			</div>
			<div class="modal-body">
				<!-- First Row -->
				<div class="row">
					<div class="col-md-3">
						<span class="txt">Invoice Date:</span>
						<input type="text" class="form-control invdate" value="">
					</div>
					<div class="col-md-3">
						<span class="txt">Invoice #:</span>
						<input type="text" class="form-control invno" value="">
					</div>
					<div class="col-md-3">
						<span class="txt">PO #:</span>
						<input type="text" class="form-control pono" value="">
					</div>
					<div class="col-md-1">
						<span class="txt">Terms:</span>
						<input type="text" class="form-control terms" value="">
					</div>
					<div class="col-md-2">
						<span class="txt">Invoice Amount:</span>
						<input type="text" class="form-control invamt" value="">
					</div>
				</div>
				<!-- Second Row -->
				<div class="row">
					<div class="col-md-6">
						<span class="txt">Supplier:</span>
						<input type="text" readonly="true" class="form-control supp" value="">
					</div>
					<div class="col-md-6">
						<span class="txt">Particulars:</span>
						<input type="text" class="form-control part" value="">
					</div>
				</div>
				<!-- fourth Row: Adding Accounts -->
				<div class="row">
					<div class="col-md-12">
						<div class="table" >
							<table class="table" id="ap_edit_table">
								<thead>
									<tr>
										<th>Account Code</th>
										<th>Title</th>
										<th>Debit (DR)</th>
										<th>Credit (CR)</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<tr>
										<td>TOTAL</td><td ></td>
										<td><input type="text" class="form-control entry-debit-total totdr" readonly="true" value=""></td>
										<td><input type="text" class="form-control entry-credit-total totcr" readonly="true" value=""></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-style-1"><i class="fa fa-save"></i> Update Transaction</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!-- CD Edit Trasaction Modal-->
<div class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" id="cd_edit_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<h4 class="modal-title" id="">Edit Transaction</h4>
			</div>
			<div class="modal-body">
				<!-- First Row -->
				<div class="row">
					<div class="col-md-2">
						<span class="txt">Date:</span>
						<input type="text" class="form-control cd_date">
					</div>
					<div class="col-md-2">
						<span class="txt">Voucher #:</span>
						<input type="text" class="form-control cd_vnum">
					</div>
					<div class="col-md-3">
						<span class="txt">Check#:</span>
						<input type="text" class="form-control cd_chcknum">
					</div>
					<div class="col-md-5">
						<span class="txt">Bank:</span>
						<input type="text" class="form-control cd_bank">
					</div>
				</div>
				<!-- Second Row -->
				<div class="row">
					<div class="col-md-4">
						<span class="txt">Payee Name:</span>
						<input type="text" class="form-control cd_name">
					</div>
					<div class="col-md-3">
						<span class="txt">Check Amount:</span>
						<input type="text" class="form-control cd_chckamt">
					</div>
					<div class="col-md-5">
						<span class="txt">Particulars</span>
						<input type="text" class="form-control cd_part">
					</div>
				</div>
				<!-- fourth Row: Adding Accounts -->
				<div class="row">
					<div class="col-md-12">
						<div class="table" >
							<table class="table" id="cd_edit_table">
								<thead>
									<tr>
										<th>Account Code</th>
										<th>Title</th>
										<th>Debit (DR)</th>
										<th>Credit (CR)</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<tr>
										<td>TOTAL</td><td ></td>
										<td><input type="text" class="form-control entry-debit-total totdr" readonly="true" value=""></td>
										<td><input type="text" class="form-control entry-credit-total totcr" readonly="true" value=""></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-style-1"><i class="fa fa-save"></i> Update Transaction</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!-- SJ Edit Trasaction Modal-->
<div class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" id="sj_edit_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<h4 class="modal-title" id="">Edit Transaction</h4>
			</div>
			<div class="modal-body">
				<!-- First Row -->
				<div class="row">
					<div class="col-md-3">
						<span class="txt">BI Date:</span>
						<input type="text" class="form-control sj_date">
					</div>
					<div class="col-md-3">
						<span class="txt">BI #:</span>
						<input type="text" class="form-control sj_num">
					</div>
					<div class="col-md-4">
						<span class="txt">Customer:</span>
						<input type="text" class="form-control sj_cust">
					</div>
					<div class="col-md-2">
						<span class="txt">Terms:</span>
						<input type="text" class="form-control sj_terms">
					</div>
				</div>
				<!-- Second Row -->
				<div class="row">
					<div class="col-md-3">
						<span class="txt">BI Amount:</span>
						<input type="text" class="form-control sj_amt">
					</div>
					<div class="col-md-9">
						<span class="txt">Particulars</span>
						<input type="text" class="form-control sj_part">
					</div>
				</div>
				<!-- fourth Row: Adding Accounts -->
				<div class="row">
					<div class="col-md-12">
						<div class="table" >
							<table class="table" id="sj_edit_table">
								<thead>
									<tr>
										<th>Account Code</th>
										<th>Title</th>
										<th>Debit (DR)</th>
										<th>Credit (CR)</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<tr>
										<td>TOTAL</td><td ></td>
										<td><input type="text" class="form-control entry-debit-total totdr" readonly="true" value=""></td>
										<td><input type="text" class="form-control entry-credit-total totcr" readonly="true" value=""></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-style-1"><i class="fa fa-save"></i> Update Transaction</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!-- GJ Edit Trasaction Modal-->
<div class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" id="gj_edit_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<h4 class="modal-title" id="">Edit Transaction</h4>
			</div>
			<div class="modal-body">
				<!-- First Row -->
				<div class="row">
					<div class="row">
						<div class="col-md-2">
							<span class="txt">Journal #:</span>
							<input type="text" class="form-control gj_num ">
						</div>
						<div class="col-md-2">
							<span class="txt">Date</span>
							<input type="text" class="form-control gj_date">
						</div>
						<div class="col-md-3">
							<span class="txt">Journal Amount:</span>
							<input type="text" class="form-control gj_amt">
						</div>
						<div class="col-md-5">
							<span class="txt">Particulars</span>
							<input type="text" class="form-control gj_part">
						</div>
					</div>
				</div>
				<!-- fourth Row: Adding Accounts -->
				<div class="row">
					<div class="col-md-12">
						<div class="table" >
							<table class="table" id="gj_edit_table">
								<thead>
									<tr>
										<th>Account Code</th>
										<th>Title</th>
										<th>Debit (DR)</th>
										<th>Credit (CR)</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
								<tfoot>
									<tr>
										<td>TOTAL</td><td ></td>
										<td><input type="text" class="form-control entry-debit-total totdr" readonly="true" value=""></td>
										<td><input type="text" class="form-control entry-credit-total totcr" readonly="true" value=""></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-style-1"><i class="fa fa-save"></i> Update Transaction</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>