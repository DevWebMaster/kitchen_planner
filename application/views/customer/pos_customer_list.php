    <!-- Content -->
    <div class="page-content bg-white">
		<!-- inner page banner -->
        <div class="dlab-bnr-inr dlab-bnr-inr-sm overlay-black-middle bg-pt" style="background-image:url(<?= base_url(); ?>images/banner/bnr3.jpg);">
            <div class="container">
                <div class="dlab-bnr-inr-entry">
                    <h1 class="text-white">Customer List</h1>
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
					<!-- <div class="dzFormMsg_budget"></div> -->
					<div class="table-responsive">  
		                <table id='customer_list' class='table table-bordered table-striped'>
		                  <thead>
		                    <tr>
		                        <th>No</th>
            								<th>Customer Name</th>
            								<th>Phone Number</th>
            								<th>Delivery Direction</th>
            								<th>Status</th>
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
		init_customer_list();
		function init_customer_list(){
            $('#customer_list').DataTable({
              'destroy': true,
              'processing': true,
              'serverSide': true,
              'pagingType': "simple",
              'serverMethod': 'post',
              'ajax': {
                  'url':'get_pos_customer_list',
                  // 'data': {pos_id: pos_id},
              },
              'columns': [
                 { data: 'no' },
                 { data: 'customer_name' },
                 { data: 'phone_num' },
                 { data: 'delivery_direction' },
                 { data: 'status' },
              ]
            });
        }
	});
</script>
