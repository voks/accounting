
<div class="jumbotron">
	<span>ATTACHEMENT OF FINANCIAL STATEMENT</span>
</div>
</div>
<div class="content row">
	<table class="table text-tbody">

		<tbody>
			<tr >
				<td class="tbl-wide-size text-left text-bold">CASH ON HAND and IN BANK</td>
				<td class="tbl-small-size text-right"></td>
				<td class="tbl-small-size text-right"></td>
			</tr>
			<?php
			foreach ($fs_bank->result() as $key) {
				echo "
				<tr >
					<td class='tbl-wide-size text-left padding-left-20'>".$key->account_code." - ".$key->sub_code." - ".$key->account_name."</td>
					<td class='tbl-small-size text-right'></td>
					<td class='tbl-small-size text-right'>".number_format($key->trans_cr,2)."</td>
				</tr>
				";
			}
			?>
			<?php
			foreach ($fs_bank_tot->result() as $key) {
				echo "
				<tr >
					<td class='tbl-wide-size text-left text-bold table-td-outline-bottom'>TOTAL CASH IN BANK</td>
					<td class='tbl-small-size text-right table-td-outline-bottom'></td>
					<td class='tbl-small-size text-right table-td-outline-bottom'>".number_format($key->subtotal,2)."</td>
				</tr>
				";
			}
			?>
			<tr >
				<td class="tbl-wide-size text-left text-bold">ACCOUNTS RECEIVABLE TRADES AND OTHER</td>
				<td class="tbl-small-size text-right"></td>
				<td class="tbl-small-size text-right"></td>
			</tr>
			<?php
			foreach ($fs_ar->result() as $key) {
				echo "
				<tr >
					<td class='tbl-wide-size text-left padding-left-20'>".$key->account_code." - ".$key->sub_code." - ".$key->account_name."</td>
					<td class='tbl-small-size text-right'></td>
					<td class='tbl-small-size text-right'>".number_format($key->trans_cr,2)."</td>
				</tr>
				";
			}
			?>
			<?php
			foreach ($fs_ar_tot->result() as $key) {
				echo "
				<tr >
					<td class='tbl-wide-size text-left text-bold table-td-outline-bottom'>TOTAL RECEIVABLES</td>
					<td class='tbl-small-size text-right table-td-outline-bottom'></td>
					<td class='tbl-small-size text-right table-td-outline-bottom'>".number_format($key->subtotal,2)."</td>
				</tr>
				";
			}
			?>
			
			<tr >
				<td class="tbl-wide-size text-left text-bold">ACCOUNTS PAYABLE TTRADES AND OTHERS</td>
				<td class="tbl-small-size text-right"></td>
				<td class="tbl-small-size text-right"></td>
			</tr>
			<?php
			foreach ($fs_ap->result() as $key) {
				echo "
				<tr >
					<td class='tbl-wide-size text-left padding-left-20'>".$key->account_code." - ".$key->sub_code." - ".$key->account_name."</td>
					<td class='tbl-small-size text-right'></td>
					<td class='tbl-small-size text-right'>".number_format($key->trans_cr,2)."</td>
				</tr>
				";
			}
			?>
			<?php
			foreach ($fs_ap_tot->result() as $key) {
				echo "
				<tr >
					<td class='tbl-wide-size text-left text-bold table-td-outline-bottom'>TOTAL RECEIVABLES</td>
					<td class='tbl-small-size text-right table-td-outline-bottom'></td>
					<td class='tbl-small-size text-right table-td-outline-bottom'>".number_format($key->subtotal,2)."</td>
				</tr>
				";
			}
			?>
		</tbody>
	</table>
</div>