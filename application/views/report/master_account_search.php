	<div class='jumbotron'>
		<span>Accounts Record</span>
	</div>
</div>
<div class='content row'>
	<table class='table text-tbody table-bordered'>
		<thead>
			<tr >
				<th class='one-half text-center'>Name</th>
				<th class='one-half text-center'>Address</th>
				<th class='one-fourth text-center'>Contact Person</th>
				<th class='one-sixth text-center'>Contact Number</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($master_account as $key){
				echo "<tr>";
				echo "	<td class='one-half text-left'>".$key->master_name."</td>";
				echo "	<td class='one-half text-left'>".$key->master_add."</td>";
				echo "	<td class='one-fourth text-left'>".$key->master_contact_person."</td>";
				echo "	<td class='one-sixth text-left'>".$key->master_tel_no."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>