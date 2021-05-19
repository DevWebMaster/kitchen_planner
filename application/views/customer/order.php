    <!-- Content -->
    <div class="page-content bg-white">
		<!-- inner page banner -->
   		<!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle bg-pt" style="background-image:url(<?= base_url(); ?>images/banner/bnr2.jpg);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Order List</h1>
                </div>
            </div>
        </div>
        <!-- inner page banner END -->
        <div class="content-block">
            <!-- About Me -->
			<div class="section-full content-inner-2 contact-box">
				<div class="container">
					<div class="section-head" style="margin-bottom: 0 !important">						
						<!-- <h2 class="head-title">Product List</h2> -->
						<!-- <p>Meh synth Schlitz, tempor duis single-origin coffee ea next level ethnic fingerstache fanny pack nostrud. Photo booth anim 8</p> -->
					</div>
					<div class="dzFormMsg_order"></div>
					<div class="table-responsive">  
		                <table id='order_list' class='table table-bordered table-striped'>
		                  <thead>
		                    <tr>
		                        <th>No</th>
								<th>Order ID</th>
								<th>Product Name</th>
								<th>Furniture Cost</th>
								<th>Other Cost</th>
								<th>Status</th>
								<th>Action</th>  <!-- load design button,     -->
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
		<!--------  modal ---------->	
		<div class="modal fade" id="ordermodal" tabindex="-1" role="dialog" aria-labelledby="ordermodalLabel">
		<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
		    <div class="modal-header">
		        <h4 class="modal-title" id="ordermodalLabel"></h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>
		    <div class="modal-body">
		     	<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
					      		<input type="hidden" id="m_id">
					      		<input type="hidden" id="m_order_no">
					      		<h3><label>Are you sure to confirm it?</label></h3>
				      		</div>
				    	</div>
				    </div>		
				</div><!--/ row -->	

		    </div><!--/body -->
		    <div class="modal-footer">
		    	<button type="button" class="btn btn-default" id="btn_confirm" data-dismiss="modal">Confirm</button>
			    <button type="button" class="btn btn-default" id="btn_close" data-dismiss="modal">Close</button>
		    </div><!--/footer -->
		</div>
		</div>
		</div>
		<!---------modal---------->
    </div>
    <!-- Content END-->
<script src="<?= base_url(); ?>js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="<?= base_url(); ?>plugins/datatables/jquery.dataTables.min.js"></script><!-- WOW JS -->
<script type="text/javascript">
	$(document).ready(function(){

		$('#order_list tbody').on('click', 'td a.btn-order', function (){
			var order_id = $(this).attr('h_id');
			var order_no = $(this).parent().parent().parent().find("td:eq(1)").text();
			$('#m_id').val(order_id);
			$('#m_order_no').val(order_no);
			$('#ordermodalLabel').html('Order ID - '+order_no);
		});
		$('#btn_confirm').click(function(){
			var id = $('#m_id').val();
			var order_no = $('#m_order_no').val();
			$.ajax({
				method: "POST",
				url: 'set_order',
				data: {id: id, order_no: order_no},
				dataType: 'json',
			  success: function(dzRes) {
				if(dzRes){
					msgDiv = '<p style="color: #34A853">The order confirmed successfully.</p>';
					$('#'+id).css("background", "green");
					$('#'+id).css("color", "white");
					$('#'+id).prop("disabled",true);
					$('#'+id).val('Ordered');
				}else{
					msgDiv = '<p style="color: #EA4335">The order is failed.</p>';
				}
				$('.dzFormMsg_order').html(msgDiv);
				$('.dzFormMsg_order').show();
				setInterval(function(){
					$('.dzFormMsg_order').hide(1000);
				}, 4000);
				init_order_list();
				// window.open('https://odoo.com', '_blank');
			  }
			})
		});
		
		// $('#order_list tbody').on('click', 'td a.btn-design', function (){
		// 	var product_id = $(this).attr('h_id');
		// 	$.ajax({
		// 		method: "POST",
		// 		url: 'load_design',
		// 		data: {product_id: product_id},
		// 		dataType: 'json',
		// 	  success: function(dzRes) {
		// 	  	// var response = JSON.parse(dzRes);
		// 		if(dzRes){
		// 			window.location.href = "http://localhost:8080/?customer_id=<?=$this->session->userdata('user_id'); ?>";

		// 		}else{
		// 			toastr.warning('Loading is failed.');
		// 			// msgDiv = '<p style="color: #EA4335">Failed to sending the EMAIL.</p>';
		// 		}
				
		// 	  }
		// 	})

		// });
		init_order_list();
		function init_order_list(){
            $('#order_list').DataTable({
              'destroy': true,
              'processing': true,
              'serverSide': true,
              'pagingType': "simple",
              'serverMethod': 'post',
              'ajax': {
                  'url':'get_orderlist',
                  // 'data': {pos_id: pos_id},
              },
              'columns': [
                 { data: 'no' },
                 { data: 'order_no'},
                 { data: 'product_name' },
                 { data: 'furniture_cost' },
                 { data: 'other_cost' },
                 { data: 'status' },
                 { data: 'action', className: "text-center" },
              ]
            });
        }
	});
</script>
