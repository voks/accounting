
	<div class="jumbotron">
		<span>SCHEDULE OF ACCOUNTS PAYABLE - OTHERS</span>
		<p>AS OF MM/DD/YYYY</p>
	</div>
</div>
<div class="content row">
	<table class="table table-bordered text-tbody">
		<thead>
			<tr >
				<th class="one-half text-center">ACCOUNT TITLE</th>
				<th class="one-sixth text-center">BALANCE AS OF MM/DD/YYYY</th>
				<th class="one-sixth text-center">AMOUNT PAID AS OF THIS REPORT</th>
				<th class="one-sixth text-center">BALANCE AS OF THIS REPORT</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($ap_other->result() as $key) {
				echo "
					<tr>
						<td class='one-half text-left'>".$key->ap_master_name."</td>
						<td class='one-sixth text-right'>".number_format($key->ap_invoice_amount,2)."</td>
						<td class='one-sixth text-right'></td>
						<td class='one-sixth text-right'></td>
					</tr>
				";
			}
			?>
			<?php
			foreach ($ap_other_tot->result() as $key) {
				echo "
					<tr class='text-red'>
						<td class='one-half text-left text-bold'>TOTAL</td>
						<td class='one-sixth text-right'>".number_format($key->ap_invoice_amount,2)."</td>
						<td class='one-sixth text-right'></td>
						<td class='one-sixth text-right'></td>
					</tr>
				";
			}
			?>
			
		</tbody>
	</table>
</div>