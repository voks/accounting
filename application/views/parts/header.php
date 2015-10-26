<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=$site_title?> | <?=$page_title?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- <meta http-equiv="refresh" content="0;URL='https://www.google.com.ph'" /> -->
		
		<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
        <!-- datepicker CSS -->
    	<link rel="stylesheet" href="<?=base_url()?>assets/css/datepicker/datepicker3.css">
    	<!-- skylo CSS -->
    	<link rel='stylesheet' type='text/css' href='<?=base_url()?>assets/plugins/progress-skylo/skylo.css' /> 

    	<!-- select2 CSS -->
    	<link href="<?=base_url()?>assets/css/select2/select2.min.css" rel="stylesheet" />
		
		<!--favicon-->
		<link rel="icon" href="<?=base_url()?>assets/img/icon/logo.ico" type="image/gif">

		<!-- jqplot css -->
		<link href="<?=base_url()?>assets/plugins/jqplot/jquery.jqplot.css" rel="stylesheet"/>
		<link href="<?=base_url()?>assets/plugins/jqplot/jquery.jqplot.min.css" rel="stylesheet"/>

    	<script>
    		var site_url = "<?=site_url();?>";
    	</script>
    </head>
    <body class="animate-4 open-nav">
	
	<div class="dv-page-container">
		<!-- Fixed navbar -->
		<!-- PAge header start -->
		<div class="dv-page-header">
			<a class="logo" href="#">
				<img src="<?=base_url()?>assets/img/icon/logo.png	" alt="" />
			</a>
			<a href="javascript:void(0)" class="lnk-close-nav pull-right animate-4 visible-xs"><i class="fa fa-bars "></i></a>
			<span class="project-title  hidden-xs" style="text-transform:uppercase"><i class="fa fa-folder-open"></i> PROJECT: <?=$project_name?></span>
		</div><!-- PAge header end -->
	
		
	