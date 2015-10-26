<html>
<header></header>
<body style="font-size: 10px;">

	<div style="border:1px solid #000;height:194px;width:554px;margin-top:0;">
		<div class="">
			<div class="">
				<div class="">
					<span style="margin-left:200px">

					</span>
				</div>
			</div>
			<div class="">
				<div class="">
					<span style="margin-left:200px">
					
					</span>
				</div>
			</div>

			<div class="">
				<span style="margin-left:440px">
					<?php
					$check = $cd_entries->row();
					echo $check->cd_date;
					?>
				</span>
			</div>
		</div>
		<div class="">
			<div class="div-wrap-cd-footer2">
				<span style="margin-left:150px">
					<?php
					$bank = $cd_entries->row();
					echo $bank->cd_master_name;
					?>
				</span>
				<span style="margin-left:80px">
					<?php
					$bank = $cd_entries->row();
					echo number_format($bank->cd_check_amount,2);
					?>
				</span>
			</div>
		</div>
		<div class="">
				<div class="">
					<span style="margin-left:200px">

					</span>
				</div>
			</div>
		<div class="">
			<div class="">
				<span style="margin-left:150px">
					One hundred twenty thousand only
				</span>
			</div>
		</div>
	</div>
	
</body>
</html>


