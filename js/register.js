$(document).ready(function(){

	var d = new Date();
	var month = d.toLocaleString('en-us', { month: 'short' })
	var day = d.getDate();
	var year = d.getFullYear();
	$('span[id=portinner_date]').html(month+' '+day+' '+year+' in Travelling');
	$('#post-date').html(month+' '+day+' '+year);

	$('#thing').change(function(){
		if(this.checked){
			$('#LOPD_modal').modal('show');
		}else{
			$('#LOPD_modal').modal('hide');
		}
	})
	$('#btn_confirm').click(function(){
		$('#register').attr("disabled", false)
	})
	$("#register").click(function(){
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
			// alert('wqer');

			
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
						var resp = JSON.parse(response)
						if(resp.status != 0 || resp.status != 2){
							setTimeout(function(){ 
								$('.dzFormMsg').html('<div class="gen alert alert-warning">'+resp.message+'</div>')
							}, 1500);
							var href = window.location;
							window.location = href.toString().replace('register', 'login');
						}else{
							$('.dzFormMsg').html('<div class="gen alert alert-warning">This user is already existed!</div>');
						}
					}
				})
			}

		
	})
})