function chart_accounts_js(){

	// Adding of Chart of accounts
	$('.mainaccount-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'main_account/save_main_account', 
			data: $('.mainaccount-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.main-alert-success').slideDown().delay(2000).slideUp();
					$('.main_txtbox').val("");
					$('.main-alert-success').delay(2000).fadeOut();
				}
				else if(data.success==2){
					$('.main-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of Chart of Accounts
	$('.searchaccount-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'main_account/search_accountcode', 
			data: $('.searchaccount-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
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

	// Printing of Chart of Accounts Summary
	$('.mainaccount-report-print').click(function(e){
		window.open(site_url+"main_account/report_tbl?at="+$('#searchAccount_type').val()+"&ac="+$('#searchaccount_code').val()+"&atits"+$('#searchaccount_title').val(),'_blank');
	});

}