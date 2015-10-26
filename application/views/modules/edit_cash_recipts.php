<form class="cr-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title">Cash Recipts</span>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-2">
			<span class="txt">OR #:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cr_or_no?>">
		</div>
		<div class="col-md-3">
			<span class="txt">OR Date:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cr_or_date?>">
		</div>
		<div class="col-md-4">
			<span class="txt">Customer:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cr_master_name_customer?>">
		</div>
		<div class="col-md-3">
			<span class="txt">SI #:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cr_sj_si_no?>">
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-5">
			<span class="txt">Bank:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cr_master_name_bank?>">
		</div>
		<div class="col-md-2">
			<span class="txt">Cleared?:</span>
			<input type="text" class="form-control" value="<?=$transdata[0]->cr_cleared?>">
		</div>
		<div class="col-md-2">
			<span class="txt">Date Cleared:</span>
			<input type="text" class="form-control datepicker" value="<?=$transdata[0]->cr_cleared_date?>">
		</div>
		<div class="col-md-3">
			<span class="txt">OR Amount:</span>
			<input type="text" readonly="true" class="form-control" value="<?=number_format($transdata[0]->cr_or_amount,2)?>">
		</div>
	</div>
	<!-- Third Row -->
	<div class="row">
		<div class="col-md-12">
			<span class="txt">Particulars:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cr_particulars?>">
		</div>
	</div>

	<!-- third row: Divider -->
	<div class="row">
		<div class="col-md-12">
			<hr>
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
						</tr>
					</thead>
					<tbody class="entry-list">
					<?php
						foreach ($transdata as $key) {
							echo "
							<tr>
								<td>".$key->account_code."</td>
								<td>".$key->account_name."</td>
								<td>
									<input type='text' readonly='true' class='form-control entry-debit'  value='".number_format($key->trans_dr,2)."'>
								</td>
								<td>
									<input type='text' readonly='true' class='form-control entry-credit'  value='".number_format($key->trans_cr,2)."'>
								</td>
							</tr>";
						}
					?>
					<tr class="row_total">
						<td ></td>
						<td >TOTAL</td>
						<td><input type="text" class="form-control entry-debit-total" readonly="true" value="<?=number_format($transdata[0]->total_debit,2)?>"></td>
						<td><input type="text" class="form-control entry-credit-total"  readonly="true" value="<?=number_format($transdata[0]->total_credit,2)?>"></td>
						<td></td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<a href='#' class='btn-style-1 animate-4 pull-right'><i class='fa fa-save'> Update Transaction</i></a>
		</div>
	</div>
</form>