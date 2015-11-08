$(document).ready(function(){
	side_panel_location();
	page_padding();
	
	$('.form-control').change(function(){
		if ($(this).hasClass('error')){
			($(this).val().length>0) ? ($(this).removeClass('error')):($(this).addClass('error'));
		}
	});	

	$(".accountgroup-item").click(function(e){
		alert($(this).attr('data-item'));
	});

	scrollUp();
	figure_format();
});

// Used to format the amount figure -mac
function figure_format(){
	// Format txtbx
	$('.amount').autoNumeric("init",{
		aSep: ',',
		aDec: '.', 
		aSign: ''
	});
}
// Used to scroll up the webpage as the save button is clicked -mac
function scrollUp(){
	$(".scroll").click(function(){
		$('html, body').animate({
			scrollTop: $(".scrollhere").offset().top
		}, 500);
	});
}

$(window).resize(function(){
	side_panel_location();
	page_padding();
	
	//show/hide side panel when resize
	($(window).width() < 767) ?	$('body').hasClass('open-nav') ? $('body').removeClass('open-nav') : '' : $('body').hasClass('open-nav') ? '' : $('body').addClass('open-nav');
});


function side_panel_location(){
	var el = $('.dv-page-left-panel');
	el.css({
		'top':		$('.dv-page-header').height()+'px',
		'height':	($(window).height()-$('.dv-page-header').height())+'px'
	});
	setTimeout(function(){
		el.niceScroll({
			cursoropacitymax:	'0.8',
			cursorcolor:		'#8eb92a',
			cursorborderradius:	'0px',
			cursorborder:		'0px'
		});
		el.getNiceScroll().resize();
	});
}


function page_padding(){
	$('.dv-page-main').css({
		'margin-top':	$('.dv-page-header').height()+'px'
	})
}

$('.lnk-close-nav').click(function(){
	$('body').toggleClass('open-nav');
});

$(".menu-link").click(function(e){
	e.preventDefault();

    //$(".dv-page-main").html('<img style="margin:0px;" src="http://www.mytreedb.com/uploads/mytreedb/loader/ajax_loader_gray_64.gif"/>');
    $(document).skylo('start');
    setTimeout(function(){
    	$(document).skylo('set',50);
    },1000);

    $(".ul-link").removeClass('in');
    $(".tab-link").removeClass('active');
    $(".menu-link").removeClass('active');

    $('#'+$(this).data("tab")).addClass('active');
    $('#'+$(this).data("ul")).addClass('in');
    $(this).addClass('active');

    $.ajax({
    	type: 'POST', 
    	datatype:'json',
    	url: $(this).data("address")+"/load_page"
    }).done(function( response ) { //set js redirect to login if session expire -mhon
    	if (response.success==1) {
    		window.location.href = site_url+"login";
    	}
    	else{
	    	$( ".dv-content" ).html( response );
    	}
	    	onload_functions()
	    	setTimeout(function(){
	    		$(document).skylo('end');
	    	},100);
    });
});



