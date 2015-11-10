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
		if(journal==2){
			$('#cr_edit_modal').modal('show');
			$.ajax({
				type: 'POST',
				datatype: 'json',
				url: site_url+'general_ledger/view_account',
				data: {'id': id, 'journal': journal},
				success: function(data){	
					if (data.success==1) {
						// use to add amount format (00,000.00) - mich
						var data_amt 	= data.response[0].cr_or_amount;
						var or_amt 		= Number(data_amt).toLocaleString('en-US', {minimumFractionDigits: 2});
						var data_totDr 	= data.response[0].total_debit;
						var totdr 		= Number(data_totDr).toLocaleString('en-US', {minimumFractionDigits: 2});
						var data_totCr 	= data.response[0].total_credit;
						var totcr 		= Number(data_totCr).toLocaleString('en-US', {minimumFractionDigits: 2});
						$('.cr_ornum').val(data.response[0].cr_or_no);
						$('.cr_ordate').val(data.response[0].cr_or_date);
						$('.cr_cust').val(data.response[0].cr_master_name_customer);
						$('.cr_bino').val(data.response[0].cr_sj_si_no);
						$('.cr_bank').val(data.response[0].cr_master_name_bank);
						$('.cr_amt').val(or_amt);
						$('.cr_part').val(data.response[0].cr_particulars);
						$('.totdr').val(totdr)
						$('.totcr').val(totcr);
						$('#cr_edit_table > tbody:last').empty().fadeIn(1000);
						$(data.html).appendTo($('#cr_edit_table > tbody:last')).hide().fadeIn(1000);
					};
				}
			});
		}else if(journal==3){
			$('#ap_edit_modal').modal('show');
			$.ajax({
				type: 'POST',
				datatype: 'json',
				url: site_url+'general_ledger/view_account',
				data: {'id': id, 'journal': journal},
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
						$('#ap_edit_table > tbody:last').empty().fadeIn(1000);
						$(data.html).appendTo($('#ap_edit_table > tbody:last')).hide().fadeIn(1000);
					};
				}
			});
		}else if(journal==4){
			$('#cd_edit_modal').modal('show');
			$.ajax({
				type: 'POST',
				datatype: 'json',
				url: site_url+'general_ledger/view_account',
				data: {'id': id, 'journal': journal},
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
						$('#cd_edit_table > tbody:last').empty().fadeIn(1000);
						$(data.html).appendTo($('#cd_edit_table > tbody:last')).hide().fadeIn(1000);
					};
				}
			});
		}else if(journal==5){
			$('#sj_edit_modal').modal('show');
			$.ajax({
				type: 'POST',
				datatype: 'json',
				url: site_url+'general_ledger/view_account',
				data: {'id': id, 'journal': journal},
				success: function(data){
					if (data.success==1) {
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
						$('#sj_edit_table > tbody:last').empty().fadeIn(1000);
						$(data.html).appendTo($('#sj_edit_table > tbody:last')).hide().fadeIn(1000);
					};
				}
			});
		}else if(journal==6){
			$('#gj_edit_modal').modal('show');
			$.ajax({
				type: 'POST',
				datatype: 'json',
				url: site_url+'general_ledger/view_account',
				data: {'id': id, 'journal': journal},
				success: function(data){
					if (data.success==1) {
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
						$('#gj_edit_table > tbody:last').empty().fadeIn(1000);
						$(data.html).appendTo($('#gj_edit_table > tbody:last')).hide().fadeIn(1000);
					};
				}
			});
		}
	   // alert(id);
	   // window.open(site_url+"general_ledger/view_account?id="+id+"&journal="+journal,'_blank');
	});
}