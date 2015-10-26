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
				echo "	<td class='padding-left-10'>".$key->gj_code."</td>";
				echo "	<td class='padding-left-10'>".$key->gj_date."</td>";
				echo "	<td class='padding-left-10'>".$key->gj_particulars."</td>";
				echo "	<td class='padding-right-5 text-right'>".$key->gj_amount."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>