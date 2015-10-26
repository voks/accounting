
<div class='jumbotron'>
	<span>Subsidiary Record</span>
</div>
</div>

<div class='content row'>
	<table class='table text-10'>
		<thead>
			<tr >
				<th class='one-fourth text-left'>Account Type</th>
				<th class='one-fourth text-left'>Subsidiary Code</th>
				<th class='one-half text-left'>Subsidiary Name</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($account_type as $key){
				echo "
				<tr>
					<td class='one-fourth text-left'>".$key->account_type."</td>
					<td class='one-fourth text-left'>".$key->sub_code."</td>
					<td class='one-half text-left'>".$key->sub_name."</td>
				</tr>";
			}
			?>

		</tbody>
	</table>
</div>