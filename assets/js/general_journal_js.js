function general_journal_js(){

	// Adding of General Journal
	$('.gj-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'general_journal/save_journal_gj', 
			data: $('.gj-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.gj-alert-success').slideDown().delay(2000).slideUp();
					$('.empty_txtbx').val("");
					$('.entry-list').empty();
				}
				else if(data.success==2){
					$('.gj-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of General Journal
	$('.searchGJ-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'general_journal/search_gj', 
			data: $('.searchGJ-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
					gj_bind_print();
					view_trans_gj();
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
	$('.gj-form').on('keyup', '.entry-debit', function () {
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
	$('.gj-form').on('keyup', '.entry-credit', function () {
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

	// Printing of Summary report
	$('.gj-print-list-result').click(function(e){
	 	window.open(site_url+"general_journal/gj_summary_report?jn="+$('#searchGJ_code').val()+"&jndfrm="+$('#searchGJ_date_frm').val()+"&jndto="+$('#searchGJ_date_to').val(),'_blank');
	});
}

function view_trans_gj(){
	$('.account-report-edit').unbind("click");
	$('.account-report-edit').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
		$('#editTrans').modal('show');
		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: site_url+'general_journal/show_gjinfo',
			data:{'gj_id': id},
			success: function(data){
				if(data.success==1){
					// use to add amount format (00,000.00) - mich
					var data_amt 	= data.response[0].gj_amount;
					var gj_amt 		= Number(data_amt).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totDr 	= data.response[0].total_debit;
					var totdr 		= Number(data_totDr).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totCr 	= data.response[0].total_credit;
					var totcr 		= Number(data_totCr).toLocaleString('en-US', {minimumFractionDigits: 2});
					$('.gj_num').val(data.response[0].gj_code);
					$('.gj_date').val(data.response[0].gj_date);
					$('.gj_amt').val(gj_amt);
					$('.gj_part').val(data.response[0].gj_particulars);
					$('.totdr').val(totdr)
					$('.totcr').val(totcr);
					$('#edit_table > tbody:last').empty().fadeIn(1000);
					$(data.html).appendTo($('#edit_table > tbody:last')).hide().fadeIn(1000);
				};
			}
		});
	    // alert(id);
	   // window.open(site_url+"general_journal/view_trans?id="+id,'_blank');
	});
}

function gj_bind_print(){
	$('.account-report-print').unbind("click");
	$('.account-report-print').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
		var jn = $(this).data('jn');
	   //alert(id);
	   window.open(site_url+"general_journal/gj_report?id="+id+"&jn="+jn,'_blank');
	});
}