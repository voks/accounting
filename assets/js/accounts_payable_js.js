function accounts_payable_js(){

	// Saving of transactions
	$('.ap-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'accounts_payable/save_journal_ap', 
			data: $('.ap-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.ap-alert-success').slideDown().delay(2000).slideUp();
					$('.main_txtbox').val("");
					$('.entry-list').empty(); 
				}
				else if(data.success==2){
					$('.ap-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of created transaction
	$('.searchAP-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'accounts_payable/search_ap', 
			data: $('.searchAP-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
					ap_bind_print();
					view_trans_ap();
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
	$('.ap-form').on('keyup', '.entry-debit', function () {
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
	$('.ap-form').on('keyup', '.entry-credit', function () {
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

	//  Printing of Accounts payable Summary
	$('.print-list-result').click(function(e){
		window.open(site_url+"accounts_payable/ap_summary_report?in="+$('#searchAP_invNo').val()+"&invd="+$('#searchAP_date_frm').val()+"&po"+$('#searchAP_date_to').val()+"&mn"+$('#searchAP_suppName').val(),'_blank');
	});
}



function view_trans_ap(){
	$('.account-report-edit').unbind("click");
	$('.account-report-edit').click(function (event) {
		event.preventDefault();
		var e = $(this);
		$('#editTrans').modal('show');
		var id 		= e.data('id');
		var invdate = e.data('invdate');
		var invno 	= e.data('invno');
		var po  	= e.data('po');
		var terms 	= e.data('terms');
		var supp 	= e.data('supp');
		var invamt 	= e.data('invamt');
		var part 	= e.data('part');

		var amt 	= invamt.toFixed(2);
		
		$('.invdate').val(invdate);
		$('.invno').val(invno);
		$('.pono').val(po);
		$('.terms').val(terms);
		$('.supp').val(supp);
		$('.invamt').val(amt);
		$('.part').val(part); 
	    // alert(id);
	   // window.open(site_url+"accounts_payable/view_trans?id="+id,'_blank');
	});
}


function ap_bind_print(){
	$('.account-report-print').unbind("click");
	$('.account-report-print').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
	   //alert(id);
	   window.open(site_url+"accounts_payable/ap_report?id="+id,'_blank');
	});
}