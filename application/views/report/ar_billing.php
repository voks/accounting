	<div class='jumbotron'>
		<span>BILLING INVOICE</span>
	</div>
</div>
<div class="content text-tbody">
	<div class="container">
		<div class="div-wrap2">
			<div class="">
				<span class="txt padding-left-10 text-bold">Billed to:
				</span>
				<span class="txt">
					<?php
					$sj_name = $sj_entries->row();
					echo $sj_name->sj_master_name;
					?>
				</span>
			</div>
			<div class="">
				<span class="txt padding-left-10 text-bold">TIN:
				</span>
				<span class="txt">
					____________________________________________
				</span>
			</div>
			<div class="">
				<span class="txt padding-left-10 text-bold">Address:</span>
				<span class="txt">
					________________________________________
				</span>
			</div>
			<div class="">
				<span class="txt padding-left-10 text-bold">Business Style:</span>
				<span class="txt">
					___________________________________
				</span>
			</div>
		</div>
		<div class="div-wrap2">
			<div class="">
				<span class="txt padding-left-10 text-bold">Date:
				</span>
				<span class="txt">
					<?php
					$sj_date = $sj_entries->row();
					echo $sj_date->sj_si_date;
					?>
				</span>
			</div>
			<div class="">
				<span class="txt padding-left-10 text-bold">Terms: 
				</span>
				<span class="txt">
					<?php
					$sj_terms = $sj_entries->row();
					echo $sj_terms->sj_terms;
					?>
				</span>
			</div>
			<div class="">
				<span class="txt padding-left-10 text-bold">PO #: </span>
				<span class="txt">
					<?php
					$sj_no = $sj_entries->row();
					echo $sj_no->sj_si_no;
					?>
				</span>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<table class='table text-tbody table-bordered'>
			<thead>
				<tr >
					<th class='text-left text-center'>Qty</th>
					<th class='text-left text-center'>Unit</th>
					<th class='one-half text-left text-center'>Articles</th>
					<th class='one-fourth text-left text-center'>Unit Price</th>
					<th class='one-fourth text-left text-center'>Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($sj_entries->result() as $key) {
						echo "
						<tr>
							<td></td>
							<td></td>
							<td>".$key->sj_particulars."</td>
							<td></td>
							<td class='text-right'>".number_format($key->sj_si_amount,2)."</td>
						</tr>
						";
					}
				?>
				<?php
				foreach($sj_entries->result() as $key){
					echo "
					<tr>
					<th colspan='4' class='one-fourth text-left text-center'>TOTAL INVOICE AMOUNT</th>
						<th class='one-fourth text-left text-right'>".number_format($key->sj_si_amount,2)."</th>
					</tr>";
				}
				?>
			</tbody>
		</table>
	</div>
	<div class="container">
		<div class="div-wrap-cd-footer">
			<div class="col-md-6">
				<span class="txt text-bold">Terms &amp; Condition</span>
				<span class="txt">
					<ol>
						<li>All checks should be made payable to Excellent Performance Services Inc.</li>
						<li>Overdue accounts shall be charged an interest of 5% a month from due date until it is fully paid.</li>
					</ol>
				</span>
			</div>
		</div>
		<div class="div-wrap2-cd-footer">
			<div class="container">
				<div class="div-wrap2-footer">
					<div class="col-md-6">
						<span class="txt">Prepared by:</span>
					</div>
					<div class="col-md-6">
						<span class="txt">________________</span>
					</div>
				</div>
				<div class="div-wrap2-footer">
					<div class="col-md-6">
						<span class="txt">Checked by:</span>
					</div>
					<div class="col-md-6">
						<span class="txt">________________</span>
					</div>
				</div>
				<div class="div-wrap2-footer">
					<div class="col-md-6">
						<span class="txt">Approved by:</span>
					</div>
					<div class="col-md-6">
						<span class="txt">________________</span>
					</div>
				</div>
			</div>
			<div class="bordered">
				<span class="txt text-bold padding-left-10 padding-right-10">Received the above articles in good order and condition</span>
				<span class="txt padding-left-10">
					By: ___________________________  &nbsp;&nbsp;&nbsp; _____________
				</span>
				<span class="txt padding-left-10">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;
					Signature over printed name  
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;
					Date
				</span>
			</div>
		</div>
	</div>
</div>
