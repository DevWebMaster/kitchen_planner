    <!-- Content -->
    <div class="page-content bg-white">
		<!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle bg-pt" style="background-image:url(<?= base_url(); ?>images/banner/bnr2.jpg);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Localiza nuestros Puntos de Venta</h1>
					<!-- Breadcrumb row -->
					<!-- <div class="breadcrumb-row">
						<ul class="list-inline">
							<li><a href="index.html">Home</a></li>
							<li>Pages</li>
							<li>Contact Us 1</li>
						</ul>
					</div> -->
					<!-- Breadcrumb row END -->
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="content-block">
            <!-- About Me -->
			<div class="section-full content-inner-1">
				<div class="container-fluid">
					<div class="section-head text-center">
						<h2 class="head-title">Encantados de Ayudarte</h2>
						<p>Localiza tu tienda más cercana y te daremos una atención más personalizada</p>
					</div>
					<div class="banner-map">
						<div id="map" style="width:100%;height:600px;"></div>
					</div>
				</div>
			</div>
			<div class="section-full content-inner-2 contact-box">
				<div class="container">
					<div class="row align-items-center m-b50">
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="icon-bx-wraper m-b30 left">
								<div class="icon-md m-b20 m-t5">
									<a href="javascript:void(0)" class="icon-cell text-white">
										<i class="ti-headphone-alt"></i>
									</a>
								</div>
								<div class="icon-content">
									<h4 class="dlab-tilte m-b5">Teléfono</h4>
									<p><br />Teléfono: 664 679 143 <!-- <br/> Phone 02: (+032) 3427 7670 --></p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="icon-bx-wraper m-b30 left">
								<div class="icon-md m-b20 m-t5">
									<a href="javascript:void(0)" class="icon-cell text-white">
										<i class="ti-location-pin"></i>
									</a>
								</div>
								<div class="icon-content">
									<h4 class="dlab-tilte m-b5">Dirección Oficina Central</h4>
									<p><br />C/Fila Cides, 18 Alcoy (Alicante), 03802</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="icon-bx-wraper m-b30 left">
								<div class="icon-md m-b20 m-t5">
									<a href="javascript:void(0)" class="icon-cell text-white">
										<i class="ti-email"></i>
									</a>
								</div>
								<div class="icon-content">
									<h4 class="dlab-tilte m-b5">Email</h4>
									<p>Info@roure.es <br/> contabilidad@roures.es</p>
								</div>
							</div>
						</div>
					</div>
				
					<div class="section-head text-center">
						<h2 class="head-title">Contáctanos, resolveremos tus dudas </h2>
						<!-- <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8</p> -->
					</div>
					<div class="dzFormMsg"></div>
					<form method="post" class="dzForm" action="script/contact.php">
						<input type="hidden" value="Contact" name="dzToDo">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="form-group">
									<input name="dzName" type="text" required class="form-control" placeholder="Nombre">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="form-group">
									<input name="dzEmail" type="email" class="form-control" required  placeholder="Dirección Email" >
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="form-group">
									<input name="dzOther[Phone]" type="text" required class="form-control" placeholder="Teléfono">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group">
									<textarea name="dzMessage" rows="4" class="form-control" required placeholder="Déjanos tu mensaje aquí"></textarea>
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<div class="g-recaptcha" data-sitekey="<!-- Put reCaptcha Site Key -->" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
									<input class="form-control d-none" style="display:none;" data-recaptcha="true" required data-error="Please complete the Captcha">
								</div>
							</div>
							<div class="col-md-12 col-sm-12 text-center">
								<button name="submit" type="submit" value="Submit" class="btn radius-xl btn-lg outline outline-2 black btn-aware">Enviar mensaje<span></span></button>
							</div>
						</div>
					</form>
				</div>
			</div>
            <!-- About Me End -->
        </div>
		<!-- contact area END -->
    </div>
    <!-- Content END-->

