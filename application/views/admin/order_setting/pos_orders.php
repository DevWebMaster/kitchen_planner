<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>  
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="col-12 col-md-2 offset-1">
                <div class="form-group mb-2">
                  <label for="" class="control-label mb-1">Listado de Tiendas</label>:
                  <select class="form-control form-control-sm" tabindex="1" name="pos_id" id="pos_id">
                      <option value="0">All</option>
                    <?php for($i = 0; $i < count($pos_list); $i++){ ?>
                      <option value="<?= $pos_list[$i]['pos_id']; ?>"><?= $pos_list[$i]['pos_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <!-- <div class="col-12 col-md-1">
                <div class="form-group mt-4">
                  <input type="button" class="btn btn-sm btn-info filter px-4" value="Filter">
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>   
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
                        <th>Referencia Pedido</th>
                        <th>Nombre del proyecto</th>
                        <th>Cliente</th>
                        <th>Tiendas</th>
                        <th>Precio Muebles Cocina</th>
                        <th>Otros costes</th>
                        <th>Status</th>
                        <th>Acciones</th>  <!-- load design button,     -->
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
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var pos_id = $('#pos_id').val();
    init_order_list(pos_id);
    $('#pos_id').change(function(){
      pos_id = $('#pos_id').val();
      init_order_list(pos_id);
    })
    $('#order_list tbody').on('click', 'td a.btn-remove', function (){
      var id = $(this).attr('h_id')
      $.ajax({
        method: "POST",
        url:'remove_order',
        data: {id: id},
        dataType: 'json',
        success: function(response){
          if(response){
            toastr.success('Removed the selected order now.')
          }else{
            toastr.warning('Sorry, Removing the order is failed.');
          }
          init_order_list();
        }
      })

    })
    $('#order_list tbody').on('click', 'td a.btn-return', function (){
      var id = $(this).attr('h_id')
      $.ajax({
        method: "POST",
        url:'return_order',
        data: {id: id},
        dataType: 'json',
        success: function(response){
          if(response){
            toastr.success('Returned the selected order now.')
          }else{
            toastr.warning('Sorry, Returning the order is failed.');
          }
          init_order_list();
        }
      })

    })
    $('#order_list tbody').on('click', 'td a.btn-design', function (){
      var product_id = $(this).attr('h_id');
      $.ajax({
        method: "POST",
        url: 'load_design',
        data: {product_id: product_id},
        dataType: 'json',
        success: function(dzRes) {
          console.log(dzRes);
          // var response = JSON.parse(dzRes);
        if(dzRes){
          // window.location.href = "http://localhost:8080/?customer_id=<?=$this->session->userdata('user_id'); ?>";

          window.open('http://207.154.243.81:8081/?designpkitchen<?=$this->session->userdata('user_id'); ?>', '_blank');
        }else{
          toastr.warning('Loading is failed.');
          // msgDiv = '<p style="color: #EA4335">Failed to sending the EMAIL.</p>';
        }
        
        }
      })

    });
    function init_order_list(pos_id){
            $('#order_list').DataTable({
              'destroy': true,
              'processing': true,
              'serverSide': true,
              'pagingType': "simple",
              'serverMethod': 'post',
              'ajax': {
                  'url':'get_pos_orders',
                  'data': {pos_id: pos_id},
              },
              'columns': [
                 { data: 'no' },
                 { data: 'order_no'},
                 { data: 'product_name' },
                 { data: 'customer' },
                 { data: 'pos' },
                 { data: 'furniture_cost' },
                 { data: 'other_cost' },
                 { data: 'status' },
                 { data: 'action' },
              ]
            });
        }

  });
</script>