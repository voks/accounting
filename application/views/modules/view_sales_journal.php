<form class="view-sj-form">
	<!-- Title -->
	<div class="row">
		<div class="dv-header col-md-12">
			<span class="page-title">Sales Journal</span>
		</div>
	</div>
	<!-- First Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">SI Date:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->sj_si_date?>">
		</div>
		<div class="col-md-3">
			<span class="txt">SI #:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->sj_si_no?>">
		</div>
		<div class="col-md-3">
			<span class="txt">Customer:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->sj_master_name?>">
		</div>
		<div class="col-md-3">
			<span class="txt">Terms:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->sj_terms?>">
		</div>
	</div>
	<!-- Second Row -->
	<div class="row">
		<div class="col-md-3">
			<span class="txt">SI Amount:</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->sj_si_amount?>">
		</div>
		<div class="col-md-9">
			<span class="txt">Particulars</span>
			<input type="text" readonly="true" class="form-control" value="<?=$transdata[0]->sj_particulars?>">
		</div>
	</div>

	<!-- third row: Divider -->
	<div class="row">
		<div class="col-md-12">
			<hr>
		</div>
	</div>

	<!-- Third Row: Adding Accounts -->
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