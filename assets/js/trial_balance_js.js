function trial_balance_js(){

	// Searching of Trial Balance
	$('.form_trail').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'trial_balance/search_trial', 
			data: $('.form_trail').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('#datalist tbody').html('');
					$(data.html).appendTo($('#datalist > tbody:last')).hide().fadeIn(1000);
					view_account();
				}
				else if(data.success==2){
					$('.search-alert-warning').slideDown().delay(2000).slideUp();
					$('#datalist tbody').html('');
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	})

	// Printing of Trial Balnce Report
	$('.print-trial-list').click(function(e){
		window.open(site_url+"trial_balance/trial_summary_report?trans="+$('#journal_type').val()+"&in="+$('#ctr_acct').val()+"&invd="+$('#from_date').val()+"&mn="+$('#to_date').val(),'_blank');
	});

	// Listing toggle
	// $('.listing').click(function(){
	// 	($(this).val()>0) ? $(this).attr('value','0') : $(this).attr('value','1');
	// });
}