function check_dis_js(){

	// Adding of Check Disbursement
	$('.cd-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'check_dis/save_journal_cd', 
			data: $('.cd-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.cd-alert-success').slideDown().delay(2000).slideUp();
					$('.empty_txtbx').val("");
					$('.entry-list').empty(); 
				}
				else if(data.success==2){
					$('.cd-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of Check Dis
	$('.searchCD-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'check_dis/search_cd', 
			data: $('.searchCD-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
					cd_bind_print();
					cd_check_print();
					view_trans_cd();
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
	$('.cd-form').on('keyup', '.entry-debit', function () {
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
	$('.cd-form').on('keyup', '.entry-credit', function () {
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
	$('.cd-print-list-result').click(function(e){
		window.open(site_url+"check_dis/cd_summary_report?&cn"+$('#searchCD_checkNo').val()+"dfrm="+$('#searchCD_voucherDate_frm').val()+"&dto"+$('#searchCD_voucherDate_to').val(),'_blank');
	});

	// Export to Excel (Deatiled Check dis Report) -mich
	$('#btn_export').click(function(){
		$.ajax({
			type: 'POST',
			url: site_url+'check_dis/export_detailed',
			datatype: 'json',
			data: {},
			success: function(data){
				$('#alertmessage').modal('show');
			}
			});
	});

	// Export to Exel (Summmart chec dis report) -mich
	$('#btn_export_sum').click(function(){
		$.ajax({
			type: 'POST',
			url: 'check_dis/export_summary',
			datatype: 'json',
			data: {},
			success: function(data){
				$('#alertmessage').modal('show');
			}
		});
	});
	
}

function view_trans_cd(){
	$('.account-report-edit').unbind("click");
	$('.account-report-edit').click(function (event) {
		event.preventDefault();
		var e 		= $(this);
		var id		= e.data('id');
		$('#editTrans').modal('show');
		$.ajax({
			type: 'POST',
			datatype: 'json',
			url: site_url+'check_dis/show_cdinfo',
			data: {'cd_id' : id},
			success: function(data){
				if (data.success==1) {
					// use to add amount format (00,000.00) - mich
					var data_amt 	= data.response[0].cd_check_amount;
					var chck_amt 	= Number(data_amt).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totDr 	= data.response[0].total_debit;
					var totdr 		= Number(data_totDr).toLocaleString('en-US', {minimumFractionDigits: 2});
					var data_totCr 	= data.response[0].total_credit;
					var totcr 		= Number(data_totCr).toLocaleString('en-US', {minimumFractionDigits: 2});
					$('.cd_date').val(data.response[0].cd_date);
					$('.cd_vnum').val(data.response[0].cd_voucher_no);
					$('.cd_chcknum').val(data.response[0].cd_check_no);
					$('.cd_bank').val(data.response[0].cd_master_name);
					$('.cd_name').val(data.response[0].cd_payee_name);
					$('.cd_chckamt').val(chck_amt);
					$('.cd_part').val(data.response[0].cd_particulars);
					$('.totdr').val(totdr)
					$('.totcr').val(totcr);
					$('#edit_table > tbody:last').empty().fadeIn(1000);
					$(data.html).appendTo($('#edit_table > tbody:last')).hide().fadeIn(1000);
				};
			}
		});
	    // alert(id);
	   // window.open(site_url+"check_dis/view_trans?id="+id,'_blank');
	});
}

function cd_bind_print(){
	$('.account-report-print').unbind("click");
	$('.account-report-print').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
	   //alert(id);
	   window.open(site_url+"check_dis/cd_report?id="+id,'_blank');
	});
}

function cd_check_print(){
	$('.print-check').unbind("click");
	$('.print-check').click(function (event) {
		event.preventDefault();
		var id = $(this).data('id');
	   //alert(id);
	   window.open(site_url+"check_dis/cd_check?id="+id,'_blank');
	});
}