<!-- Page content Start -->
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
				<form class="updateCD-form">
					<!-- First Row -->
					<div class="row">
						<div class="col-md-2">
							<input type="hidden" class="cd_id" name="u_cd[cd_id]" id="cd_id">
							<span class="txt">Date:</span>
							<input type="text" class="form-control cd_date" id="vdate" name="u_cd[vdate]">
						</div>
						<div class="col-md-2">
							<span class="txt">Voucher #:</span>
							<input type="text" class="form-control cd_vnum" id="vnum" name="u_cd[vnum]">
						</div>
						<div class="col-md-3">
							<span class="txt">Check#:</span>
							<input type="text" class="form-control cd_chcknum" id="chcknum" name="u_cd[chcknum]">
						</div>
						<div class="col-md-5">
							<span class="txt">Bank:</span>
							<input type="text" class="form-control cd_bank" id="master" name="u_cd[master]">
						</div>
					</div>
					<!-- Second Row -->
					<div class="row">
						<div class="col-md-4">
							<span class="txt">Payee Name:</span>
							<input type="text" class="form-control cd_name" id="payee" name="u_cd[payee]">
						</div>
						<div class="col-md-3">
							<span class="txt">Check Amount:</span>
							<input type="hidden" class="form-control noformat" id="chckamt" name="u_cd[chckamt]">
							<input type="text" class="form-control cd_chckamt amount">
						</div>
						<div class="col-md-5">
							<span class="txt">Particulars</span>
							<input type="text" class="form-control cd_part" id="part" name="u_cd[part]">
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
							<button class="btn btn-style-1"><i class="fa fa-save"></i> Update Transaction</button>
						</div>
					</div>
				</form>
			</div>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!--Alert modal for Downloading Report-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="alertmessage">
	<div class="modal-dialog modal-s">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-offset-1 col-md-9">
						<span class="txt">Report successfully downloaded.</span>
						<span class="txt">Location:<br/>C:\xampp\htdocs\accounting\Reports\Check_Dis\</span>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-style2 " data-dismiss="modal" aria-label="Close"> OK</button>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<form class="cd-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title scrollhere"> » Check Disbursement</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible fade in  cd-alert-success" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Success!</strong> Added New Check Disbursement Record.
			</div>

			<div class="alert alert-warning alert-dismissible fade in  cd-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Check Disbursement already exist.
			</div>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-2">
			<span class="txt">Date:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker empty_txtbx" id="cd_date" name="cd[cd_date]">
		</div>
		<div class="col-md-2">
			<span class="txt">Voucher #:</span>
			<input type="text" class="form-control empty_txtbx" readonly="true" id="cd_voucher_no" name="cd[cd_voucher_no]" value="<?=substr(date("Y"),2).'-'.(strlen($v_num[0]->v_num==4)) ? substr(date("Y"),2).'-'.substr_replace('0000',$v_num[0]->v_num,1):substr(date("Y"),2).'-'.substr_replace('0000',$v_num[0]->v_num,0)?>">
		</div>
		<div class="col-md-3">
			<span class="txt">Check#:</span>
			<input type="text" class="form-control empty_txtbx" id="cd_check_no" name="cd[cd_check_no]">
		</div>
		<div class="col-md-5">
			<span class="txt">Bank:</span>
			<select class="form-control empty_txtbx show-bank select2-dropdown" id="cd_master_name" name="cd[cd_master_name]">
				<option> -- Select Bank -- </option>
				<?php 
				foreach ($journal_cd as $data) {
					echo "<option data-code='".$data->sub_code."' data-sub='".$data->sub_name."'>".$data->sub_name."</option>";
				}
				?>
			</select>
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-4">
			<span class="txt">Payee Name:</span>
			<input type="text"class="form-control empty_txtbx" id="cd_payee_name" name="cd[cd_payee_name]">
		</div>
		<div class="col-md-3">
			<span class="txt">Check Amount:</span>
			<input type="text" class="form-control empty_txtbx amount" id="cd_check_amount" name="cd[cd_check_amount]">
		</div>
		<div class="col-md-5">
			<span class="txt">Particulars</span>
			<input type="text" class="form-control empty_txtbx" id="cd_particulars" name="cd[cd_particulars]">
		</div>
	</div>

	<!-- Adding Accounts -->
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
								<a href="#" class="btn-style-1 animate-4 margin-top-30 pull-right" id='alert' data-toggle='modal' data-target='.addTrans'><i class="fa fa-plus"></i> Add Account</a>
							</th>
						</tr>
						<tr> 
							<td></td><td></td>
							<td colspan="2">
								<span class=""><b>Note</b>: Please indicate zero (0) if amount is not avilable.</span>
							</td>
						</tr>
					</thead>
					<tbody class="entry-list">
						
					</tbody>
					<tfoot>
						<tr class="row_total">
							<td colspan="2">TOTAL</td>
							<td><input type="text" class="form-control amount entry-debit-total empty_txtbx" readonly="true" id="total_debit" name="cd[total_debit]"></td>
							<td><input type="text" class="form-control amount entry-credit-total empty_txtbx"  readonly="true" id="total_credit" name="cd[total_credit]"></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35 pull-right scroll"><i class="fa fa-save"></i> Save Transaction</button>
		</div>
	</div>
