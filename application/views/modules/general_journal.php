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
										<a href="#" class="btn-style-1 pull-right"><i class="fa fa-refresh"></i> Reset</a>
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
<form class="gj-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title scrollhere"> » General Journal</span>
			<hr/>
		</div>
	</div>
	<!-- Alerts -->
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-success alert-dismissible fade in  gj-alert-success" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Success!</strong> Added New General Journal Record.
			</div>

			<div class="alert alert-warning alert-dismissible fade in  gj-alert-warning" role="alert">
				<button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Warning!</strong> General Journal already exist.
			</div>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="row">
			<div class="col-md-2">
				<span class="txt">Journal #:</span>
				<!-- Auto generate journal num  -->
				<input type="text" class="form-control main_txtbox" id="gj_code" name="gj[gj_code]">
			</div>
			<div class="col-md-2">
				<span class="txt">Date</span>
				<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker main_txtbox" id="gj_date" name="gj[gj_date]">
			</div>
			<div class="col-md-3">
				<span class="txt">Journal Amount:</span>
				<input type="text" class="form-control main_txtbox amount" id="gj_amount" name="gj[gj_amount]">
			</div>
			<div class="col-md-5">
				<span class="txt">Particulars</span>
				<input type="text" class="form-control main_txtbox" id="gj_particulars" name="gj[gj_particulars]">
			</div>
		</div>
	</div>
	<!-- Third: Adding Accounts -->
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
							<td><input type="text" class="form-control amount main_txtbox entry-debit-total" readonly="true" id="total_debit" name="gj[total_debit]"></td>
							<td><input type="text" class="form-control amount main_txtbox entry-credit-total"  readonly="true" id="total_credit" name="gj[total_credit]"></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<!-- Button -->
	<div class="row">
		<div class="col-md-12">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35 pull-right scroll"><i class="fa fa-save"></i> Save Transaction</button>
		</div>
	</div>
</form>

<form class="searchGJ-form">
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
				<strong>Warning!</strong> General Journal is not existing.
			</div>
		</div>
	</div>
	<!-- Search Fields -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Journal #:</span>
			<input type="text" class="form-control" id="searchGJ_code" name="searchGJ[searchGJ_code]">
		</div>
		<div class="col-md-3">
			<span class="txt">From:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker" id="searchGJ_date_frm" name="searchGJ[searchGJ_date_frm]">
		</div>
		<div class="col-md-3">
			<span class="txt">To:</span>
			<input type="text" placeholder="mm/dd/yyy" class="form-control datepicker" id="searchGJ_date_to" name="searchGJ[searchGJ_date_to]">
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-style-1 animate-4 margin-top-35"><i class="fa fa-search"></i> Search</button>
		</div>
	</div>
	<!-- Searchec Result Table List -->
	<div class="row">
		<div class="col-md-12">
			<table class="table margin-top-30">
				<thead>
					<tr>
						<th class="col-md-2">Journal #</th>
						<th class="col-md-2">Date</th>
						<th class="col-md-3">Particulars</th>
						<th class="col-md-2">Journal Amount</th>
						<th class="col-md-2 text-center" colspan="2">Action</th>
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
		<div class="col-md-11">
			<a href="#" class="btn-style-1 gj-print-list-result animate-4 pull-left"><i class="fa fa-print"></i> Print Result List</a>
		</div>
	</div>	
</form>

<!-- Page content end