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
				<th class=''>Customer's Name</th>
				<th class=''>Particulars</th>
				<th class=''>Bank's Name</th>
				<th class=''>OR Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($accounts as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'>".$key->cr_or_no."</td>";
				echo "	<td class='padding-left-10'>".$key->cr_or_date."</td>";
				echo "	<td class='padding-left-10'>".$key->cr_master_name_customer."</td>";
				echo "	<td class='padding-left-10'>".$key->cr_sj_si_no."</td>";
				echo "	<td class='padding-left-10'>".$key->cr_master_name_bank."</td>";
				echo "	<td class='padding-right-5 text-right'>".$key->cr_or_amount."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>