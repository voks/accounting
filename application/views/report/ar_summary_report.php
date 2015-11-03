	<div class='jumbotron'>
		<span>Accounts Receivable Summary Report</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class=''>Account Code</th>
				<th class=''>Account Name</th>
				<th class=''>Particulars</th>
				<th class=''>Debit</th>
				<th class=''>Credit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($ar as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'>".$key->sj_si_no."</td>";
				echo "	<td class='padding-left-10'>".$key->sj_si_date."</td>";
				echo "	<td class='padding-left-10'>".$key->sj_particulars."</td>";
				echo "	<td class='padding-left-10 text-right'>".number_format($key->total_debit,2)."</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->total_credit,2)."</td>";
				echo "</tr>";
			}
			foreach($ar_tot as $key){
				echo "<tr>";
				echo "	<td class='padding-left-10'></td>";
				echo "	<td class='padding-left-10'></td>";
				echo "	<td class='padding-left-10'></td>";
				echo "	<td class='padding-left-10 text-right'>".number_format($key->tot_debit,2)."</td>";
				echo "	<td class='padding-right-5 text-right'>".number_format($key->tot_credit,2)."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>