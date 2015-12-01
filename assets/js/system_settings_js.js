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

	// Delete Account group
	$('.accountgroup-item').click(function(){
		var e = $(this);
		var id = e.data('item');
		// alert(id);
		$('#deleteGroup').modal('show');
		$('#btn_delgroup').click(function(){
			$.ajax({
				type: 'POST',
				url: site_url+'system_settings/delete_group',
				datatype: 'json',
				data: {'id': id},
				success: function(data){
					if (data.success==1) {
						$('#deleteGroup').modal('hide');
						$('#del-success').modal('show');
					} else{
						alert('Cant delete!');
					};

				}
			});
		});	
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

	// Load all account group after deleting some data
	$('#btn_ok').click(function(){
		$.ajax({
			type: 'POST',
			url: site_url+'system_settings/load_acct_group',
			datatype: 'json',
			data: {},
			success: function(data){
				if(data.success==1){
					$('.accountgroup-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.accountgroup-table > tbody:last')).hide().fadeIn(1000);
				}
				else{
					console.log('Cantload account group');
				}
			}
		});
	});

}