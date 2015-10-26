	<div class='jumbotron'>
		<span>Subsidiary Accounts Record</span>
	</div>
</div>
<div class='content row'>
	<table class='table'>
		<thead>
			<tr >
				<th class='one-fourth text-left'>Account Type</th>
				<th class='one-fourth text-left'>Account Code</th>
				<th class='one-half text-left'>Account Name</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($sub_account_search as $key){
				echo "<tr>";
				echo "	<td class='one-fourth text-left'>".$key->account_type."</td>";
				echo "	<td class='one-fourth text-left'>".$key->sub_code."</td>";
				echo "	<td class='one-half text-left'>".$key->sub_name."</td>";
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
</div>