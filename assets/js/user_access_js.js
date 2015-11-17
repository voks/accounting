function user_access_js(){
	// Saving of User Access
	$('.userAccess-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'user_access/save_user_access', 
			data: $('.userAccess-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.userAcc-alert-success').slideDown().delay(2000).slideUp();
					$('.empty_txtbx').val("");
					$('.empty_chckbx').prop('checked',false)
					$(data.response).appendTo($('.userlist > tbody:last')).hide().fadeIn(1000);
				}
				else if(data.success==2){
					$('.userAcc-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Getting data from database transfer to modal (edit user access)
	$('.edit_user').click(function (event) {
		event.preventDefault();
		var e 		= $(this);
		var id 		= e.data('id');
		var fname 	= e.data('fname');
		var lname	= e.data('lname');
		var uname 	= e.data('uname');
		var pwd		= e.data('pwd');
		var utype	= e.data('utype');
		var trans   = e.data('trans');
		var ledger  = e.data('ledger');
		var report  = e.data('report');
		var admin   = e.data('admin');
		var setup   = e.data('setup');

		$('.userAccess').modal('show');
		$('#user_id').val(id);
		$('#fname').val(fname);
		$('#lname').val(lname);
		$('#uname').val(uname);
		$('#pass').val(pwd);
		$('#utype').val(utype);
		$('#trans').val(trans);
		$('#tab_ledger').val(ledger);
		$('#tab_report').val(report);
		$('#tab_admin').val(admin);
		$('#tab_setup').val(setup);

		(trans>0) ? $('#trans').prop('checked',true) : $('#trans').prop('checked',false);
		(ledger>0) ? $('#tab_ledger').prop('checked',true) : $('#tab_ledger').prop('checked',false);
		(admin>0) ? $('#tab_admin').prop('checked',true) : $('#tab_admin').prop('checked',false);
		(report>0) ? $('#tab_report').prop('checked',true) : $('#tab_report').prop('checked',false);
		(setup>0) ? $('#tab_setup').prop('checked',true) : $('#tab_setup').prop('checked',false);

	});

	// Updating User access
	$('.form-uaccess').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'user_access/update_user_access', 
			data: $('.form-uaccess').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.editUA-alert-success').slideDown().delay(2000).slideUp();
				}
				else if(data.success==2){
					$('.editUA-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
		// alert("success");
	});

	$('.check_access').click(function(){
		($(this).val()>0) ? $(this).attr('value','0') : $(this).attr('value','1');
	});
}