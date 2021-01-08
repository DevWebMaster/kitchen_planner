<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="Intera - Interior HTML Template" />
	<meta property="og:title" content="Intera - Interior HTML Template" />
	<meta property="og:description" content="Intera - Interior HTML Template" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON -->
	<link rel="icon" href="<?= base_url(); ?>images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>images/favicon.png" />
	
	<!-- PAGE TITLE HERE -->
	<title>Kitchen Planner</title>
	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="<?= base_url(); ?>js/html5shiv.min.js"></script>
	<script src="<?= base_url(); ?>js/respond.min.js"></script>
	<![endif]-->
	
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/plugins.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/templete.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/split-slider.css">
	<link class="skin" rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/skin/skin-1.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/toastr/toastr.min.css">
</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
	<!-- header -->
    <header class="site-header header dark mo-left">
		<!-- main header -->
        <div class="no-sticky main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container-fluid clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion">
						<a href="<?= base_url(); ?>index.html"><img src="<?= base_url(); ?>images/logo.png" alt=""></a>
					</div>
                    <!-- nav toggle button -->
                    <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
                    <!-- extra nav -->
                    <div class="extra-nav">
                        <div class="extra-cell">
                            <?php if(!empty($this->session->userdata('is_customer_logged'))) { ?>
                                <a href="<?= base_url('customer/auth/logout'); ?>" class="btn" id="btn_log_out">Log out(<?php print_r($this->session->userdata('userfname')); ?>) </a>
                            <?php }else if(!empty($this->session->userdata('is_pos_logged'))) { ?>
                                <a href="<?= base_url('customer/auth/logout'); ?>" class="btn" id="btn_log_out">Log out(<?php print_r($this->session->userdata('userfname')); ?>) </a>
                        	<?php }else if($data == 'register') { ?>
                        		<a href="<?= base_url('customer/auth/register'); ?>" class="btn">Register </a>
                        	<?php }else { ?>
                            	<a href="<?= base_url('customer/auth/login'); ?>" class="btn">Login </a>
                        <?php } ?>
                        
                        </div>

                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
						<div class="logo-header">
							<a href="index.html"><img src="<?= base_url(); ?>images/logo.png" alt=""></a>
						</div>
                        <ul class="nav navbar-nav">	
                        	<?php if($data == 'index'){ ?>
                        		<li class="active"><a href="<?= base_url('customer/main/'); ?>">INICIO  </a></li>
                        	<?php }else { ?>
                        		<li><a href="<?= base_url('customer/main/'); ?>">INICIO  </a></li>
                        	<?php } ?>
                        	<?php if(!empty($this->session->userdata('is_customer_logged'))){ ?>
                        		<li><a href="http://localhost:8080/?customer_id=<?=$this->session->userdata('customer_id'); ?>-0" target="blank">DISEÑAR COCINA   </a></li>
                        	<?php } ?>
                        		<?php if($data == 'project'){ ?>
                        		<li class="active"><a href="<?php echo base_url('customer/main/project');?>">PROYECTOS </a></li>
                        	<?php }else { ?>
                        		<li><a href="<?php echo base_url('customer/main/project');?>">PROYECTOS </a></li>
                        	<?php } ?><?php if($data == 'contact'){ ?>
                        		<li class="active"><a href="<?php echo base_url('customer/main/contact');?>">TIENDAS </a></li>
                        	<?php }else { ?>
                        		<li><a href="<?php echo base_url('customer/main/contact');?>">TIENDAS </a></li>
                        	<?php } ?><?php if($data == 'about'){ ?>
                        		<li class="active"><a href="<?php echo base_url('customer/main/about');?>">CONÓCENOS  </a></li>
                        	<?php }else { ?>
                        		<li><a href="<?php echo base_url('customer/main/about');?>">CONÓCENOS  </a></li>
                        	<?php } ?>
                            <?php if(!empty($this->session->userdata('is_customer_logged'))) { ?>
                                <?php if($data == 'budget'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/budget');?>">My Budgets  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/budget');?>">My Budgets  </a></li>
                                <?php }if($data == 'order'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/order');?>">My Orders  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/order');?>">My Orders  </a></li>
                                <?php }if($data == 'account'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/account');?>">My Account  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/account');?>">My Account  </a></li>
                            <?php } }else if(!empty($this->session->userdata('is_pos_logged'))) { ?>
                                <?php if($data == 'budget_list'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/pos_order_list');?>">Order List  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/pos_order_list');?>">Order List  </a></li>
                                <?php }if($data == 'clist'){ ?>
                                <li class="active"><a href="<?php echo base_url('customer/main/clist');?>">Customer List  </a></li>
                            <?php }else { ?>
                                <li><a href="<?php echo base_url('customer/main/clist');?>">Customer List  </a></li>
                            <?php } }?>
						</ul>	

                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
