function aging_js(){
	
	// Printing of Aging Report
    $('.aging-report-print').click(function(e){
    	window.open(site_url+"aging/report?rt="+$('#aging_report_type').val(),'_blank');
    });
}