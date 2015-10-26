<form class="gj-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title">General Journal</span>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="row">
			<div class="col-md-3">
				<span class="txt">Journal #:</span>
				<input type="text" readonly="true" class="form-control"  value="<?=$transdata[0]->gj_code?>">
			</div>
			<div class="col-md-3">
				<span class="txt">Date</span>
				<input type="text" readonly="true" class="form-control"  value="<?=$transdata[0]->gj_date?>">
			</div>
			<div class="col-md-3">
				<span class="txt">Cleared?:</span>
				<input type="text" class="form-control"  value="<?=$transdata[0]->gj_cleared?>">
			</div>
			<div class="col-md-3">
				<span class="txt">Cleared Date:</span>
				<input type="text" class="form-control datepicker"  value="<?=$transdata[0]->gj_cleared_date?>">
			</div>
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">Journal Amount:</span>
			<input type="text" readonly="true" class="form-control"  value="<?=number_format($transdata[0]->gj_amount,2)?>">
		</div>
		<div class="col-md-9">
			<span class="txt">Particulars</span>
			<input type="text" readonly="true" class="form-control"  value="<?=$transdata[0]->gj_particulars?>">
		</div>
	</div>
	<!-- third row: Divider -->
	<div class="row">
		<div class="col-md-12">
			<hr>
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