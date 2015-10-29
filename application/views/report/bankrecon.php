	<div class='jumbotron'>
		<span>Bank Reconciliation Record</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr>
				<th class='one-half padding-left-10 text-left'>Bank Name</th>
				<th class='one-fourth padding-left-10 text-left'>Month</th>
				<th class='one-fourth padding-left-10 text-left'>Year</th>
				<th class='one-half padding-left-10 text-left'>Balance</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($bank_data as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'>".$key->bank_name."</td>";
				echo "	<td class='padding-left-10'>".$key->bank_month."</td>";
				echo "	<td class='padding-left-10'>".$key->bank_year."</td>";
				echo "	<td class='padding-left-10'>".$key->bank_balance."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>