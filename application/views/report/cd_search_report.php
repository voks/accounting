	<div class='jumbotron'>
		<span>Check Disbursement Summary Report</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class=''>Voucher #</th>
				<th class=''>Date</th>
				<th class=''>Payee Name</th>
				<th class=''>Check #</th>
				<th class=''>Check Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($accounts as $key){
				echo "<tr>";
				echo "	<td class='padding-left-5'>".$key->cd_voucher_no."</td>";
				echo "	<td class='padding-left-5'>".$key->cd_date."</td>";
				echo "	<td class='padding-left-5'>".$key->cd_payee_name."</td>";
				echo "	<td class='padding-left-5'>".$key->cd_check_no."</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->cd_check_amount,2)."</td>";
				echo "</tr>";
			}

			foreach($accounts_total as $key){
				echo "<tr>";
				echo "	<td class='padding-left-5'></td>";
				echo "	<td class='padding-left-5'></td>";
				echo "	<td class='padding-left-5'></td>";
				echo "	<td class='padding-right-5 text-bold text-right'>TOTAL</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->tot_amt,2)."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>