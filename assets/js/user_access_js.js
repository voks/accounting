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
					$('.main_txtbox').val("");
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

		$('.userAccess').modal('show');
		$('#user_id').val(id);
		$('#fname').val(fname);
		$('#lname').val(lname);
		$('#uname').val(uname);
		$('#pass').val(pwd);
		$('#utype').val(utype);
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
}