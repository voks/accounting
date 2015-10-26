	<div class='jumbotron'>
		<span>General Journal</span>
	</div>
</div>
<div class="content text-tbody">
	<div class="row">
		<div class="col-md-12 text-float-right">
			<span class="txt padding-left">JV #: 
				<?php
					$code = $gj_entries->row();
					echo $code->gj_code;
				?>
			</span>
		</div>
	</div>

	<div class="container">
		<div class="div-bordered div-wrap">
			<div class="col-md-6">
				<span class="txt padding-left-20">RECEIVED FROM:</span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-40">
				
				</span>
			</div>
		</div>
		<div class="div-bordered div-wrap">
			<div class="col-md-6">
				<span class="txt padding-left-20">Date:
				<?php
					$gj_date = $gj_entries->row();
					echo $gj_date->gj_date;
				?>
				</span>
			</div>
			<div class="col-md-6">
				<span class="txt padding-left-20">Reference #:
				
				</span>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<table class='table text-tbody table-header-bordered'>
			<thead>
				<tr >
					<th class='one-fourth text-left text-center'>Account Code</th>
					<th class='one-half text-left text-center'>Account Name</th>
					<th class='text-left text-center'>Debit (DR)</th>
					<th class='text-left text-center'>Credit (CR)</th>
				</tr>
			</thead>
			<tbody>
				<!-- Showing of entries -->
				<?php
				foreach($gj_entries->result() as $key){
					echo "<tr>";
					echo "	<td class='padding-left-10 one-fourth text-left table-td-outline-left '>".$key->account_code." - ".$key->sub_code."</td>";
					echo "	<td class='padding-left-10 one-half text-left table-td-outline-left '>".$key->account_name."</td>";
					echo "	<td class='padding-left-10 table-td-outline-left text-right padding-right-5'>".number_format($key->trans_dr,2)."</td>";
					echo "	<td class='padding-left-10 table-td-outline-left text-right table-td-outline-right padding-right-5'>".number_format($key->trans_cr,2)."</td>";
					echo "</tr>";
				}
				?>
				<!-- Showing of TOTAL -->
			
				<?php
					$total = $gj_entries->row();
					echo "<tr>";
					echo "	<td class='text-bold table-td-outline-bottom table-td-outline-top table-td-outline-left text-left'>TOTAL</td>";
					echo "	<td class='table-td-outline-bottom table-td-outline-top table-td-outline-left text-right'>.</td>";
					echo "	<td class='text-bold table-td-outline-bottom table-td-outline-top table-td-outline-left text-right padding-right-5'>".number_format($total->total_debit,2)."</td>";
					echo "	<td class='text-bold table-td-outline-bottom table-td-outline-top table-td-outline-left text-right  padding-right-5 table-td-outline-right'>".number_format($total->total_credit,2)."</td>";
					echo "</tr>";
				?>
				<!-- Showing of Particulars -->
				<?php
					$part = $gj_entries->row();
					echo "<tr>";
					echo "	<td colspan='4' class='table-td-outline-bottom table-td-outline-top table-td-outline-left table-td-outline-right text-left'><b><i>Particulars</i></b> : ".$part->gj_particulars."</td>";
					echo "</tr>";
				?>
			</tbody>
		</table>
	</div>
	<div class="container">
		<div class="div-bordered div-wrap-footer">
			<div class="col-md-6">
				<span class="txt">Prepared by:</span>
			</div>
			<div class="col-md-6">
				<span class="txt">______________________</span>
			</div>
		</div>
		<div class="div-bordered div-wrap-footer">
			<div class="col-md-6">
				<span class="txt">Checked\Approved by:</span>
			</div>
			<div class="col-md-6">
				<span class="txt">______________________</span>
			</div>
		</div>
		<div class="div-bordered div-wrap-footer">
			<div class="col-md-6">
				<span class="txt">Received by:</span>
			</div>
			<div class="col-md-6">
				<span class="txt">______________________</span>
			</div>
		</div>
		<div class="div-bordered div-wrap-footer">
			<div class="col-md-6">
				<span class="txt">POSTED BY:</span>
			</div>
			<div class="col-md-6">
				<span class="txt"><div id="circle"></div> GL &nbsp;&nbsp;&nbsp; <div id="circle"></div> SL</span>
			</div>
		</div>
	</div>
</div>
