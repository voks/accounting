	<div class='jumbotron'>
		<span>Check Disbursement</span>
	</div>
</div>
<div class="content text-tbody">
	<div class="row">
		<div class="col-md-6 text-float-right" style="margin-top:20px;">
			<span class="txt padding-left">Voucher No.: 
				<?php
				$voucher = $cd_entries->row();
				echo $voucher->cd_voucher_no;
				?>
			</span>
		</div>
	</div>

	<div class="container">
		<div class="div-bordered div-wrap">
			<div class="col-md-6">
				<span class="txt padding-left-20"><b>PAYEE NAME:</b></span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-40">
					<?php
					$name = $cd_entries->row();
					echo $name->cd_payee_name;
					?>
				</span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-40">
					
				</span>
			</div>
		</div>
		<div class="div-bordered div-wrap">
			<div class="col-md-6">
				<span class="txt padding-left-20"><b>Date:</b>
					<?php
					$date = $cd_entries->row();
					echo $date->cd_date;
					?>
				</span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-20"><b>Bank Name:</b> 
					<?php
					$bank = $cd_entries->row();
					echo $bank->cd_master_name;
					?>
				</span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-20"><b>Check No.:</b> 
					<?php
					$check = $cd_entries->row();
					echo $check->cd_check_no;
					?>
				</span>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<table class='table text-tbody table-header-bordered'>
			<thead>
				<tr >
					<th class='one-fourth text-left text-center'>Account Code</th>
					<th class='one-half text-left text-center'>Account Name</th>
					<th class='text-left text-center'>Debit (DR)</th>
					<th class='text-left text-center'>Credit (CR)</th>
				</tr>
				<tr>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
			</thead>
			<tbody>
				<!-- Showing of entries -->
				<?php
				foreach($cd_entries->result() as $key){
					echo "<tr>";
					echo "	<td class='padding-left-10 one-fourth text-left table-td-outline-left '>".$key->account_code." - ".$key->sub_code."</td>";
					echo "	<td class='padding-left-10 one-half text-left table-td-outline-left '>".$key->account_name."</td>";
					echo "	<td class='padding-left-10 table-td-outline-left text-right padding-right-5'>".number_format($key->trans_dr,2)."</td>";
					echo "	<td class='padding-left-10 table-td-outline-left text-right table-td-outline-right padding-right-5'>".number_format($key->trans_cr,2)."</td>";
					echo "</tr>";
				}
				?>
				<tr>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
					<td class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>

				<tr>
					<td class="table-td-outline-left table-td-outline-top margin-top-45">&nbsp;</td>
					<td class="margin-top-45 table-td-outline-top">&nbsp;</td>
					<td class="margin-top-45 table-td-outline-top">&nbsp;</td>
					<td class="table-td-outline-right table-td-outline-top margin-top-45">&nbsp;</td>
				</tr>

				<?php
				$total = $cd_entries->row();
				echo "<tr>";
				echo "	<td class='text-bold table-td-outline-left text-left'></td>";
				echo "	<td class='text-right'></td>";
				echo "	<td class='text-bold table-td-outline-bottom text-right padding-right-5'>".number_format($total->total_debit,2)."</td>";
				echo "	<td class='text-bold table-td-outline-bottom text-right  padding-right-5 table-td-outline-right'>".number_format($total->total_credit,2)."</td>";
				echo "</tr>";
				?>
				
				<tr>
					<td class='table-td-outline-left text-left'></td>
					<td class='text-right'></td>
					<td class='text-bold table-td-outline-bottom table-td-outline-top text-right padding-right-5'></td>
					<td class='text-bold table-td-outline-bottom table-td-outline-top text-right  padding-right-5 table-td-outline-right'></td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<!-- Showing of Particulars -->
				<?php
				$part = $cd_entries->row();
				echo "<tr>";
				echo "	<td colspan='4' class='padding-left-20 table-td-outline-left table-td-outline-right text-left'><b><i>Particulars</i></b> : ".$part->cd_particulars."</td>";
				echo "</tr>";
				?>

				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" class="table-td-outline-bottom table-td-outline-left table-td-outline-right margin-top-45">&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="container">
		<div class="div-bordered div-wrap-cd-footer">
			<div class="col-md-6">
				<span class="txt">Prepared by:</span>
			</div>
			<div class="col-md-6">
				<span class="txt">____________________________________________________</span>
			</div>

			<div class="col-md-6">
				<span class="txt">Checked by:</span>
			</div>
			<div class="col-md-6">
				<span class="txt">____________________________________________________</span>
			</div>
			<div class="col-md-6">
				<span class="txt">Approved by:</span>
			</div>
			<div class="col-md-6">
				<span class="txt">____________________________________________________</span>
			</div>
		</div>
		<div class="div-bordered div-wrap-cd-footer">
			<div class="col-md-6">
				<span class="txt">Received from Excellent Performance Services, Inc</span>
			</div>
			<div class="col-md-6">
				<span class="txt">Name</span>
			</div>
			<div class="col-md-6">
				<span class="txt">____________________________________________________</span>
			</div>

			<div class="col-md-6">
				<span class="txt">Signature</span>
			</div>
			<div class="col-md-6">
				<span class="txt">____________________________________________________</span>
			</div>

			<div class="col-md-6">
				<span class="txt">Date:</span>
				<span class="txt">_______________________________________________</span>
			</div>
		</div>
	</div>
</div>
