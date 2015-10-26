<form class="cd-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title">Check Disbursement</span>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Date:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_date?>">
		</div>
		<div class="col-md-4">
			<span class="txt">Voucher #:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_voucher_no?>">
		</div>
		<div class="col-md-5">
			<span class="txt">Payee Name:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_payee_name?>">
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Check#:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_check_no?>">
		</div>
		<div class="col-md-4">
			<span class="txt">Bank:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_master_name?>">
		</div>
		<div class="col-md-2">
			<span class="txt">Released?:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_released?>">
		</div>
		<div class="col-md-3">
			<span class="txt">Released Date:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_released_date?>">
		</div>
	</div>
	<!-- Third Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Cleared?:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_cleared?>">
		</div>
		<div class="col-md-4">
			<span class="txt">Cleared Date:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_cleared_date?>">
		</div>
		<div class="col-md-5">
			<span class="txt">Check Amount:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_check_amount?>">
		</div>
	</div>
	<!-- Fourth Row -->
	<div class="row">
		<div class="col-md-12">
			<span class="txt">Particulars</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->cd_particulars?>">
		</div>
	</div>

	<!-- third row: Divider -->
	<div class="row">
		<div class="col-md-12">
			<hr>
		</div>
	</div>
	
	<!-- fifth Row: Adding Accounts -->
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
									<input type='text' readonly='true' class='form-control entry-debit'  value='".$key->trans_dr."'>
								</td>
								<td>
									<input type='text' readonly='true' class='form-control entry-credit'  value='".$key->trans_cr."'>
								</td>
							</tr>";
						}
						?>
						<tr class="row_total">
							<td></td>
							<td>TOTAL</td>
							<td><input type="text" class="form-control entry-debit-total" readonly="true" value="<?=$transdata[0]->total_debit?>"></td>
							<td><input type="text" class="form-control entry-credit-total"  readonly="true" value="<?=$transdata[0]->total_credit?>"></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href='#' class='btn-style-1 animate-4 pull-left account-report-print'><i class='fa fa-print'> Print </i></a>
		</div>
	</div>
</form>