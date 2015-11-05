	<div class='jumbotron'>
		<span>Accounts Payable Summary Report</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class=''>Invoice #</th>
				<th class=''>Invoice Date</th>
				<th class=''>Supplier's Name</th>
				<th class=''>Particulars</th>
				<th class=''>Invoice Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($accounts as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'>".$key->ap_invoice_no."</td>";
				echo "	<td class='padding-left-10'>".$key->ap_invoice_date."</td>";
				echo "	<td class='padding-left-10'>".$key->ap_master_name."</td>";
				echo "	<td class='padding-left-10'>".$key->ap_particulars."</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->ap_invoice_amount,2)."</td>";
				echo "</tr>";
			}
			foreach($accounts_total as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'></td>";
				echo "	<td class='padding-left-10'></td>";
				echo "	<td class='padding-left-10'></td>";
				echo "	<td class='padding-right-10 text-right text-bold'>TOTAL</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->tot_amt,2)."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>