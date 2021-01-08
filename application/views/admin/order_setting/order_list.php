<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>        
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="col-12 col-md-10 offset-md-1">
                <div class="table-responsive">  
                  <table id='order_list' class='table table-bordered table-striped'>
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Customer</th>
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
          </div>
        </div>
      </div>
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
                      <input type="hidden" id="m_order_no">
                      <h3><label>Are you sure to confirm it?</label></h3>
                    </div>
                </div>
              </div>    
          </div><!--/ row --> 

          </div><!--/body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-info" id="btn_confirm" data-dismiss="modal">Confirm</button>
            <button type="button" class="btn btn-default" id="btn_close" data-dismiss="modal">Close</button>
          </div><!--/footer -->
      </div>
      </div>
      </div>
      <!---------modal---------->
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {

    $('#order_list tbody').on('click', 'td a.btn-confirm', function (){
      // var order_id = $(this).attr('h_id');
      var order_no = $(this).parent().parent().find("td:eq(1)").text();
      $('#m_order_no').val(order_no);
      $('#ordermodalLabel').html('Order ID - '+order_no);
    });
    $('#btn_confirm').click(function(){
      var id = $('#m_id').val();
      var order_no = $('#m_order_no').val();
      $.ajax({
        method: "POST",
        url: 'set_order_confirm_pos',
        data: {order_no: order_no},
        dataType: 'json',
        success: function(dzRes) {
        if(dzRes){
          msgDiv = '<p style="color: #34A853">It is confirmed successfully.</p>';
          // $('#'+id).css("background", "green");
          // $('#'+id).css("color", "white");
          // $('#'+id).prop("disabled",true);
          // $('#'+id).val('Ordered');
        }else{
          msgDiv = '<p style="color: #EA4335">The confirm is failed.</p>';
        }
        $('.dzFormMsg_confirm').html(msgDiv);
        $('.dzFormMsg_confirm').show();
        setInterval(function(){
          $('.dzFormMsg_confirm').hide(1000);
        }, 4000);
        init_order_list();
        window.open('https://odoo.com', '_blank');
        }
      })
    });
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
                 { data: 'customer' },
                 { data: 'furniture_cost' },
                 { data: 'other_cost' },
                 { data: 'status' },
                 { data: 'action' },
              ]
            });
        }

  });
</script>