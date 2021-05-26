    <!-- Content -->
    <div class="page-content bg-white">
		<!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle bg-pt" style="background-image:url(<?= base_url(); ?>images/banner/bnr3.jpg);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Presupuestos</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="content-block">
            <!-- About Me -->
			<div class="section-full content-inner-2 contact-box">
				<div class="container">
					<div class="section-head" style="margin-bottom: 0 !important">
						<div class="col-12 col-md-4" style="display: flex; align-items: center;">
							<div class="form-group mb-2 col-12 col-md-6">
								<label for="" class="control-label mb-1">Customer List</label>:&nbsp;&nbsp;
							</div>
			                <div class="form-group mb-2 col-12 col-md-6">
			                  <select name="customer_id" id="customer_id">
			                    <?php for($i = 0; $i < count($customer_list); $i++){ ?>
			                      <option value="<?= $customer_list[$i]['id']; ?>"><?= $customer_list[$i]['customer_name']; ?></option>
			                    <?php } ?>
			                  </select> 
			                </div>
			              </div>
						<!-- <h2 class="head-title">Product List</h2> -->
						<!-- <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8</p> -->
					</div>
					<div class="dzFormMsg_budget"></div>
					<div class="table-responsive">  
		                <table id='product_list' class='table table-bordered table-striped'>
		                  <thead>
		                    <tr>
		                        <th>No</th>
								<th>Nombre del proyecto</th>
								<th>Cliente</th>
								<th>Precio Muebles Cocina</th>
								<th>Otros costes</th>
								<th>Acciones</th>
		                    </tr>
		                  </thead>
		                  <tbody id="tbody">

		                  </tbody>
		                </table>
		            </div>
				</div>
			</div>
            <!-- About Me End -->
        </div>
		<!-- contact area END -->
    </div>
    <!-- Content END-->
<script src="<?= base_url(); ?>js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?= base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script><!-- WOW JS -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#product_list tbody').on('click', 'td a.btn-budget', function (){
			var id = $(this).attr('id');
			var h_id = $(this).attr('h_id');
			var customer_id = $('#customer_id').val();
			$.ajax({
				method: "POST",
				url: 'set_budget',
				data: {product_id: h_id, customer_id: customer_id},
				dataType: 'json',
			  success: function(dzRes) {
				if(dzRes){
					msgDiv = '<p style="color: #34A853">Calculating the budget...</p>';
					// $('#'+id).css("background", "green");
					// $('#'+id).css("color", "white");
					// $('#'+id).prop("disabled",true);
					// $('#'+id).val('Confirmed');
				}else{
					msgDiv = '<p style="color: #EA4335">Calculating is failed.</p>';
				}
				$('.dzFormMsg_budget').html(msgDiv);
				$('.dzFormMsg_budget').show();
				setInterval(function(){
					$('.dzFormMsg_budget').hide(1000);
				}, 4000);
				init_product_list();
			  }
			})

		});
		$('#product_list tbody').on('click', 'td a.btn-pdf', function (){
			var id = $(this).attr('id');
			var h_id = $(this).attr('h_id');
			$.ajax({
				method: "POST",
				url: 'gen_pdf',
				data: {product_id: h_id},
				dataType: 'json',
			  success: function(pdf_file) {
				if(pdf_file){
					// console.log('<?= base_url()?>'+pdf_file);
					window.open('<?= base_url() ?>'+pdf_file, '_blank');
				}
			  }
			})

		});
		$('#product_list tbody').on('click', 'td a.btn-confirm', function (){
			var id = $(this).attr('id');
			var h_id = $(this).attr('h_id');
			$.ajax({
				method: "POST",
				url: 'set_confirm',
				data: {product_id: h_id},
				dataType: 'json',
			  success: function(dzRes) {
				if(dzRes){
					msgDiv = '<p style="color: #34A853">This design confirmed successfully.</p>';
					$('#'+id).css("background", "green");
					$('#'+id).css("color", "white");
					$('#'+id).prop("disabled",true);
					$('#'+id).val('Confirmed');
				}else{
					msgDiv = '<p style="color: #EA4335">The design is failed.</p>';
				}
				$('.dzFormMsg_budget').html(msgDiv);
				$('.dzFormMsg_budget').show();
				setInterval(function(){
					$('.dzFormMsg_budget').hide(1000);
				}, 4000);
				init_product_list();
				window.location.href = "pos_order_list";
			  }
			})

		});
		init_product_list();
		function init_product_list(){
            $('#product_list').DataTable({
              'destroy': true,
              'processing': true,
              'serverSide': true,
              'pagingType': "simple",
              'serverMethod': 'post',
              'ajax': {
                  'url':'get_productlist',
                  // 'data': {pos_id: pos_id},
              },
              'columns': [
                 { data: 'no' },
                 { data: 'product_name' },
                 { data: 'customer'},
                 { data: 'furniture_cost' },
                 { data: 'other_cost' },
                 { data: 'action', className: "text-center" },
              ]
            });
        }
	});
</script>
