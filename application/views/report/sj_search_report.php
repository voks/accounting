	<div class='jumbotron'>
		<span>Accounts Record</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class=''>Voucher #</th>
				<th class=''>Date</th>
				<th class=''>Payee Name</th>
				<th class=''>Particulars</th>
				<th class=''>Check Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($accounts as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'>".$key->sj_si_no."</td>";
				echo "	<td class='padding-left-10'>".$key->sj_si_date."</td>";
				echo "	<td class='padding-left-10'>".$key->sj_master_name."</td>";
				echo "	<td class='padding-left-10'>".$key->sj_particulars."</td>";
				echo "	<td class='padding-right-5 text-right'>".$key->sj_si_amount."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>