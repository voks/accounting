<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//Site title Config
$config['site_title'] = 'EPSI Accounting';

$config['report_header'] = "<!DOCTYPE html>
							<html>
							<head>
							<link rel='icon' href='assets/img/icon/logo.ico' type='image/gif'>
							<link href='assets/css/reports.css' rel='stylesheet'>
							</head>
							<body>
								<div id='header'>
									<div class='company-header'>
										<img src='assets/img/icon/logoWhite.png'/>
										<span class='title'>EXCELLENT PERFORMANCE SERVICES
										<br/> INCORPORATION</span>
										<span class='add'>
											Unit 3, 2nd Flr. Correal Bldg.,No. 14 Lotus St., 
											T.S. Cruz Subdivision, Almanza Dos, Las Pinas City
										</span>
									</div>
									<div class='company-header-side'>
										<span>Registration Number: 1234567890</span>
									</div>
							";
$config['report_footer'] = "
								<div id='footer'>
									<div class='footer-license'>
									Licensed software of  PNI International Corporation © 2015. All rights reserved.
									ver 1.0
									</div>
									<div class='footer-pager'>
										Page <span class='page'></span>
									</div>
									
								</div>
							</body>
							</html>";


?>