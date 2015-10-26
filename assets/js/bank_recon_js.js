function bank_recon_js(){

	//Adding of Bank Recon
	$('.bank-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'bank_recon/save_bank_recon', 
			data: $('.bank-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.bank-alert-success').slideDown().delay(2000).slideUp();
					$('.main_txtbox').val("");
				}
				else if(data.success==2){
					$('.bank-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	//  Seaerching of Bank Recon
	$('.searchBank-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'bank_recon/search_bank', 
			data: $('.searchBank-form').serialize(),
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

	//  Printing of Summary
	$('.bankRecon-report-print').click(function(e){
		window.open(site_url+"bank_recon/report_tbl?bn="+$('#searchBank_name').val()+"&bm="+$('#searchBank_month').val()+"&byr="+$('#searchBank_year').val()+"&bal="+$('#searchBank_balance').val(),'_blank');
	});

}