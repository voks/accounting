
<div class="jumbotron">
	<span>TRIAL BALANCE</span>
</div>
</div>
<div class="content row">
	<table class="table table-outline table-header-bordered">
		<thead>
			<tr >
				<th class="tbl-small-size text-center">Account Code</th>
				<th class="tbl-wide-size text-center">Account Description</th>
				<th class="tbl-small-size text-center">Debit</th>
				<th class="tbl-small-size text-center">Credit</th>
			</tr>
		</thead>
		<tbody class="text-tbody">
			<?php 
				$sumd=0;
				$sumc=0;
				foreach ($trial as $key) {
					echo  "	
					<tr>
						<td class='table-td-outline-right' style='text-align:center'>".element('subcode',$key)."</td>
						<td class='table-td-outline-right' class='title' style='padding-left:10px'>".element('title',$key)."</td>
						<td class='table-td-outline-right text-right' style='text-align:center'>".element('debit',$key)."</td>
						<td class='table-td-outline-right text-right' style='text-align:center'>".element('credit',$key)."</td>
					</tr>
					";
					$sumd+=element('debit',$key);
					$sumc+=element('credit',$key);
				}
				echo  "
				<tr class='text-red'>
					<td class='text-bold table-td-outline-right' style='text-align:center'>TOTAL</td>
					<td class='text-bold table-td-outline-right'></td>
					<td class='table-td-outline-right text-right' style='text-align:center'>".$sumd."</td>
					<td class='table-td-outline-right text-right' style='text-align:center'>".$sumc."</td>
				</tr>";
			?>
		</tbody>
	</table>
</div>