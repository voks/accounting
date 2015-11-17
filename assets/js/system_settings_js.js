function system_settings_js(){
	//Account Group
	$('.accountgroup-form').submit(function(e){
		e.preventDefault();
		if ($('#accountType').val().length>0&&$('input[name=accountGroup]').val().length>0) {
			var accountgroupData = {
				'account_type'		: $('#accountType').val(),
				'accountgroup'		: $('input[name=accountGroup]').val()
			};
			$.ajax({ 
				type: 'POST', 
				datatype:'json',
				url: site_url+'system_settings/add_accountgroup', 
				data: accountgroupData,
				success: function (data) { 
					if(data.success==1){
						$(data.response).appendTo($('.accountgroup-table > tbody:last')).hide().fadeIn(1000);
						$('.accountgroup-alert-success').slideDown().delay(2000).slideUp();
						$('.empty_txtbx').val("");
						$('.accountgroup-alert-success').delay(2000).fadeOut();
					}
					else{
						$('.accountgroup-alert-warning').slideDown().delay(2000).slideUp();
					}
				}
			});

			$('#accountGroup').val('');

		}
		else{
			jQuery("#accountGroup").addClass('error');
		};
	});

	// Adding of Copyrights
	$('.form-copyrights').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'system_settings/save_copyrights', 
			data: $('.form-copyrights').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.copyrights-alert-success').slideDown().delay(2000).slideUp();
					$('.empty_txtbx').val("");
				}
				else if(data.success==2){
					$('.copyrights-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

}