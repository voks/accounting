function master_account_js(){
	// Adding Master Acconts
	$('.master-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'master_account/save_master_account', 
			data: $('.master-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.master-alert-success').slideDown().delay(2000).slideUp();
					$('.main_txtbox').val("");
				}
				else if(data.success==2){
					$('.master-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching Master Accounts
	$('.searchMaster-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'master_account/search_master', 
			data: $('.searchMaster-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
					show_masterinfo();
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

	

	// Printing of Summary
	$('.masteraccount-report-print').click(function(e){
		window.open(site_url+"master_account/report_tbl?mn="+$('#searchMaster_name').val()+"&ma="+$('#searchMaster_type').val(),'_blank');
	});
}

function show_masterinfo(){
	$('.showModal').unbind("click");
	$('.showModal').click(function(){
		var e = $(this);
		$('.viewModal').modal('show');
		var date 	= e.data('date');
		var mCode 	= e.data('mastercode');
		var name 	= e.data('name');
		var type 	= e.data('type');
		var add 	= e.data('add');
		var term 	= e.data('term');
		var person 	= e.data('person');
		var pos 	= e.data('position');
		var tel 	= e.data('tel');
		var email 	= e.data('email');
		var fax 	= e.data('fax');

		$('#txt_date').val(date);
		$('#txt_mcode').val(mCode);
		$('#txt_name').val(name);
		$('#txt_type').val(type);
		$('#txt_add').val(add);
		$('#txt_term').val(term);
		$('#txt_person').val(person);
		$('#txt_position').val(pos);
		$('#txt_tel').val(tel);
		$('#txt_email').val(email);
		$('#txt_fax').val(fax);
		
	});
}