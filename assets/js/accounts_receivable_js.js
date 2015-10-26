function accounts_receivable_js(){

	// Searching of Accounts Receivable
	$('.searchAR-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'accounts_receivable/search_ar', 
			data: $('.searchAR-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table> tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
					print_billing();
				}
				else if(data.success==2){
					$('.ar-alert-warning').slideDown().delay(2000).slideUp();
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

	// Printing of AR Summary
	$('.print-ar-list').click(function(e){
		window.open(site_url+"accounts_receivable/ar_summary_report?ar="+$('#ar_customer').val(),'_blank');
	});
}

// Printing of Billing
function print_billing(){
	$('.ar-report-print').unbind("click");
	$('.ar-report-print').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
	   window.open(site_url+"accounts_receivable/print_ar_billing?id="+id,'_blank');
	});
}