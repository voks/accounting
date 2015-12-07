function sales_journal_js(){

	// Adding of Sales Journal
	$('.sj-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'sales_journal/save_journal_sj', 
			data: $('.sj-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.sj-alert-success').slideDown().delay(2000).slideUp();
					$('.empty_txtbx').val("");
					$('.entry-list').empty();
				}
				else if(data.success==2){
					$('.sj-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of sales journal
	$('.searchSJ-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'sales_journal/search_sj', 
			data: $('.searchSJ-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
					sj_bind_print();
					view_trans_sj();
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
	$('.sj-form').on('keyup', '.entry-debit', function () {
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
	$('.sj-form').on('keyup', '.entry-credit', function () {
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
	$('.sj-print-list-result').click(function(e){
		window.open(site_url+"sales_journal/sj_summary_report?si="+$('#searchSJ_siNo').val()+"&sid="+$('#searchSJ_siDate_frm').val()+"&sid="+$('#searchSJ_siDate_to').val(),'_blank');
	});

	// Export Sales Summary Report
	$('#btn_sales_export_sum').click(function(){
		$.ajax({
			type: 'POST',
			url: site_url+'sales_journal/export_sales_summary',
			datatype: 'json',
			data: {},
			success: function(data){
				$('#alertmessage').modal('show');
			}
		});
	});

	// Export Sales Detailed Report
	$('#btn_sales_export').click(function(){
		$.ajax({
			type: 'POST',
			url: site_url+'sales_journal/export_sales_detailed',
			datatype: 'json',
			data: {},
			success: function(data){
				$('#alertmessage').modal('show');
			}
		});
	});
}

function view_trans_sj(){
	$('.account-report-edit').unbind("click");
	$('.account-report-edit').click(function (event) {
		event.preventDefault();
		var e  = $(this);
		var id = e.data('id');
		$('#editTrans').modal('show');
		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: site_url+'sales_journal/show_sjinfo',
			data: {'sj_id' : id},
			success: function(data){
				if(data.success==1){
					// use to add amount format (00,000.00) - mich
					var data_amt 	= data.response[0].sj_si_amount;
					var bill_amt 	= Number(data_amt).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totDr 	= data.response[0].total_debit;
					var totdr 		= Number(data_totDr).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totCr 	= data.response[0].total_credit;
					var totcr 		= Number(data_totCr).toLocaleString('en-US', {minimumFractionDigits: 2});
					$('.sj_date').val(data.response[0].sj_si_date);
					$('.sj_num').val(data.response[0].sj_si_no);
					$('.sj_cust').val(data.response[0].sj_master_name);
					$('.sj_terms').val(data.response[0].sj_terms);
					$('.sj_amt').val(bill_amt);
					$('.sj_part').val(data.response[0].sj_particulars);
					$('.totdr').val(totdr)
					$('.totcr').val(totcr);
					$('#edit_table > tbody:last').empty().fadeIn(1000);
					$(data.html).appendTo($('#edit_table > tbody:last')).hide().fadeIn(1000);
				};
			}
		});
	    // alert(id);
	   // window.open(site_url+"sales_journal/view_trans?id="+id,'_blank');
	});
}

function sj_bind_print(){
	$('.account-report-print').unbind("click");
	$('.account-report-print').click(function (event) {
		event.preventDefault();
		var e  = $(this);
		var id = e.data('id');
		var bi = e.data('bi');
	   //alert(id);
	   window.open(site_url+"sales_journal/sj_report?id="+id+"&bi="+bi,'_blank');
	});
}