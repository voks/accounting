	<div class='jumbotron'>
		<span>Transaction Record</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class=''>Date</th>
				<th class=''>Payee Name</th>
				<th class=''>Particulars</th>
				<th class=''>TRN No</th>
				<th class=''>Debit</th>
				<th class=''>Credit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($ledger as $key){
				echo "<tr>
				<tr>
					<td>".$key->date."</td>
					<td>".$key->mastername."</td>
					<td>".$key->particulars."</td>
					<td>".$key->transcode."</td>
					<td class='text-right'>".$key->dr."</td>
					<td class='text-right'>".$key->cr."</td>
				</tr>
				";
			}
			?>
		</tbody>
	</table>
</div>