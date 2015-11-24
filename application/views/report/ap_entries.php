	<div class='jumbotron'>
		<span>Billing Invoice</span>
	</div>
</div>
<div class="content text-tbody">
	<div class="row">
		<div class="col-md-12 text-float-right">
			<span class="txt padding-left">
			</span>
		</div>
	</div>

	<div class="container">
		<div class="div-wrap2">
			<div class="col-md-6">
				<span class="txt padding-left-40">
				<?php
					$name = $ap_entries->row();
					echo $name->ap_master_name;
				?>
				</span>
			</div>
		</div>
		<div class="div-wrap2">
			<div class="col-md-6">
				<span class="txt padding-left-20">
				<?php
					$inv_no = $ap_entries->row();
					echo $inv_no->ap_invoice_date;
				?>
				</span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-20"> 
				<?php
					$po = $ap_entries->row();
					echo $po->ap_terms;
				?>
				</span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-20">
				<?php
					$po = $ap_entries->row();
					echo $po->ap_po_no;
				?>
				</span>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<table class='table text-tbody'>
			<tbody>
				<!-- Showing of entries -->
				<?php
				foreach($ap_entries->result() as $key){
					echo "<tr>";
					echo "	<td class='padding-left-10 one-fourth text-left '></td>";
					echo "	<td class='padding-left-10 one-half text-left '>".$key->account_name."</td>";
					echo "	<td class='padding-left-10 text-right padding-right-5'>".number_format($key->trans_dr,2)."</td>";
					echo "	<td class='padding-left-10 text-right padding-right-5'>".number_format($key->trans_cr,2)."</td>";
					echo "</tr>";
				}
				?>
				<!-- Showing of Particulars -->
				<?php
					$part = $ap_entries->row();
					echo "<tr>";
					echo "	<td class='padding-left-10'></td>";
					echo "	<td colspan='4' class='padding-left-10 text-left'>".$part->ap_particulars."</td>";
					echo "</tr>";
				?>

				<!-- Showing of TOTAL -->
				<?php
					$total = $ap_entries->row();
					echo "<tr>";
					echo "	<td class='text-bold text-left'></td>";
					echo "	<td class='text-right'></td>";
					echo "	<td class='text-bold text-right padding-right-5'>".number_format($total->total_debit,2)."</td>";
					echo "	<td class='text-bold text-right  padding-right-5'>".number_format($total->total_credit,2)."</td>";
					echo "</tr>";
				?>
			</tbody>
		</table>
	</div>
	
</div>
