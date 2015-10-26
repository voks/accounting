function login_js(){
	//Login
	$('.form-login').submit(function(e){
		$('.login-alert').slideUp();
		e.preventDefault();
		var loginformData = {
			'username'		: $('input[name=username]').val(),
			'pwd'			: $('input[name=pwd]').val(),
			'project_id'	: $('#project').val()
		};
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'login/login_user', 
			data: loginformData,
			success: function (data) { 
				if(data.success==1){
					window.location=site_url+'site';
				}
				else{
					$('.login-alert').slideDown().delay(2000).slideUp();
				}
			}
		});
	});
}