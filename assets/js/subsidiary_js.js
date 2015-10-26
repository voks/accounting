function subsidiary_js(){
		
	// Adding of Subsidiary Account
	$('.subAccount-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'subsidiary_account/save_subsidiary', 
			data: $('.subAccount-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.sub-alert-success').slideDown().delay(2000).slideUp();
					$('.main_txtbox').val("");
				}
				else if(data.success==2){
					$('.sub-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of Subsidiary
	$('.searchSub-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'subsidiary_account/search_subsidiary', 
			data: $('.searchSub-form').serialize(),
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

	// Printing of Subsidairy Account Summary
	$('.subaccount-report-print').click(function(e){
		window.open(site_url+"subsidiary_account/report_tbl?at="+$('#searchAccount_type').val()+"&sc="+$('#searchAccount_code').val()+"&sn="+$('#searchAccount_name').val(),'_blank');
	});

}