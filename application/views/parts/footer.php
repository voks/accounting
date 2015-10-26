			</div>
		</div>	<!-- Page content end -->
	</div>
		<script src="<?=base_url()?>assets/plugins/jquery/js/jquery-1.11.1.min.js"></script>
		<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?=base_url()?>assets/js/main.js"></script>

		<script src="<?=base_url()?>assets/js/jquery.nicescroll.js"></script>
		<!-- datepicker JS -->
		<script src="<?=base_url()?>assets/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
		<!-- skyloader JS -->
		<script type='text/javascript' src='<?=base_url()?>assets/plugins/progress-skylo/skylo.js'></script> 

		<!-- select2 JS -->
		<script src="<?=base_url()?>assets/js/select2/select2.min.js" type="text/javascript"></script>

		<!-- Input masked -->
		<script src="<?=base_url()?>assets/plugins/jquery.inputmask-3.x/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/plugins/jquery.inputmask-3.x/js/inputmask.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/plugins/jquery.inputmask-3.x/js/jquery.inputmask.js" type="text/javascript"></script>

		<!-- Accounting Plugin textbox formating -->
		<script src="<?=base_url()?>assets/plugins/accounting.js-master/accounting.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/plugins/accounting.js-master/accounting.min.js" type="text/javascript"></script>

		<!-- Amount Figure Format -->
		<script src="<?=base_url()?>assets/plugins/autoNumeric-master/autoNumeric.js" type="text/javascript"></script>

		<script>

			$(document).ready(function() {
		    	onload_functions();
			});

		  	$(window).resize(function(){
		  		($(this).width() < 767) ? $('body').addClass('close-nav') : $('body').removeClass('close-nav')
		  	});

		  	$('.lnk-close-nav').click(function(){
		  		$('body').hasClass('close-nav') ?  $('body').removeClass('close-nav') :$('body').addClass('close-nav') 
			});

			$('.close').click(function(){
		  		$('.alert').slideUp(100);
		  	});

		</script>

		<!-- Modules JS Files -->
		<script src="<?=base_url()?>assets/js/functions.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/login_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/accounts_payable_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/accounts_receivable_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/aging_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/bank_recon_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/cash_receipts_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/chart_accounts_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/check_dis_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/general_journal_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/general_ledger_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/management_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/master_account_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/sales_journal_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/subsidiary_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/system_settings_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/trial_balance_js.js" type="text/javascript"></script>
		<script src="<?=base_url()?>assets/js/user_access_js.js" type="text/javascript"></script>
    </body>
</html>