    <!-- Content -->
    <div class="page-content bg-white">
		<!-- inner page banner -->
   
        <!-- inner page banner END -->
        <div class="content-block">
            <!-- About Me -->
		
			<div class="section-full content-inner-2 contact-box">
				<div class="container">
					
				
					<div class="section-head text-center">
						<h2 class="head-title">Account Verification </h2>
						<!-- <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8</p> -->
					</div>
					<div class="dzFormMsg"></div>
					<?php
						if($status == 'S'){ ?>
							<a href="../auth/login"><?= $msg; ?></a>
					<?php
						}else{ ?>
							<a href="../auth/register"><?= $msg; ?></a>
					<?php		
						}
					?>
				</div>
			</div>
            <!-- About Me End -->
        </div>
		<!-- contact area END -->
    </div>
    <!-- Content END-->

