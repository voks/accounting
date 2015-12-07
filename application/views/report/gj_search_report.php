	<div class='jumbotron'>
		<span>Accounts Record</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class=''>Journal #</th>
				<th class=''>Date</th>
				<th class=''>Particulars</th>
				<th class=''>Journal Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($accounts as $key){
				echo "<tr>";
				echo "	<td class='padding-left-5'>".$key->gj_code."</td>";
				echo "	<td class='padding-left-5'>".$key->gj_date."</td>";
				echo "	<td class='padding-left-5'>".$key->gj_particulars."</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->gj_amount, 2)."</td>";
				echo "</tr>";
			}

			foreach($accounts_total as $key){
				echo "<tr>";
				echo "	<td class='padding-left-5'></td>";
				echo "	<td class='padding-left-5'></td>";
				echo "	<td class='padding-right-5 text-right text-bold'>TOTAL</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->tot_amt, 2)."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>