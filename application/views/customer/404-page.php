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
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
	
	<!-- PAGE TITLE HERE -->
	<title>Kitchen Planner</title>
	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/plugins.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/templete.css">
	<link class="skin" rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/skin/skin-1.css">
</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
	<!-- header -->
    <header class="site-header header-transparent mo-left">
		<!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container clearfix">
                    <!-- website logo -->
                    <div class="logo-header mostion">
						<a href="index.html"><img src="<?= base_url(); ?>images/logo.png" alt=""></a>
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
                            <a href="contact-us-2.html" class="btn">Inquire Now </a>
                        </div>
                    </div>
                    <!-- main nav -->
                    <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
						<div class="logo-header">
							<a href="index.html"><img src="<?= base_url(); ?>images/logo.png" alt=""></a>
						</div>
                        <ul class="nav navbar-nav">	
                        	<li class="active"><a href="index.html">INICIO  </a></li>
							<li><a href="javascript:void(0);">Pages <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="about-me.html">About Me</a></li>
									<li><a href="about-us-1.html">About Us 01</a></li>
									<li><a href="company-exhibition.html">Company Exhibition</a></li>
									<li><a href="company-history.html">Company History</a></li>
									<li><a href="services.html">Services <span class="new-page">New</span></a></li>
									<li><a href="404-page.html">404 Page</a></li>
									<li><a href="405-page.html">405 Page <span class="new-page">New</span></a></li>
								</ul>
							</li>
							<li><a href="javascript:void(0);">Blog  <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="blog-masonry.html">Blog Masonry <span class="new-page">New</span></a></li>
									<li><a href="blog-details.html">Blog Details</a></li>
								</ul>
							</li>
							<li><a href="javascript:void(0);">Portfolio  <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="portfolio-1.html">Portfolio 1</a></li>
									<li><a href="film-strip.html">Flim Strip <span class="new-page">New</span></a></li> 
									<li><a href="project-detail-1.html">Project Detail 01</a></li>
								</ul>
							</li>
							<li><a href="javascript:void(0);">Contact Us <i class="fa fa-chevron-down"></i></a>
								<ul class="sub-menu">
									<li><a href="contact-us-2.html">Contact Us 02</a></li>
								</ul>
							</li>
						</ul>		
                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
    <!-- Content -->
    <div class="page-content">
		<!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle bg-pt" style="background-image:url(<?= base_url(); ?>images/banner/bnr2.jpg);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Error Page</h1>
					<!-- Breadcrumb row -->
					<div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="index.html">INICIO </a></li>
							<li>Error Page</li>
						</ul>
					</div>
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
		<!-- inner page banner END -->
        <div class="content-block">
			<div class="section-full content-inner-2">
				<div class="container">
					<div class="error-page text-center">
						<div class="dz_error">404</div>
						<h2 class="error-head">The Link You Folowed Probably Broken, or the page has been removed...</h2>
						<div class="m-b30">
							<div class="subscribe-form p-a0">
								<form>
									<div class="input-group">
										<input name="text" class="form-control radius-no bg-black" placeholder="Type and hit Enter..." type="text">
										<span class="input-group-btn">
											<button type="submit" class="btn radius-no white"><img src="<?= base_url(); ?>images/icon/search-icon.png" alt=""></button>
										</span> 
									</div>
								</form>
							</div>
						</div>
						<a href="index.html" class="btn radius-xl btn-lg">Return to Home</a>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- Content END-->
	<!-- Footer -->
    <footer class="site-footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<div class="widget">
							<div class="footer-logo">
								<img src="<?= base_url(); ?>images/logo.png" alt="">
							</div>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam quis.</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<div class="widget widget-info">
							<h6 class="title text-white text-uppercase">Information</h6>
							<ul class="list-2 p-l0">
								<li><a href="index.html">HOME</a></li>
								<li><a href="about-us-1.html">ABOUT</a></li>
								<li><a href="project-detail-1.html">Project</a></li>
								<li><a href="blog-grid.html">BLOG</a></li>
								<li><a href="portfolio-1.html">PORTFOLIO</a></li>
								<li><a href="contact-us-1.html">CONTACT</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<div class="widget widget-info">
							<h6 class="title text-white text-uppercase">Recent Posts</h6>
							<p class="post-date">September 08, 2015</p>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit orem ipsum dolor sit amet, consetetuer</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-4">
						<div class="widget widget-newsletter">
							<h6 class="title text-white text-uppercase">newsletter</h6>
							<div class="message-bx">
								<form class="dzSubscribe" action="script/mailchamp.php" method="post">
									<div class="dzSubscribeMsg"></div>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
										</div>
										<input name="dzEmail" required="required" type="email" class="form-control" placeholder="Email">
									</div>
									<div class="text-left">
										<button name="submit" value="Submit" type="submit" class="btn btn-md radius-xl">Send now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<p>Copyright © 2019 Intera. All right reserved</p>
					</div>
					<div class="col-lg-4">
						<ul class="social-link1 list-inline">
							<li><a href="javascript:void(0);"><img src="<?= base_url(); ?>images/logo/social-logo/pic1.jpg" alt=""></a></li>
							<li><a href="javascript:void(0);"><img src="<?= base_url(); ?>images/logo/social-logo/pic2.jpg" alt=""></a></li>
							<li><a href="javascript:void(0);"><img src="<?= base_url(); ?>images/logo/social-logo/pic3.jpg" alt=""></a></li>
							<li><a href="javascript:void(0);"><img src="<?= base_url(); ?>images/logo/social-logo/pic4.jpg" alt=""></a></li>
							<li><a href="javascript:void(0);"><img src="<?= base_url(); ?>images/logo/social-logo/pic5.jpg" alt=""></a></li>
						</ul>
					</div>
					<div class="col-lg-2 align-self-center">
						<ul class="list-inline">
							<li><a href="javascript:void(0);" class="btn-link gray"><i class="fa fa-paper-plane"></i></a></li>
							<li><a href="javascript:void(0);" class="btn-link gray"><i class="fa fa-facebook"></i></a></li>
							<li><a href="javascript:void(0);" class="btn-link gray"><i class="fa fa-instagram"></i></a></li>
							<li><a href="javascript:void(0);" class="btn-link gray"><i class="fa fa-twitter"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
        </div>
    </footer>
    <!-- Footer END -->
    <button class="scroltop fa fa-chevron-up"></button>
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?= base_url(); ?>plugins/wow/wow.js"></script><!-- WOW JS -->
<script src="<?= base_url(); ?>plugins/bootstrap/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?= base_url(); ?>plugins/bootstrap/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?= base_url(); ?>plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="<?= base_url(); ?>plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="<?= base_url(); ?>plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="<?= base_url(); ?>plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="<?= base_url(); ?>plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="<?= base_url(); ?>plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="<?= base_url(); ?>plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="<?= base_url(); ?>plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="<?= base_url(); ?>plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="js/dz.carousel.js"></script><!-- SORTCODE FUCTIONS -->
<script src="js/dz.ajax.js"></script><!-- CONTACT JS  -->

</body>
</html>