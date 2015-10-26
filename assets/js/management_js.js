function management_js(){
	
	// Printing of Management Report
	$('.management-report-print').click(function(e){
		window.open(site_url+"management/report?rt="+$('#mgt_report_type').val()+"&fr="+$('#mgt_date_fr').val()+"&to="+$('#mgt_date_to').val(),'_blank');
	});
}