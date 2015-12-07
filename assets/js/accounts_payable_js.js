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
					$('.empty_txtbx').val("");
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

	// Export to Excel Report -mich
	$('#btn_ap_excel').click(function(){
		$.ajax({
			type: 'POST',
			url: site_url='accounts_payable/ap_excel_report',
			datatype: 'json',
			data: $('.searchAP-form').serialize(),
			success: function(data){
				$('#alertmessage').modal('show');
			}
		});
	});
}


function view_trans_ap(){
	$('.account-report-edit').unbind("click");
	$('.account-report-edit').click(function (event) {
		event.preventDefault();
		var e = $(this);
		$('#editTrans').modal('show');
		var id 		= e.data('id');
		var invnum 	= e.data('invno');
		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: site_url+'accounts_payable/show_apinfo',
			data: {'ap_id' : id},
			success: function(data){
				if (data.success==1) {
					// use to add amount format (00,000.00) - mich
					var data_amt 	= data.response[0].ap_invoice_amount;
					var invamt 		= Number(data_amt).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totDr 	= data.response[0].total_debit;
					var totdr 		= Number(data_totDr).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totCr 	= data.response[0].total_credit;
					var totcr 		= Number(data_totCr).toLocaleString('en-US', {minimumFractionDigits: 2});
					$('.invdate').val(data.response[0].ap_invoice_date);
					$('.invno').val(data.response[0].ap_invoice_no);
					$('.pono').val(data.response[0].ap_po_no);
					$('.terms').val(data.response[0].ap_terms);
					$('.supp').val(data.response[0].ap_master_name);
					$('.invamt').val(invamt);
					$('.part').val(data.response[0].ap_particulars);
					$('.totdr').val(totdr);
					$('.totcr').val(totcr);
					$('#edit_table > tbody:last').empty().fadeIn(1000);
					$(data.html).appendTo($('#edit_table > tbody:last')).hide().fadeIn(1000);
				};
			}
		});
	    // alert(id);
	   // window.open(site_url+"accounts_payable/view_trans?id="+id,'_blank');
	});
}

function ap_bind_print(){
	$('.account-report-print').unbind("click");
	$('.account-report-print').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
		var invno = $(this).data('invno');
	   //alert(id);
	   window.open(site_url+"accounts_payable/ap_report?id="+id+"&invno="+invno,'_blank');
	});
}