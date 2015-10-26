
<div class="jumbotron">
	<span>SCHEDULE OF OPERATING EXPENSES</span>
	<p>As of mm/dd/yyyy</p>
</div>
</div>
<div class="content row">
	<table class="table table-outline table-header-bordered text-tbody">
		<thead>
			<tr >
				<th class="tbl-wide-size text-center">Account Name</th>
				<th class="tbl-small-size text-center">Amount</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($expense->result() as $key) {
				echo "
				<tr >
					<td class='tbl-small-size text-left'>".$key->account_code." - ".$key->account_name."</td>
					<td class='tbl-small-size text-right table-td-outline-left'>".$key->trans_cr."</td>
				</tr>
				";
			}
			?>
			<tr >
				<td class="tbl-wide-size text-left text-bold table-td-outline-top">SUBTOTAL</td>
				<td class="tbl-small-size text-right text-red text-right table-td-outline-left table-td-outline-top">36,059.53</td>
			</tr>
		</tbody>
	</table>
</div>