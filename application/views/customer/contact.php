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
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBjirg3UoMD5oUiFuZt3P9sErZD-2Rxc68&sensor=false"  ></script>
    <!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
    <script type="text/javascript">
    	var map;
    	// var iconBase = "https://developers.google.com/maps/documentation/javascript/examples/full/images/";
    	// var iconBase = "http://maps.google.com/mapfiles/ms/icons/";
    	var iconBase ="<?= base_url(); ?>images/";
		// Ban Jelačić Square - Center of Zagreb, Croatia
		// var center = new google.maps.LatLng(45.812897, 15.97706);
		var center = new google.maps.LatLng(38.6892374, -0.4848669);  //madrid 40.4167047, -3.7035825

		var geocoder = new google.maps.Geocoder();
		var infowindow = new google.maps.InfoWindow();

		function init() {

			var mapOptions = {
			zoom: 13,
			center: center,
			mapTypeId: google.maps.MapTypeId.ROADMAP
			}

			map = new google.maps.Map(document.getElementById("map"), mapOptions);

			var marker = new google.maps.Marker({
				map: map,
				position: center,
			});
			$.ajax({
				method: "POST",
				url: 'get_pos_locations',
				dataType: 'json',
			  success: function(dzRes) {
				for (var i = 0; i < dzRes.length; i++) {
					displayLocation(dzRes[i]);
				}
			  }
			})
		}
		function displayLocation(location) {

			var content =   '<div class="infoWindow"><strong>'  + location.name + '</strong>'
			+ '<br/>'     + location.address
			+ '<br/>'     + location.description + '</div>';

			if (parseInt(location.lat) == 0) {
				geocoder.geocode( { 'address': location.address }, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {

					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location,
						title: location.name,
						// label: 'P',
						icon: iconBase+"parking_lot.png",

						animation: google.maps.Animation.DROP,
					});

					google.maps.event.addListener(marker, 'click', function() {
						infowindow.setContent(content);
						infowindow.open(map,marker);
					});
				}
				});
			} else {
				var position = new google.maps.LatLng(parseFloat(location.lat), parseFloat(location.lon));
				var marker = new google.maps.Marker({
					map: map,
					position: position,
					title: location.name,
					// label: 'P',
					icon: iconBase+"parking_lot.png",
					animation: google.maps.Animation.DROP,

				});

				google.maps.event.addListener(marker, 'click', function() {
					infowindow.setContent(content);
					infowindow.open(map,marker);
				});
			}
		}
    </script>

