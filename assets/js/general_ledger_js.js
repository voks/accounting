function general_ledger_js(){
	

	// Searching of General Ledger
	$('.form-gl-search').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'general_ledger/search_list', 
			data: $('.form-gl-search').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.tran_data').empty();
					$(data.data).appendTo($('#datalist > tbody:last')).hide().fadeIn(1000);
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
	});

	// Printing of General Ledger Report
	$('.search-result').click(function(e){
		window.open(site_url+"general_ledger/summary_report?ctr="+$('#main_account').val()+"&sub="+$('#sub_account').val()+"&fr"+$('#from_date').val()+"&to"+$('#to_date').val(),'_blank');
	});
}

function view_account(){
	$('.view_account').unbind("click");
	$('.view_account').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
		var journal = $(this).data('journal');
	   // alert(id);
	   window.open(site_url+"general_ledger/view_account?id="+id+"&journal="+journal,'_blank');
	});
}