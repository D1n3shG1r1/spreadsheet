<?php

$crrUrul = current_url();

$crrUrulParts = explode("/",$crrUrul);

$lastIdx = count($crrUrulParts) - 1;
$tmpshowexcelsheet = $crrUrulParts[$lastIdx-1];
$tmpId = $crrUrulParts[$lastIdx];


$loginId = $this->session->userdata("loginId");


?>
<!DOCTYPE HTML>
<html>

<head>
  <title>CI Excel Reports</title>
  <link rel="stylesheet" href="<?php echo base_url("assets/jquery-ui-1.13.1/jquery-ui.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/style/jquery-confirm.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/tagit/jquery.tagit.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/kento/kendo.default-v2.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/toastr/toastr.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/style/bootstrap.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/fontawesome/css/all.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/style/style.css"); ?>">
  <style>
  	
  	.spinner-border.text-light{
			height: 25px;
		  width: 25px;	
		}

		#alertMessage{
			display:none;
			position: absolute;
			bottom: 25px;
			right: 9px;
			z-index: 100;
		}

  </style>
  
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light py-2 px-1">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?php echo custom_siteurl(); ?>">CI Excel Reports</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse " id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link <?php if (current_url().'/' == custom_siteurl()) { ?> active <?php } ?>" aria-current="page" href="<?php echo custom_siteurl(); ?>">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php if (current_url() == custom_siteurl()."companies") { ?> active <?php } ?>" href="<?php echo custom_siteurl();?>companies">Companies</a>
						</li>

						<li class="nav-item">
							<a class="nav-link <?php if (current_url() == custom_siteurl()."companies/addcompany" || current_url() == custom_siteurl()."companies/company/$tmpId") { ?> active <?php } ?>" href="<?php echo custom_siteurl();?>companies/addcompany">Add Company</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link <?php if ((current_url() == custom_siteurl()."companies/reports") || current_url() == custom_siteurl()."companies/$tmpshowexcelsheet/$tmpId") { ?> active <?php } ?>" href="<?php echo custom_siteurl();?>companies/reports">Reports</a>
						</li>

						<li class="nav-item">
							<a class="nav-link <?php if ((current_url() == custom_siteurl()."companies/TeaserReport") || current_url() == custom_siteurl()."companies/teaserreport") { ?> active <?php } ?>" href="<?php echo custom_siteurl();?>companies/TeaserReport">Teaser Reports</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link <?php if ((current_url() == custom_siteurl()."companies/zipzum") || current_url() == custom_siteurl()."companies/zipzum") { ?> active <?php } ?>" href="<?php echo custom_siteurl();?>companies/zipzum">zipzum</a>
						</li>
						<li class="nav-item">

							<?php
							if($loginId && $loginId > 0){
							?>							
								<a class="nav-link" href="<?php echo custom_siteurl();?>logout">Logout</a>
							
							<?php
							}else{
							
								if ((current_url() == custom_siteurl()."login") || current_url() == custom_siteurl()."login") {

									$activeclass = "active";

								}else if((current_url() == custom_siteurl()."register") || current_url() == custom_siteurl()."register"){

									$activeclass = "active";

								}

							?>								
								<a class="nav-link<?php echo " ".$activeclass;?>" href="<?php echo custom_siteurl();?>login">Login</a>

							<?php	
							}
							?>

						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
  <main>	
