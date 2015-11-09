function cash_receipts_js(){

	// Adding of Cash Receipts
	$('.cr-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'cash_receipts/save_journal_cr', 
			data: $('.cr-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.cr-alert-success').slideDown().delay(2000).slideUp();
					$('.main_txtbox').val("");
					$('.entry-list').empty();
				}
				else if(data.success==2){
					$('.cr-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of Cash Receipts
	$('.searchCR-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'cash_receipts/search_cr', 
			data: $('.searchCR-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
					cr_bind_print();
					view_trans_cr();
				}
				else if(data.success==2){
					$('.search-alert-warning').slideDown().delay(2000).slideUp();
					$('.search-table tbody').html('');
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Auto compute of debit total
	$('.cr-form').on('keyup', '.entry-debit', function () {
		$('.entry-list').each(function(){
			var totalPoints = 0;
			$(this).find('.entry-debit').each(function(){
					    totalPoints += parseFloat($(this).val().replace( /,/g, '')); //<==== a catch  in here !! read below
					});
			var tot_amount = accounting.formatMoney(totalPoints, {
				symbol 		: '',
				precision 	: 2,
				thousand  	: ',',
				decimal   	: ".",
				format: {
					pos  : '%s %v',
					zero : '%s  0',
				}
			});
			$('.entry-debit-total').val(tot_amount);
		});
	});

	// Auto compute of credit total
	$('.cr-form').on('keyup', '.entry-credit', function () {
		$('.entry-list').each(function(){
			var totalPoints = 0;
			$(this).find('.entry-credit').each(function(){
					    totalPoints += parseFloat($(this).val().replace( /,/g, '')); //<==== a catch  in here !! read below
					});
			var tot_amount = accounting.formatMoney(totalPoints, {
				symbol 		: '',
				precision 	: 2,
				thousand  	: ',',
				decimal   	: ".",
				format: {
					pos  : '%s %v',
					zero : '%s  0',
				}
			});
			$('.entry-credit-total').val(tot_amount);
		});
	});

	// Printing of Summary Report
	$('.cr-print-list-result').click(function(e){
	  	window.open(site_url+"cash_receipts/cr_summary_report?or="+$('#searchCR_orNo').val()+"&ordfrm="+$('#searchCR_date_frm').val()+"&ordto="+$('#searchCR_date_to').val(),'_blank');
	});
}

function view_trans_cr(){
	$('.account-report-edit').unbind("click");
	$('.account-report-edit').click(function (event) {
		event.preventDefault();
		var e = $(this);
		var id = e.data('id');
		$('#editTrans').modal('show');
		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: site_url+'cash_receipts/show_crinfo',
			data: {'cr_id': id},
			success: function(data){
				if (data.success==1) {
					// use to add amount format (00,000.00) - mich
					var data_amt 	= data.response[0].cr_or_amount;
					var or_amt 		= Number(data_amt).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totDr 	= data.response[0].total_debit;
					var totdr 		= Number(data_totDr).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totCr 	= data.response[0].total_credit;
					var totcr 		= Number(data_totCr).toLocaleString('en-US', {minimumFractionDigits: 2});
					$('.cr_ornum').val(data.response[0].cr_or_no);
					$('.cr_ordate').val(data.response[0].cr_or_date);
					$('.cr_cust').val(data.response[0].cr_master_name_customer);
					$('.cr_bino').val(data.response[0].cr_sj_si_no);
					$('.cr_bank').val(data.response[0].cr_master_name_bank);
					$('.cr_amt').val(or_amt);
					$('.cr_part').val(data.response[0].cr_particulars);
					$('.totdr').val(totdr)
					$('.totcr').val(totcr);
					$('#edit_table > tbody:last').empty().fadeIn(1000);
					$(data.html).appendTo($('#edit_table > tbody:last')).hide().fadeIn(1000);
				};
			}
		});

	    // alert(id);
	   // window.open(site_url+"cash_receipts/view_trans?id="+id,'_blank');
	});
}

function cr_bind_print(){
	$('.account-report-print').unbind("click");
	$('.account-report-print').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
	   //alert(id);
	   window.open(site_url+"cash_receipts/cr_report?id="+id,'_blank');
	});
}