function onload_functions(){
	
	$('.datepicker').datepicker({
	    startDate: ''//for date limit
	});

	$(".select2-dropdown").select2();

	$('.accountype-placeholder').change(function(){
		$('.accountcode-placeholder').attr('Placeholder',$(this).val());
		if ($(this).val()=='Assets') {
			$('.accountcode-placeholder').attr('Placeholder','1000');
			
		}
		else if($(this).val()=='Liabilities'){
			$('.accountcode-placeholder').attr('Placeholder','2000');
		}
		else if($(this).val()=='Capital'){
			$('.accountcode-placeholder').attr('Placeholder','3000');
		}
		else if($(this).val()=='Revenue'){
			$('.accountcode-placeholder').attr('Placeholder','4000');
		}
		else if($(this).val()=='Expense'){
			$('.accountcode-placeholder').attr('Placeholder','5000');
		}

		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'system_settings/get_accountgroup', 
			data: {type : $(this).val()},
			success: function (data) { 
				if(data.success==1){
					$('#account_group').empty();
					$(data.response).appendTo($('#account_group')).hide().fadeIn(1000);
				}
			}
		});		
	});

	$('.sub-accounttype').change(function(){
		$('.sub-accountcode').attr('Placeholder',$(this).val());
		if ($(this).val()=='Assets') {
			$('.sub-accountcode').attr('Placeholder','1000');
			
		}
		else if($(this).val()=='Liabilities'){
			$('.sub-accountcode').attr('Placeholder','2000');
		}
		else if($(this).val()=='Capital'){
			$('.sub-accountcode').attr('Placeholder','3000');
		}
		else if($(this).val()=='Revenue'){
			$('.sub-accountcode').attr('Placeholder','4000');
		}
		else if($(this).val()=='Expense'){
			$('.sub-accountcode').attr('Placeholder','5000');
		}

		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'subsidiary_account/get_mainaccounts', 
			data: {type : $(this).val()},
			success: function (data) { 
				if(data.success==1){
					$('.sub_account_title').empty();
					$(data.html).appendTo($('.sub_account_title'));
				}
			}
		});		
	});

	$('.sub_account_title').change(function(){
		$('.sub-accountcode').val($(this).val().substring(0,5));
	});

	$('#searchAccount_type').change(function(){
		$('#searchaccount_code').attr('Placeholder',$(this).val());
		if ($(this).val()=='Assets') {
			$('#searchaccount_code').attr('Placeholder','1000');
			
		}
		else if($(this).val()=='Liabilities'){
			$('#searchaccount_code').attr('Placeholder','2000');
		}
		else if($(this).val()=='Capital'){
			$('#searchaccount_code').attr('Placeholder','3000');
		}
		else if($(this).val()=='Revenue'){
			$('#searchaccount_code').attr('Placeholder','4000');
		}
		else if($(this).val()=='Expense'){
			$('#searchaccount_code').attr('Placeholder','5000');
		}
	});
	

	$("#filter").change(function(){
		if ($("#filter").val()=='All') {
			$("#accountgroup-table  tbody tr  td").parent("tr").slideDown("slow");
		}
		else{
			$("#accountgroup-table  tbody tr").slideUp("slow");
			$("#accountgroup-table  tbody tr  td:contains('"+$(this).val()+"')").parent("tr").slideDown("slow");
		};
	});

	$('.error').click(function(e){
		$(this).slideUp(400);
	});

	form_submit();

	// Automatic showing of Total check amount in the entry table, credit side -mac
	$('#cd_check_amount').change(function(){
		var chck_amount = $('#cd_check_amount').val();
		$('#ap_trans_credit_amount').val(chck_amount);
	});

	// Automatic showing of Total of amount in the entry table, debit side -mac
	$('#cr_or_amount').change(function(){
		var or_amount = $('#cr_or_amount').val();
		$('#ap_trans_debit_amount').val(or_amount);
	});

	//Adding supplier name in the tbl enties -mac
	$('.show-supplier').change(function() {
		var supp_name = $(this).val().substring(5);
		var master_code = $(this).val().substring(0,3);

		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'site/get_j_ap', 
			data: {
				master : $(this).find(':selected').data('master'),
				mcode  : $(this).find(':selected').data('mcode')
			},
			success: function (data) { 
				if(data.success==1){
					var data = '<tr><td><input type="hidden" name="ap_entry[code][]" value="'+data.row[0].sub_code+'"/>'+data.row[0].sub_code+'</td><td><input type="hidden" name="ap_entry[accname][]"  value="'+data.row[0].sub_name+'"/>'+data.row[0].sub_name+'</td><td><input type="text" class="form-control amount entry-debit" id="ap_trans_debit_amount" name="ap_entry[accdebit][]" ></td><td><input type="text" class="form-control amount entry-credit" id="ap_trans_credit_amount" name="ap_entry[acccredit][]" value=""></td><td><a href="#" class="btn-style-2 animate-4 pull-right btn-remove"><i class="fa fa-minus"></i></a></td></tr>';
					$('#tb_entries > tbody:first').prepend(data);
					// Formating figure amount as soon as txtbox appends on the table
					figure_format();
				}
				else{
					alert('Add subsdiary for this');
				}
			}
		});		
});
	// end of adding the supplier name

	//Adding expenses in the tbl enties -mac
	$('.show-expenses').change(function() {
		var expense_name = $(this).val().substring(8); 
		var acc_code = $(this).val().substring(0,5);
		var data = '<tr><td><input type="hidden" name="ap_entry[code][]" value="'+acc_code+'"/>'+acc_code+'</td><td><input type="hidden" name="ap_entry[accname][]"  value=" '+expense_name+' "/> '+expense_name+'</td><td><input type="text" class="form-control amount entry-debit" id="ap_trans_debit_amount" name="ap_entry[accdebit][]" ></td><td><input type="text" class="form-control amount entry-credit" id="ap_trans_credit_amount" name="ap_entry[acccredit][]" value=""></td><td><a href="#" class="btn-style-2 animate-4 pull-right btn-remove"><i class="fa fa-minus"></i></a></td></tr>';
		$('#tb_entries > tbody:first').prepend(data);
		// Formating figure amount as soon as txtbox appends on the table
		figure_format();
	});

	//Adding bank in the tbl enties -mac
	$('.show-bank').change(function() {
		var bank_name = $(this).val(); 
		var bank_code = $(this).find(':selected').data('code');
		

		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'site/get_j_bank', 
			data: {
				sub : $(this).find(':selected').data('sub'),
				code  : $(this).find(':selected').data('code')
			},
			success: function (data) { 
				if(data.success==1){
					var data = '<tr><td><input type="hidden" name="ap_entry[code][]" value="'+data.row[0].sub_code+'"/>'+data.row[0].sub_code+'</td><td><input type="hidden" name="ap_entry[accname][]"  value="'+data.row[0].sub_name+'"/>'+data.row[0].sub_name+'</td><td><input type="text" class="form-control amount entry-debit" id="ap_trans_debit_amount" name="ap_entry[accdebit][]" ></td><td><input type="text" class="form-control amount entry-credit" id="ap_trans_credit_amount" name="ap_entry[acccredit][]" value=""></td><td><a href="#" class="btn-style-2 animate-4 pull-right btn-remove"><i class="fa fa-minus"></i></a></td></tr>';
					$('#tb_entries > tbody:first').prepend(data);
					// Formating figure amount as soon as txtbox appends on the table
					figure_format();
				}
				else{
					alert('Add subsdiary for this');
				}
			}
		});		
});

	//Adding customer in the tbl enties -mac
	$('.show-customer').change(function() {
		var customer_name = $(this).val().substring(5); 
		var master_code = $(this).val().substring(0,3);
		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'site/get_j_sj', 
			data: {
				master : $(this).find(':selected').data('master'),
				mcode  : $(this).find(':selected').data('mcode')
			},
			success: function (data) { 
				if(data.success==1){
					var data = '<tr><td><input type="hidden" name="ap_entry[code][]" value="'+data.row[0].sub_code+'"/>'+data.row[0].sub_code+'</td><td><input type="hidden" name="ap_entry[accname][]"  value="'+data.row[0].sub_name+'"/>'+data.row[0].sub_name+'</td><td><input type="text" class="form-control amount entry-debit" id="ap_trans_debit_amount" name="ap_entry[accdebit][]" ></td><td><input type="text" class="form-control amount entry-credit" id="ap_trans_credit_amount" name="ap_entry[acccredit][]" value=""></td><td><a href="#" class="btn-style-2 animate-4 pull-right btn-remove"><i class="fa fa-minus"></i></a></td></tr>';
					$('#tb_entries > tbody:first').prepend(data);
					// Formating figure amount as soon as txtbox appends on the table
					figure_format();
				}
				else{
					alert('Add subsdiary for this');
				}
			}
		});	
});

	//Adding customer in the tbl enties Sales Journal -mac
	$('.show-customer-sj').change(function() {
		var customer_name = $(this).val().substring(5); 
		var master_code = $(this).val().substring(0,3);

		$.ajax({ 
			type: 'POST', 
			datatype:'json',
			url: site_url+'site/get_j_sj', 
			data: {
				master : $(this).find(':selected').data('master'),
				mcode  : $(this).find(':selected').data('mcode')
			},
			success: function (data) { 
				if(data.success==1){
					var data = '<tr><td><input type="hidden" name="ap_entry[code][]" value="'+data.row[0].sub_code+'"/>'+data.row[0].sub_code+'</td><td><input type="hidden" name="ap_entry[accname][]"  value="'+data.row[0].sub_name+'"/>'+data.row[0].sub_name+'</td><td><input type="text" class="form-control amount entry-debit" id="ap_trans_debit_amount" name="ap_entry[accdebit][]" ></td><td><input type="text" class="form-control amount entry-credit" id="ap_trans_credit_amount" name="ap_entry[acccredit][]" value=""></td><td><a href="#" class="btn-style-2 animate-4 pull-right btn-remove"><i class="fa fa-minus"></i></a></td></tr>';
					$('#tb_entries > tbody:first').prepend(data);
					// Formating figure amount as soon as txtbox appends on the table
					figure_format();
				}
				else{
					alert('Add subsdiary for this');
				}
			}
		});	
});
}