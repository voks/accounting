
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
			foreach ($trial_report as $data) {
				echo "<tr>";
				echo "<td class='table-td-outline-right'>".$data->account_code."</td>";
				echo "<td class='table-td-outline-right'>".$data->account_title."</td>";
				echo "<td class='table-td-outline-right text-right'>000.00</td>";
				echo "<td class='table-td-outline-right text-right'>000.00</td>";
				echo "</tr>";
				// The data in this report should be get in the journals.
				// At the end of the table there should be a TOTAL of Debit and Credit
			}
			?>
			<tr class="text-red">
				<td class="text-bold table-td-outline-right">TOTAL</td>
				<td class="text-bold table-td-outline-right"></td>
				<td class="table-td-outline-right text-right">000.00</td>
				<td class="table-td-outline-right text-right">000.00</td>
			</tr>
		</tbody>
	</table>
</div>