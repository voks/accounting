
<div class="jumbotron">
	<span>PROFIT AND LOSS</span>
</div>
</div>
<div class="content row">
	<table class="table text-tbody line-height-1">
		<thead>
			<tr>
				<th class="tbl-wide-size text-left"></th>
				<th class="tbl-small-size text-center">Year To Date mm/dd/yyyy</th>
				<th class="tbl-small-size text-center">Year To Date mm/dd/yyyy</th>
			</tr>
		</thead>
			<tr>
				<td class="text-bold">Sales Revenue</td>
				<td class="text-right">322,094,467.00</td>
				<td class="text-right">388,321,973.00</td>
			</tr>
			<tr>
				<td class="text-italic">Less</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td class="text-bold">Cost of Service</td>
				<td class="text-right"></td>
				<td class="text-right"></td>
			</tr>
			<tr>
				<td class="text-bold">Total Cost of Service</td>
				<td class="text-right text-underline">000,000,000.00</td>
				<td class="text-right text-underline">000,000,000.00</td>
			</tr>
			<tr>
				<td class="text-bold">Gross Profit on Sale</td>
				<td class="text-right text-underline">000,000,000.00</td>
				<td class="text-right text-underline">000,000,000.00</td>
			</tr>
			<tr>
				<td>Add: Other Income</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Other Income</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Gain on Sale of Computer Equipment</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Translation Gain or Loss</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Interest Income</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Miscellaneous Expenses</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Total Other Income</td>
				<td class="text-right text-underline">000,000,000.00</td>
				<td class="text-right text-underline">000,000,000.00</td>
			</tr>
			<tr>
				<td class="text-bold">Gross Profit</td>
				<td class="text-right text-underline">000,000,000.00</td>
				<td class="text-right text-underline">000,000,000.00</td>
			</tr>
			<tr>
				<td class="text-bold">Less Expenses</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td class="text-bold">Selling Expenses</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<?php 
				foreach ($income_statement as $data) {
					echo "<tr>";
					echo "<td class='padding-left-20'>".$data->account_title."</td>";
					echo "<td class='text-right'>000.00</td>";
					echo "<td class='text-right'>000.00</td>";
					echo "</tr>";
					// The data in this report should be get in the journals.
				}
			?>
			<tr>
				<td class="text-bold">Total Expenses</td>
				<td class="text-right text-underline">000,000,000.00</td>
				<td class="text-right text-underline">000,000,000.00</td>
			</tr>
			<tr>
				<td class="text-bold">Income from Operation</td>
				<td class="text-right text-underline">000,000,000.00</td>
				<td class="text-right text-underline">000,000,000.00</td>
			</tr>
			<tr>
				<td>Less: Other Expenses</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Loss from translation of foreign currency</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Interest Expenses</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Other Expenses</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Total Other Expenses</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr>
				<td>Less Tax</td>
				<td class="text-right">000,000,000.00</td>
				<td class="text-right">000,000,000.00</td>
			</tr>
			<tr class="text-red">
				<td class="text-bold">NET PROFIT</td>
				<td class="text-right text-underline">000,000,000.00</td>
				<td class="text-right text-underline">000,000,000.00</td>
			</tr>
		<tbody>
			
		</tbody>
	</table>
</div>