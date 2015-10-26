	<div class='jumbotron'>
		<span>Bank Reconciliation Record</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody'>
		<thead>
			<tr >
				<th class='one-half text-left'>Bank Name</th>
				<th class='one-fourth text-left'>Month</th>
				<th class='one-fourth text-left'>Year</th>
				<th class='one-fourth text-left'>Balance</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($bank_recon_search as $key){
					echo "<tr >";
					echo "	<td class='one-half text-left'>".$key->bank_name."</td>";
					echo "	<td class='one-fourth text-left'>".$key->bank_month."</td>";
					echo "	<td class='one-fourth text-left'>".$key->bank_year."</td>";
					echo "	<td class='one-fourth text-left'>".$key->bank_balance."</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</div>