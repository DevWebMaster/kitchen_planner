$(document).ready(function(){
	$(".valid_email").click(function(){
		var email = $(".dzEmail").val();
		var is_check = 1;
		if(email == ""){
			$('.dzFormMsg').html('<div class="gen alert alert-warning">Please fill out all of the email!</div>');
			$('.dzForm')[0].reset();
		}else {
			$.ajax({
				url: "valid_email",
				type: 'POST',
				data: { email: email, is_check: is_check },
				success: function(response) {
					console.log(response);
					if(response == 1) {
						$('.dzFormMsg').html('<div class="gen alert alert-warning">The Email is already existed now. Please try again!</div>');
					}else if(response == 0){
						$('.dzFormMsg').html('<div class="gen alert alert-success">validation is successed!</div>'); 						
					}
				}
			})
		}

	});
	$(".valid_pemail").click(function(){
		var email = $(".dzPos_Email").val();
		var is_check = 2;
		if(email == ""){
			$('.dzFormMsg').html('<div class="gen alert alert-warning">Please fill out all of the email!</div>');
			$('.dzForm')[0].reset();
		}else {
			$.ajax({
				url: "valid_email",
				type: 'POST',
				data: { email: email, is_check: is_check },
				success: function(response) {
					console.log(response);
					if(response == 1) {
						$('.dzFormMsg').html('<div class="gen alert alert-warning">The Email is already existed now. Please try again!</div>');
					}else if(response == 0){
						$('.dzFormMsg').html('<div class="gen alert alert-success">validation is successed!</div>'); 						
					}
				}
			})
		}

	});
	$(".register").click(function(){

			var name = $(".dzName").val();
			var lastname1 = $(".dzLastname1").val();
			var lastname2 = $(".dzLastname2").val();
			var dni = $(".dzDNI").val();
			var email = $(".dzEmail").val();
			var phone = $(".dzPhone").val();
			var password = $(".dzPassword").val();
			var confirm = $(".dzConfirm").val();
			var d_location = $(".dzd_location").val();
			var zipcode = $(".dzZipcode").val();
			var lopd = $(".dzLOPD").val();
			// var href = window.location;
			// var wqer = href.toString().replace('register', 'login');
			// alert(wqer);

			
			if(password != confirm) {
				$('.dzFormMsg').html('<div class="gen alert alert-warning">Please check the password!</div>');
				$('.dzForm')[0].reset();
			}
			if(name == "" || email == "" || phone == "" || password == "" || confirm == "" || d_location == "" || lastname1 == "" || lastname2 == "" || dni == "" || zipcode == "" || lopd == ""){
				$('.dzFormMsg').html('<div class="gen alert alert-warning">Please fill out all of the fileds!</div>');
				$('.dzForm')[0].reset();
				return;
			}else {
				$.ajax({
					url: "add_register",
					type: 'POST',
					data: { name: name, email: email, phone: phone, password: password, d_location: d_location, lastname1: lastname1, lastname2: lastname2, dni: dni, zipcode: zipcode, lopd: lopd },
					success: function(response) {
						console.log(response);
						if(response == 0) {
							$('.dzFormMsg').html('<div class="gen alert alert-warning">Failed the registeration. Please try again!</div>');
						}else if(response == 1){
							setTimeout(function(){ 
								$('.dzFormMsg').html('<div class="gen alert alert-success">Registration successfully!</div>'); 
							}, 1500);
							var href = window.location;
							window.location = href.toString().replace('register', 'login');
						}else if(response == 2){
							$('.dzFormMsg').html('<div class="gen alert alert-warning">This user is already existed!</div>');
						}
					}
				})
			}

		
	})
})