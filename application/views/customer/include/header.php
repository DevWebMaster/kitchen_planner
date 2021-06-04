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
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>plugins/datatables/jquery.dataTables.min.css">
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/plugins.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/templete.css">
	<link class="skin" rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/skin/skin-1.css">
	<!-- REVOLUTION SLIDER CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>plugins/revolution/revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>plugins/revolution/revolution/css/settings.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>plugins/revolution/revolution/css/navigation.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/plugins/toastr/toastr.min.css">
    <script src="<?= base_url(); ?>js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
</head>
<body id="bg" onload="init();">
<div class="page-wraper">
<div id="loading-area"></div>
	<!-- header -->
    <header class="site-header header-transparent mo-left">
		<!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container clearfix" style="padding-right: 0px !important; padding-left: 0px !important;">
                    <!-- website logo -->
                    <div class="logo-header mostion">
						<a href="<?= base_url('customer/'); ?>"><img src="<?= base_url(); ?>images/logo.png" alt=""></a>
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
                                <a href="<?= base_url('customer/auth/logout'); ?>" class="btn" id="btn_log_out">Salir(<?php print_r($this->session->userdata('userfname')); ?>) </a>
                            <?php }else if(!empty($this->session->userdata('is_pos_logged'))) { ?>
                                <a href="<?= base_url('customer/auth/logout'); ?>" class="btn" id="btn_log_out">Salir(<?php print_r($this->session->userdata('userfname')); ?>) </a>
                        	<?php }else if($data == 'register') { ?>
                        		<a href="<?= base_url('customer/auth/register'); ?>" class="btn">Registrarse </a>
                        	<?php }else { ?>
                            	<a href="<?= base_url('customer/auth/login'); ?>" class="btn">Login </a>
                        <?php } ?>
                        
                        </div>

                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
						<div class="logo-header">
							<a href="<?= base_url('customer/'); ?>"><img src="<?= base_url(); ?>images/logo.png" alt=""></a>
						</div>
                        <ul class="nav navbar-nav">	
                        	<?php if($data == 'index'){ ?>
                        		<li class="active"><a href="<?= base_url('customer/'); ?>">INICIO  </a></li>
                        	<?php }else { ?>
                        		<li><a href="<?= base_url('customer/'); ?>">INICIO  </a></li>
                        	<?php } ?>
                           <?php if(!empty($this->session->userdata('is_customer_logged')) || !empty($this->session->userdata('is_pos_logged'))){ ?>
                                <li><a id="kitchen_planner">DISEÑAR COCINA   </a></li>
                            <?php }else{ ?>
                                <li><a id="modal-1">DISEÑAR COCINA   </a></li>
							<?php }if($data == 'project'){ ?>
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
                                    <li class="active"><a href="<?php echo base_url('customer/main/budget');?>">Mis presupuestos  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/budget');?>">Mis presupuestos  </a></li>
                                <?php }if($data == 'order'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/order');?>">Mis Pedidos  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/order');?>">Mis Pedidos  </a></li>
                                <?php }if($data == 'account'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/account');?>">Mi Cuenta  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/account');?>">Mi Cuenta  </a></li>
                            <?php } }else if(!empty($this->session->userdata('is_pos_logged'))) { ?>
                                <?php if($data == 'product_list'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/pos_product_list');?>">Presupuestos  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/pos_product_list');?>">Presupuestos  </a></li>
                                <?php }if($data == 'order_list'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/pos_order_list');?>">Pedidos  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/pos_order_list');?>">Pedidos  </a></li>
                                <?php }if($data == 'clist'){ ?>
                                    <li class="active"><a href="<?php echo base_url('customer/main/c_list');?>">Clientes  </a></li>
                                <?php }else { ?>
                                    <li><a href="<?php echo base_url('customer/main/c_list');?>">Clientes  </a></li>
                                <?php } }?>
						</ul>	

                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
	<div class="modal fade" tabindex="-1" role="dialog" id="fire-modal-1">       
		<div class="modal-dialog modal-md" role="document">         
			<div class="modal-content">           
				<div class="modal-header" style="background-color: #ffa200">             
					<h5 class="modal-title">ALERTA</h5>             
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>           
				</div>           
				<div class="modal-body">Por favor, para poder acceder al diseñador de cocinas, primero has de logearte.</div>    
                <div class="modal-footer"><a href="<?php echo base_url('customer/auth/login');?>" class="button btn btn-primary">Login</a></div>     
			</div>       
		</div>    
		<input type="hidden" id="url" value="<?php echo base_url(); ?>">
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="duplicatePlannerModal">       
		<div class="modal-dialog modal-md" role="document">         
			<div class="modal-content">           
				<div class="modal-header" style="background-color: #ffa200">             
					<h5 class="modal-title">ALERTA</h5>             
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>           
				</div>           
				<div class="modal-body" style="color: #ffa200; font-size: 20px;">The Planner is already opened.</div>    
                <div class="modal-footer"><a data-dismiss="modal" class="button btn btn-primary" style="background-color: #ffa200; color: white;">OK</a></div>     
			</div>       
		</div>    
		<input type="hidden" id="url" value="<?php echo base_url(); ?>">
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="counterPlannerModal">       
		<div class="modal-dialog modal-md" role="document">         
			<div class="modal-content">           
				<div class="modal-header" style="background-color: #ffa200">             
					<h5 class="modal-title">ALERTA</h5>             
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>           
				</div>           
				<div class="modal-body" style="color: #ffa200; font-size: 20px;">Your Account is expired.</div>    
                <div class="modal-footer"><a data-dismiss="modal" class="button btn btn-primary" style="background-color: #ffa200; color: white;">OK</a></div>     
			</div>       
		</div>    
		<input type="hidden" id="url" value="<?php echo base_url(); ?>">
	</div>
<script type="text/javascript">
	$(document).ready(function(){
		var base_url = $('#url').val()
		$('#kitchen_planner').click(function(){
			$.ajax({
				method: "POST",
				url: '../planner/check_duplicate_planner',
			  success: function(response) {
			  	var result = JSON.parse(response)
				if(result['status'] == 1){
					$('#duplicatePlannerModal').modal('show');
					return;
				}else if(result['planner_count'] == 0){
					$('#counterPlannerModal').modal('show');
					return;
				}else{
					window.open(base_url+"customer/planner", "_blank");
				}
			  }
			})
		})
	})
</script>