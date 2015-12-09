<!-- Page content Start -->

<!--Add Transaction access Modal-->
<div class="modal fade addTrans"  role="dialog" aria-labelledby="" aria-hidden="true" id="addTrans">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="">Add Transaction</h4>
			</div>
			<div class="modal-body">
				<form class="search-chartaccount">
					<!-- Alerts -->
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-warning alert-dismissible fade in  chart-alert-warning" role="alert">
								<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
								<strong>Warning!</strong> Accounts is not existing.
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<span class="txt">Account Code</span>
							<input type="text" class="form-control entry-text" value="" name="chart[account_code]">
						</div>

						<div class="col-md-9">
							<span class="txt">Account Title</span>
							<select id="" class="form-control select2-dropdown entry-select" >
								<option value="">-- Select Account Title --</option>
								<?php
								foreach ($account_title->result() as $title) {
									echo "<option>".$title->account_code." - ".$title->account_title."</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<span class="txt">Subsidiary Code</span>
							<input type="text" id="" class="form-control sub-input-masked entry-subcode " name="chart[sub_code]" data-inputmask-clearmaskonlostfocus="false">
						</div>

						<div class="col-md-7">
							<span class="txt">Subsidiary Name</span>
							<select id="" class="form-control select2-dropdown entry-subname">
							</select>
						</div>

						<div class="col-md-2">
							<button class="btn btn-style-1 margin-top-30 pull-right"><i class='fa fa-search'></i> Search</button>
						</div>
					</div>
				</form>
				<!-- divider -->
				<div class="row">
					<div class="col-md-12">
						<span class="modal-subtitle"> » Searched Result</span>
						<hr/>
					</div>
				</div>
				<!-- Table List result -->
				<!-- System must be detect if there is no subsidiary. -->
				<!-- Alerts -->
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-warning alert-dismissible fade in  entries-alert-warning" role="alert">
							<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
							<strong>Warning!</strong> No Transaction Selected!
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 entry-data">
						<table class="table fixed-table table-condensed">
							<thead>
								<tr>
									<th class="col-md-1"></th>
									<th class="col-md-1">Account Code</th>
									<th class="col-md-3">Account Title</th>
									<th class="col-md-2">Subsidiary Code</th>
									<th class="col-md-2">Subsidiary Name</th>
									<th class="col-md-2">
										<button id="btn_reset" class="btn btn-style-1 pull-right reset"><i class="fa fa-refresh"></i> Reset</button>
									</th>
								</tr>
							</thead>
						</table>
						<div class="div-table-content">
							<table id="tb_show_entries" class="table fixed-table table-condensed chart-table">
								<tbody class="tran_data">
									<?php
									foreach ($all_accounts->result() as $key) {
										echo "
										<tr'>
										<td class='col-md-1'><label><input type='checkbox' class='' value='0' id='check' data-subcode='".$key->sub_code."' data-subname='".$key->sub_name."'><label></td>
										<td class='col-md-1'>".$key->account_code."</td>
										<td class='col-md-3'>".$key->account_title."</td>
										<td class='col-md-2'>".$key->sub_code."</td>
										<td class='col-md-4' colspan='2'>".$key->sub_name."</td>
									</tr>
									";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button class="btn btn-style-1 btn-add-trans" type="button" >Add Transaction</button>
			<button class="btn btn-style2 " data-dismiss="modal" aria-label="Close"> Cancel</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<!--Edit Trasaction Modal-->
<div class="modal fade"  role="dialog" aria-labelledby="" aria-hidden="true" id="editTrans">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header modal-header-bg">
				<h4 class="modal-title" id="">Edit Transaction</h4>
			</div>
			<div class="modal-body">
				<form class="updateAP-form">
					<!-- Alerts -->
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-warning alert-dismissible fade in  editAP-alert-warning" role="alert">
								<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
								<strong>Warning!</strong>Accounts Payable details can't be updated.
							</div>
						</div>
					</div>
					<!-- First Row -->
					<div class="row">
						<div class="col-md-3">
							<input type="hidden" class="ap_id" name="u_ap[ap_id]" id="ap_id">
							<span class="txt">Invoice Date:</span>
							<input type="text" class="form-control invdate" value="" id="invdate" name="u_ap[invdate]">
						</div>
						<div class="col-md-3">
							<span class="txt">Invoice #:</span>
							<input type="text" class="form-control invno" value="" id="invnum" name="u_ap[invnum]">
						</div>
						<div class="col-md-3">
							<span class="txt">PO #:</span>
							<input type="text" class="form-control pono" value="" id="pono" name="u_ap[pono]">
						</div>
						<div class="col-md-1">
							<span class="txt">Terms:</span>
							<input type="text" class="form-control terms" value="" id="terms" name="u_ap[terms]">
						</div>
						<div class="col-md-2">
							<span class="txt">Invoice Amount:</span>
							<input type="hidden" class="form-control noformat" id="invamt" name="u_ap[invamt]">
							<input type="text" class="form-control invamt">
						</div>
					</div>
					<!-- Second Row -->
					<div class="row">
						<div class="col-md-6">
							<span class="txt">Supplier:</span>
							<input type="text" readonly="true" class="form-control supp" id="master" name="u_ap[master]">
						</div>
						<div class="col-md-6">
							<span class="txt">Particulars:</span>
							<input type="text" class="form-control part" id="part" name="u_ap[part]">
						</div>
					</div>
					<!-- fourth Row: Adding Accounts -->
					<div class="row">
						<div class="col-md-12">
							<div class="table" >
								<table class="table" id="edit_table">
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
					<div class="row">
						<div class="modal-footer">
							<button id="btn_updateAP" class="btn btn-style-1"><i class="fa fa-save"></i> Update Transaction</button>
							<button class="btn btn-style2" data-dismiss="modal" aria-label="Close"> OK</button>
						</div>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<form class="ap-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title scrollhere"> » Accounts Payable</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible fade in  ap-alert-success" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Success!</strong> Added New Account Payable Record.
			</div>

			<div class="alert alert-warning alert-dismissible fade in  ap-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Account Payable already exist.
			</div>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-2">
			<span class="txt">Invoice Date:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker empty_txtbx" id="ap_invoice_date" name="ap[ap_invoice_date]">
		</div>
		<div class="col-md-3">
			<span class="txt">Invoice #:</span>
			<input type="text" class="form-control empty_txtbx" id="ap_ivoice_no" name="ap[ap_invoice_no]">
		</div>
		<div class="col-md-4">
			<span class="txt">PO #:</span>
			<input type="text" class="form-control empty_txtbx" id="ap_po_no" name="ap[ap_po_no]">
		</div>
		<div class="col-md-3">
			<span class="txt">Terms:</span>
			<select class="form-control empty_txtbx select2-dropdown" id="ap_terms" name="ap[ap_terms]">
				<option value="0">0</option>
				<option value="7">7</option>
				<option value="15">15</option>
				<option value="30">30</option>
				<option value="60">60</option>
				<option value="120">120</option>
			</select>
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-5">
			<span class="txt">Supplier:</span>
			<select class="form-control empty_txtbx show-supplier select2-dropdown" id="ap_master_name" name="ap[ap_master_name]">
				<option value="00000"> -- Select Supplier -- </option>
				<?php 
				foreach ($bank_recon as $data) {
					echo "<option class='empty_txtbx' data-master='".$data->master_name."' data-mcode='".$data->master_code."'>".$data->master_code." - ".$data->master_name."</option>";
				}
				?>
			</select>
		</div>
		<div class="col-md-4">
			<span class="txt">Expenses:</span>
			<select class="form-control empty_txtbx show-expenses select2-dropdown" id="ap_expenses">
				<option> -- Select Expense -- </option>
				<?php 
				foreach ($accounts_payable as $data) {
					echo "<option>".$data->account_code." - ".$data->account_title."</option>";
				}
				?>
			</select>
		</div>
		<div class="col-md-3">
			<span class="txt">Invoice Amount:</span>
			<input type="text" class="form-control empty_txtbx amount" id="ap_invoice_amount" name="ap[ap_invoice_amount]">
		</div>
	</div>
	<!-- Third Row -->
	<div class="row">
		<div class="col-md-12">
			<span class="txt">Particulars:</span>
			<input type="text" class="form-control empty_txtbx" id="ap_particulars" name="ap[ap_particulars]">
		</div>
	</div>
	<!-- fourth Row: Adding Accounts -->
	<div class="row">
		<div class="col-md-12">
			<div class="table">
				<table class="table" id="tb_entries">
					<thead>
						<tr>
							<th>Account Code</th>
							<th>Title</th>
							<th>Debit (DR)</th>
							<th>Credit (CR)</th>
							<th>
								<a href="#" class="btn-style-1 animate-4 margin-top-30 pull-right" id='alert' data-toggle='modal' data-target='.addTrans'><i class="fa fa-plus"> Add Account</i></a>
							</th>
						</tr>
						<tr>
							<th></th><th></th>
							<th colspan="2">
								<span class=""><b>Note</b>: Please indicate zero (0) if amount is not avilable.</span>
							</th>
						</tr>
					</thead>
					<tbody class="entry-list">

					</tbody>
					<tfoot>
						<tr class="row_total">
							<td colspan="2">TOTAL</td>
							<td><input type="text" class="form-control empty_txtbx amount entry-debit-total" readonly="true" name="ap[total_debit]"></td>
							<td><input type="text" class="form-control empty_txtbx amount entry-credit-total"  readonly="true" name="ap[total_credit]"></td>
							<td></td>
						</tr>
					</tfoot>	
				</table>
			</div>
		</div>
	</div>
	<!-- Add AP Button -->
	<div class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-30 pull-right scroll"><i class="fa fa-save"></i> Save Transaction</button>
		</div>
	</div>	
</form>

<form class="searchAP-form">
	<!-- SubTitle -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-subtitle"> » Accounts Record</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible fade in  search-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Accounts Payable is not existing.
			</div>
		</div>
	</div>
	<!-- Search Fields -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Invoice #:</span>
			<input type="text" class="form-control" id="searchAP_invNo" name="searchAP[searchAP_invNo]">
		</div>
		<div class="col-md-3">
			<span class="txt">From:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker" id="searchAP_date_frm" name="searchAP[searchAP_date_frm]">
		</div>
		<div class="col-md-3">
			<span class="txt">To:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker" id="searchAP_date_to" name="searchAP[searchAP_date_to]">
		</div>
		<!-- <div class="col-md-4">
			<span class="txt">Supplier's Name:</span>
			<select class="form-control select2-dropdown" id="searchAP_suppName" name="searchAP[searchAP_suppName]">
				<option value=""> -- Select Supplier -- </option>
				//<?php 
				//foreach ($bank_recon as $data) {
				//	echo "<option data-master='".$data->master_name."' data-mcode='".$data->master_code."'>".$data->master_code." - ".$data->master_name."</option>";
				//}
				//?>
			</select>
		</div> -->
		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>
	<!-- Searched result Table List -->
	<div class="row">
		<div class="col-md-12 entry-data">
			<table class="table fixed-table margin-top-30 table-condensed">
				<thead>
					<tr>
						<th class="col-md-2">Invoice #</th>
						<th class="col-md-2">Invoice Date</th>
						<th class="col-md-3">Supplier</th>
						<th class="col-md-3">Particulars</th>
						<th class="col-md-2">Invoice Amount</th>
						<th class="col-md-2" colspan="2" class="text-center">Action</th>
					</tr>
				</thead>
			</table>
			<div class="div-table-content">
				<table id="" class="table search-table fixed-table table-condensed">
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Print Button -->
	<div class="row margin-top-30">
		<div class="col-md-3">
			<a href="#" class="btn-style-1 animate-4 pull-left print-list-result"><i class="fa fa-print"></i> Print PDF Report</a>
		</div>
	</div>
	<div class="row margin-top-5">
		<div class="col-md-3">
			<a id="btn_ap_excel" class="btn btn-style-1 animate-4"><i class="fa fa-download"></i> Detailed Report &nbsp;</a>
		</div>
	</div>
</form>
<!--Alert modal for Downloading Report-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="alertmessage">
	<div class="modal-dialog modal-s">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-offset-1 col-md-9">
						<span class="txt">Report successfully downloaded.</span>
						<span class="txt">Location:<br/>C:\xampp\htdocs\accounting\Reports\Accounts_Payable\</span>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-style2 " data-dismiss="modal" aria-label="Close"> OK</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!--Confirmation of Update Modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="update-success">
	<div class="modal-dialog modal-s">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-offset-1 col-md-9">
						<span class="txt"> <strong>Success!</strong> Accounts Payable details has been updated.</span>
					</div>
					<div class="col-md-2">
						<button class="btn btn-style2" id="btn_ok" data-dismiss="modal" aria-label="Close"> OK</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<!-- Page content end