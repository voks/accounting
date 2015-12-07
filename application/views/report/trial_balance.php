
<div class="jumbotron">
	<span>TRIAL BALANCE</span>
</div>
</div>
<div class="content row">
	<table class="table">
		<thead>
			<tr class="text-12">
				<th class="tbl-wide-size text-left">Account</th>
				<th class="tbl-small-size text-right">Debit</th>
				<th class="tbl-small-size text-right">Credit</th>
				<th class="tbl-small-size text-right">YTD Debit</th>
				<th class="tbl-small-size text-right">YTD Credit</th>
			</tr>
		</thead>
		<tbody class="text-tbody text-12">
			<?php 
				$sumd=0;
				$sumc=0;
				foreach ($trial as $key) {
					echo  "	
					<tr>
						<td class='title''>".element('title',$key)."</td>
						<td class='text-right padding-right-5'>".number_format(element('debit',$key), 2)."</td>
						<td class='text-right padding-right-5'>".number_format(element('credit',$key), 2)."</td>
						<td class='text-right padding-right-5'>".number_format(10, 2)."</td>
						<td class='text-right padding-right-5'>".number_format(10, 2)."</td>
					</tr>
					";
					$sumd+=element('debit',$key);
					$sumc+=element('credit',$key);
				}
				echo  "
				<tr class='text-red'>
					<td class='text-bold'>TOTAL</td>
					<td class='text-right padding-right-5'>".number_format($sumd, 2)."</td>
					<td class='text-right padding-right-5'>".number_format($sumc, 2)."</td>
					<td class='text-right padding-right-5'>".number_format(1, 2)."</td>
					<td class='text-right padding-right-5'>".number_format(1, 2)."</td>
				</tr>";
			?>
		</tbody>
	</table>
</div>