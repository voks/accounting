function form_submit () {
	global_function();
	login_js();
	accounts_payable_js();
	aging_js();
	bank_recon_js();
	cash_receipts_js();
	chart_accounts_js();
	check_dis_js();
	general_journal_js();
	general_ledger_js();
	management_js();
	master_account_js();
	sales_journal_js();
	subsidiary_js();
	system_settings_js();
	trial_balance_js();
	user_access_js();
	figure_format();
}

function global_function(){
	// Searching of entries
	$('.search-chartaccount').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'site/search_chartaccount', 
			data: $('.search-chartaccount').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.tran_data').empty();
					$(data.response).appendTo($('.chart-table > tbody:last')).hide().fadeIn(1000);
				}
				else if(data.success==2){
					$('.chart-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Getting of Subsidiary
	$('.entry-select').change(function(){
		$('.entry-text').val($(this).val().substring(0,5));

		$('.entry-subcode').val('');
		$('.entry-subname').val(null).trigger("change");

		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'site/get_sub', 
			data: {account_code :$('.entry-text').val()},
			success: function (data) { 
				if(data.success==1){
					$('.entry-subname').empty();	             	
					$('.entry-subname').append($(data.html));

					$('.entry-code').empty();	
					$('.entry-code').val($('.entry-text').val());	
				}
				else{
					$('.entry-code').empty();	
					$('.entry-code').val($('.entry-text').val());	
				}
			}
		});
	});

	// Putting Subsidiary code on the textfield
	$('.entry-subname').change(function(){
		$('.entry-subcode').val($('.entry-subname').val());
		$('.entry-code').empty();	
		$('.entry-code').val($(this).val());	
	});

	// Adding of entries to be appended on the table transaction
	$('.btn-add-trans').click(function(){
		var e = $(this);
		var chckboxs = [];
		var checkboxElement = $("tbody.tran_data input:checked");

		if(checkboxElement.length){
			checkboxElement.each(function(){
				var checkEvent = $(this);
				var subsidiaryCode = checkEvent.data('subcode');
				var subsidiaryName = checkEvent.data('subname');
				var data = '<tr><td><input type="hidden" name="ap_entry[code][]" value="'+subsidiaryCode+'"/>'+subsidiaryCode+'</td><td><input type="hidden" name="ap_entry[accname][]" value="'+subsidiaryName+'"/>'+subsidiaryName+'</td><td><input type="text" class="form-control amount entry-debit" id="ap_trans_debit_amount" name="ap_entry[accdebit][]" value=""></td><td><input type="text" class="form-control amount entry-credit" id="ap_trans_credit_amount" name="ap_entry[acccredit][]" value=""></td><td><a href="#" class="btn-style-2 animate-4 pull-right btn-remove"><i class="fa fa-minus"></i></a></td></tr>';
				if (checkEvent.is(":checked")) {
					$('#tb_entries > tbody:last').prepend(data);
					$("tbody.tran_data input:checked")[0].checked = false;
					$('.modal').modal('hide');
					// Formating figure amount as soon as txtbox appends on the table
					figure_format();
				}
			});
		} else {
			$('.entries-alert-warning').slideDown();
		}
	});

	//removing entries
	$('#tb_entries').on('click', '.btn-remove', function(){
		var e = $(this);
		e.closest('tr').remove();
	});

	// Showing of textfield depending upon on the selected value of "Short by"
	$('#sel-opt').change(function(){
		var e = $(this).val();
		// alert(e);
		if (e == 1) {
			$('.month').show();
			$('.quarter').hide();
		} else if (e == 2){
			$('.quarter').show();
			$('.month').hide();
		} else {
			$('.month').hide();
			$('.quarter').hide();
		};
	});

	// removing of class error if the fields has values
	$('.form-control').change(function(){
		if ($(this).hasClass('error')){
			($(this).val().length>0) ? ($(this).removeClass('error')):($(this).addClass('error'));
		}
	});	

	// Load all Accounts Again
	$('.reset').click(function(){
		
	});
}