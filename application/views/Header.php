<!doctype html>
<html lang="en">
	<!-- HEAD -->
	<head>
		<title><?= $title?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<!-- VENDOR CSS -->
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/bootstrap/css/bootstrap.min.css';?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/bootstrap/css/bootstrap-toggle.min.css';?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/font-awesome/css/font-awesome.min.css';?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/bootstrap/css/dataTables.bootstrap.min.css';?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/linearicons/style.css'?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/chartist/css/chartist-custom.css'?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/toastr/toastr.min.css'?>">
		<!-- MAIN CSS -->
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/main.css'?>">
		<link rel="stylesheet" href="<?php echo base_url().'assets/css/overiding.css'?>">
		<!-- ICONS -->
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url().'assets/img/apple-icon.png'?>">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url().'assets/img/camlogo.png'?>">
	</head>
	<!-- END HEAD -->
	<!-- BODY -->
		<body>
			<!-- WRAPPER -->
			<div id="wrapper">
				<!-- NAVBAR -->
				<nav class="navbar navbar-default navbar-fixed-top">
					<div class="brand">
						<a href="<?=base_url()?>Administrators/dashboard"><img src="<?php echo base_url().'assets/img/bpms.png'?>" alt="Klorofil Logo" class="img-responsive logo"></a> 
					</div>
					<div class="container-fluid">
						<div class="navbar-btn">
							<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
						</div>
						<div id="navbar-menu">
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<span><?= $this->session->userdata('lname').", ".$this->session->userdata('fname');?></span>
										<i class="icon-submenu lnr lnr-chevron-down"></i>
									</a>
									<ul class="dropdown-menu">
										<!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li> -->
										<li><a href="<?=base_url()?>Administrators/profile"><i class="lnr lnr-users"></i> <span>My Profile</span></a></li>
										<li><a href="<?= base_url().'Administrators/logout'?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</nav>