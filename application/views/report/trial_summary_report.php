	<div class='jumbotron'>
		<span>Trial Balance Summary Report</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class=''>Account Code</th>
				<th class=''>Account Name</th>
				<th class=''>Debit</th>
				<th class=''>Credit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($trial_balance as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'>".$key->account_code." - ".$key->sub_code."</td>";
				echo "	<td class='padding-left-10'>".$key->account_name."</td>";
				echo "	<td class='padding-left-10'>".$key->trans_dr."</td>";
				echo "	<td class='padding-right-5 text-right'>".$key->trans_cr."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>