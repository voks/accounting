
<div class="jumbotron">
	<span>BALANCE SHEET</span>
</div>
</div>
<div class="content row">
	<table class="table table-outline text-tbody">
		<thead>
			<tr>
				<th class="table-td-outline-bottom table-td-outline-top">Description</th>
				<th class="table-td-outline-bottom table-td-outline-top">Year to Date mm/dd/yyyy</th>
				<th class="table-td-outline-bottom table-td-outline-top">Year to Date mm/dd/yyyy</th>
			</tr>
			
		</thead>
		<tbody>
			<tr>
				<td class="text-bold text-italic ">CURRENT ASSETS</td>
				<td class=" text-right">&nbsp;</td>
				<td class=" text-right">&nbsp;</td>
			</tr>
				<?php 
					foreach ($bs_assets as $data) {
						echo "<tr>";
						echo 	"<td class=''>".$data->account_title."</td>";
						echo 	"<td class='text-right'>000.00</td>";
						echo 	"<td class='text-right'>000.00</td>";
						echo "</tr>";
						// The data in this report should be get in the journals.
					}
				?>
			<tr>
				<td class="text-bold text-italic  table-td-outline-bottom table-td-outline-top">TOTAL CURRENT ASSETS</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
			</tr>
			<tr>
				<td class="text-bold text-italic">NON-CURRENT ASSETS</td>
				<td class=" text-right">&nbsp;</td>
				<td class=" text-right">&nbsp;</td>
			</tr>
				<?php 
					foreach ($bs_nonAssets as $data) {
						echo "<tr>";
						echo 	"<td class=''>".$data->account_title."</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo "</tr>";
						// The data in this report should be get in the journals.
					}
				?>
			<tr>
				<td class="text-bold text-italic table-td-outline-bottom table-td-outline-top">TOTAL FIXED ASSETS</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
			</tr>

			<tr>
				<td class="text-bold text-italic ">OTHER ASSETS</td>
				<td class=" text-right">&nbsp;</td>
				<td class=" text-right">&nbsp;</td>
			</tr>
				<?php 
					foreach ($bs_otherAssets as $data) {
						echo "<tr>";
						echo 	"<td class=''>".$data->account_title."</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo "</tr>";
						// The data in this report should be get in the journals.
					}
				?>
			<tr>
				<td class="text-bold text-italic table-td-outline-bottom table-td-outline-top">TOTAL ASSETS</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
			</tr>

			<tr>
				<td class="text-bold text-italic ">CURRENT LIABILITIES</td>
				<td class=" text-right">&nbsp;</td>
				<td class=" text-right">&nbsp;</td>
			</tr>
				<?php 
					foreach ($bs_liabilities as $data) {
						echo "<tr>";
						echo 	"<td class=''>".$data->account_title."</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo "</tr>";
						// The data in this report should be get in the journals.
					}
				?>
			<tr>
				<td class="text-bold text-italic table-td-outline-bottom table-td-outline-top">TOTAL CURRENT LIABILITIES</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
			</tr>

			<tr>
				<td class="text-bold text-italic ">EQUITY</td>
				<td class=" text-right">&nbsp;</td>
				<td class=" text-right">&nbsp;</td>
			</tr>
				<?php 
					foreach ($bs_equity as $data) {
						echo "<tr>";
						echo 	"<td class=''>".$data->account_title."</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo 	"<td class=' text-right'>000.00</td>";
						echo "</tr>";
						// The data in this report should be get in the journals.
					}
				?>
			<tr>
				<td class="text-bold text-italic table-td-outline-bottom table-td-outline-top">TOTAL EQUITY</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
			</tr>

			<tr>
				<td class="text-bold text-italic table-td-outline-bottom table-td-outline-top">TOTAL LIABILITIES ANDEQUITY</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
				<td class=" text-right table-td-outline-bottom table-td-outline-top">000.00</td>
			</tr>

		</tbody>
	</table>
</div>