</form>

<form class="searchCD-form">
	<!-- SubTitle -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title"> » Accounts Record</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissible fade in  search-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> Check Disbursement is not existing.
			</div>
		</div>
	</div>
	<div class="row">
		<!-- <div class="col-md-4">
			<span class="txt">Payee Name:</span>
			<input type="text" class="form-control" id="searchCD_payee" name="searchCD[searchCD_payee]">
		</div> -->
		<div class="col-md-4">
			<span class="txt">Check#:</span>
			<input type="text" class="form-control" id="searchCD_checkNo" name="searchCD[searchCD_checkNo]">
		</div>
		<div class="col-md-3">
			<span class="txt">From:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker" id="searchCD_voucherDate_frm" name="searchCD[searchCD_voucherDate_frm]">
		</div>
		<div class="col-md-3">
			<span class="txt">To:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker" id="searchCD_voucherDate_to" name="searchCD[searchCD_voucherDate_to]">
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table fixed-table margin-top-30 table-condensed">
				<thead>
					<tr>
						<th class="col-md-2">Check #</th>
						<th class="col-md-2">Date</th>
						<th class="col-md-3">Bank</th>
						<th class="col-md-3">Particulars</th>
						<th class="col-md-2">Check Amount</th>
						<th class="col-md-3" colspan="3" class="text-center">Action</th>
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
	<div class="row margin-top-30">
		<div class="col-md-2">
			<a href="#" class="btn btn-style-1 cd-print-list-result animate-4 pull-left"><i class="fa fa-print"></i> Print PDF Report</a>
		</div>
	</div>
	<div class="row margin-top-5">
		<div class="col-md-3">
			<a id="btn_export" class="btn btn-style-1 animate-4"><i class="fa fa-download"></i> Detailed Report &nbsp;</a>
		</div>
	</div>
	<div class="row margin-top-5">
		<div class="col-md-2">
			<a id="btn_export_sum" class="btn btn-style-1 animate-4"><i class="fa fa-download"></i> Summary Report</a>
		</div>
	</div>
</form>

<!--Confirmation of Update Modal-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" id="update-success">
	<div class="modal-dialog modal-s">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-offset-1 col-md-9">
						<span class="txt"> <strong>Success!</strong> Check Disbursement details has been updated.</span>
					</div>
					<div class="col-md-2">
						<button class="btn btn-style2" id="btn_cd_ok" data-dismiss="modal" aria-label="Close"> OK</button>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>


<!-- Page content end