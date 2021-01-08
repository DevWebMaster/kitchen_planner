    <!-- Content -->
    <div class="page-content bg-white">
		<!-- inner page banner -->
   
        <!-- inner page banner END -->
        <div class="content-block">
            <!-- About Me -->
		
			<div class="section-full content-inner-2 contact-box">
				<div class="container">
					
				
					<div class="section-head text-center">
						<h2 class="head-title">My Account </h2>
						<!-- <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8</p> -->
					</div>
					<div class="dzFormMsg"></div>
					<form method="post" class="dzUpdateForm" action="updateaccount">
						<input type="hidden" value="Contact" name="dzToDo">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3"></div>
							<div class="col-lg-1 col-md-1 col-sm-1" style="margin-top: 14px; padding-right: 0px; text-align: right;"><label>Email: </label></div>
							<div class="col-lg-5 col-md-5 col-sm-12">
								<div class="form-group">
									
									<input name="dzEmail" required="required" type="email" readonly="true" required value="<?= $user_info->email; ?>" class="form-control dzEmail">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-12"></div>
							<div class="col-lg-1 col-md-1 col-sm-1" style="margin-top: 14px; padding-right: 0px; text-align: right;"><label>Name: </label></div>
							<div class="col-lg-5 col-md-5 col-sm-12">
								<div class="form-group">
									<input name="dzName" type="text" required class="form-control dzName" value="<?= $user_info->customer_name; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-12"></div>
							<div class="col-lg-1 col-md-1 col-sm-1" style="margin-top: 14px; padding-right: 0px; text-align: right;"><label>Last Name: </label></div>
							<div class="col-lg-2 col-md-2 col-sm-12">
								<div class="form-group">
									<input name="dzLastname1" type="text" required class="form-control dzLastname1" value="<?= $user_info->last_name1; ?>">
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-12">
								<div class="form-group">
									<input name="dzLastname2" type="text" required class="form-control dzLastname2" value="<?= $user_info->last_name2; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3"></div>
							<div class="col-lg-1 col-md-1 col-sm-1" style="margin-top: 14px; padding-right: 0px; text-align: right;"><label>DNI: </label></div>
							<div class="col-lg-5 col-md-5 col-sm-6">
								<div class="form-group">
									<input name="dzDNI" type="text" required class="form-control dzDNI" value="<?= $user_info->DNI; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3"></div>
							<div class="col-lg-1 col-md-1 col-sm-1" style="margin-top: 14px; padding-right: 0px; text-align: right;"><label>PHONE: </label></div>
							<div class="col-lg-5 col-md-5 col-sm-6">
								<div class="form-group">
									<input name="dzPhone" type="text" required class="form-control dzPhone" value="<?= $user_info->phone; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3"></div>
							<div class="col-lg-1 col-md-1 col-sm-1" style="margin-top: 14px; padding-right: 0px; text-align: right;"><label>Direction: </label></div>
							<div class="col-lg-5 col-md-5 col-sm-6">
								<div class="form-group">
									<input name="dzd_location" type="text" required class="form-control dzd_location" value="<?= $user_info->delivery_direction; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3"></div>
							<div class="col-lg-1 col-md-1 col-sm-1" style="margin-top: 14px; padding-right: 0px; text-align: right;"><label>Zip code: </label></div>
							<div class="col-lg-5 col-md-5 col-sm-6">
								<div class="form-group">
									<input name="dzZipcode" type="text" required class="form-control dzZipcode" value="<?= $user_info->Zip_code; ?>">
								</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3"></div>
							<div class="col-lg-5 col-md-5 col-sm-6">
								<div class="form-group">
									<input name="dzConfirm" type="Password" class="form-control dzConfirm" required placeholder="Confirm Password"></input>
								</div>
							</div>
						</div> -->
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3"></div>
							<div class="col-lg-5 col-md-5 col-sm-6">
								<!-- <div class="form-group">
									<input type="checkbox" name="dzLOPD" class="form-control dzLOPD" value="1">
									<label for="dzLOPD">Sign LOPD</label>
								</div> -->
								<!-- <div class="box">
									<input type='checkbox' name='thing' class="dzLOPD" value='1' id="thing"/><label class="lopd" for="thing"></label> <label class="lopd">Sign LOPD</label>
								</div> -->
							</div>

							<div class="col-md-12 col-sm-12 text-center">
								<button name="submit" type="submit" value="submit" class="btn radius-xl btn-lg outline outline-2 black btn-aware update">Update<span></span></button>
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

