function subsidiary_js(){

	// Adding of Subsidiary Account
	$('.subAccount-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'subsidiary_account/save_subsidiary', 
			data: $('.subAccount-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.sub-alert-success').slideDown().delay(2000).slideUp();
					$('.empty_txtbx').val("");
				}
				else if(data.success==2){
					$('.sub-alert-warning').slideDown().delay(2000).slideUp();
				}
				else if(data.success==3){
					for (i=0;i<=data.err.length;i++) {
						jQuery("#"+data.err[i]).addClass('error');
					};
				}
			}
		});
	});

	// Searching of Subsidiary
	$('.searchSub-form').submit(function(e){
		e.preventDefault();
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'subsidiary_account/search_subsidiary', 
			data: $('.searchSub-form').serialize(),
			success: function (data) { 
				if(data.success==1){
					$('.search-table > tbody:last').empty().fadeIn(1000);
					$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
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

	// Printing of Subsidairy Account Summary
	$('.subaccount-report-print').click(function(e){
		window.open(site_url+"subsidiary_account/report_tbl?at="+$('#searchAccount_type').val()+"&sc="+$('#searchAccount_code').val()+"&sn="+$('#searchAccount_name').val(),'_blank');
	});

	//Modal trigger function for account summary (Duplicated from the main account module -mich)
	$('.subsummary').on('shown.bs.modal', function (event) {
		var btn = $(event.relatedTarget);
		var subID = btn.data('subid');
	  //ajax retreiving account info by account id
	  	$.ajax({ 
		  	type: 'POST', 
		  	datatype:'json',
		  	url: site_url+'subsidiary_account/get_subinfo', 
		  	data: {'sub_code' : subID},
		  	success: function (data) { 
		  		if(data.success==1){
		  			$('#subCode').val(data.response[0].sub_code);
		  			$('#subName').val(data.response[0].sub_name);
		  			$('#subType').val(data.response[0].account_type);
		  			$('#subDate').val(data.response[0].sub_date);
		  		}
		  	}
		});
	});
	// Trigger the delete confirmation modal (Duplicated from the main account module -mich)
	$('.deleteConfirmation').on('shown.bs.modal', function (event) {
		var e = $(event.relatedTarget);
		var subCode = e.data('subid');
		var subName = e.data('name');
		$('.txtcode').val(subCode);
		$('.txttitle').html('» '+subName);
	});
	// Do delete (Duplicated from the main account module -mich)
	$('.deleteTitle').click(function(){
		var subID = $('.txtcode').val();
		$.ajax({
			type: 'POST',
			url: site_url+'subsidiary_account/del_subinfo',
			data: {'sub_code' : subID},
			success: function (data){
				if(data.success==1){
					// Reload tbody data
					auto_fill_sub();
				}
			}
		});
		$('.deleteConfirmation').modal('hide');
	});

}

function auto_fill_sub(){
	// Auto Reload tbody
	$.ajax({ 
		type: 'POST', 
		datatype:'json',
		url: site_url+'subsidiary_account/search_subsidiary', 
		data: $('.searchSub-form').serialize(),
		success: function (data) { 
			if(data.success==1){
				$('.search-table > tbody:last').empty().fadeIn(1000);
				$(data.response).appendTo($('.search-table > tbody:last')).hide().fadeIn(1000);
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
}