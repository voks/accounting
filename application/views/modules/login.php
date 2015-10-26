<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title><?=$site_title?> | <?=$page_title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.css">
    <link href="<?=base_url()?>assets/css/responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/css/main.css" rel="stylesheet">
    <script>
		var site_url = "<?=site_url();?>";
	</script>
</head>
<body class='login-body gradient-lightgreen row'>
	<div class="dv-login">
	<div class='login-box shadow'>
		<div class="login-header">
			<div class="col-md-4 col-sm-4 col-xs-4 left-box"><img src="<?=base_url()?>assets/img/icon/login-logo-1.png" /></div>
			<div class="col-md-8 col-sm-8 col-xs-8 right-box"><img src="<?=base_url()?>assets/img/icon/login-logo-2.png" /></div>
		</div>
		<form class="form-login">
			<div class="alert alert-danger alert-dismissible fade in  login-alert" role="alert">
			  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true">×</span></button>
			  <strong>Warning!</strong> Credentials is invalid.
			</div>
			<div class="form-group">	
				<span class="txt"><b>Branch Name</b></span>
				<select class="form-control" name="project" id="project">
					<?php
						foreach ($project_list as $project) {
							echo "<option value='".$project->project_id."'>".$project->project_name."</option>";
						}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
			</div>
			<div class="form-group">
				<label for="pwd">Password</label>
				<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-style-1 pull-right">Submit</button>
		</form>

		<p style="margin-top:-10px;margin-bottom:20px;">
			<small>
				Licensed software of PNI International Corporation. Reproduction in any format, digital or otherwise, for purposes of publication, display or distribution without written consent of the Developer is prohibited. PNI International Corporation © 2014. All rights reserved.
			</small>
		</p>

	</div>

