<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="col-12 col-md-10 offset-md-1">
                <div class="table-responsive">  
                  <table id='customer_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Customer Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Segundo Apellido</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <th>Transaction</th>
                        <th>Móvil Number</th>
                        <th>Dirección</th>
                        <th>Código Postal</th>
                        <th>LOPD</th>
                        <th>Block</th>
                        <th width="5%">Acciones</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--------  modal ----------> 
      <div class="modal fade" id="edit_customer_modal" tabindex="-1" role="dialog" aria-labelledby="edit_customer_modalLabel">
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="edit_customer_modalLabel"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Customer Nombre</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_customer_name" id="edit_customer_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Primer Apellido</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_last_name1" id="edit_last_name1">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Segundo Apellido</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_last_name2" id="edit_last_name2">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">DNI</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_dni" id="edit_dni">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Email</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_email" id="edit_email">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Transaction</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_transaction" id="edit_transaction">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Móvil Number</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_phone_num" id="edit_phone_num">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Dirección</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_direction" id="edit_direction">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Código Postal</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_zipcode" id="edit_zipcode">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">LOPD</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_lopd" id="edit_lopd">
                    </div>
                  </div>
              </div>

          </div><!--/body -->
          <div class="modal-footer">
            <input type="hidden" id="edit_customer_id">
            <button type="button" class="btn btn-info" id="btn_update" data-dismiss="modal">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div><!--/footer -->
      </div>
      </div>
      </div>
      <!---------modal---------->
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {

    init_customer_list();

    $('#customer_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/customer_setting/delete_customer_record',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_customer_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });
    $('#customer_list tbody').on('click', 'td a.edit-row', function(){
      // var json_data = JSON.parse($(this).attr('json_data'));

      var id = $(this).attr('id');  
      $('#edit_customer_modalLabel').html('Edit Customer - '+id);
      $('#edit_customer_id').val(id);
      $('#edit_customer_name').val($(this).parent().parent().parent().find("td:eq(0)").text());
      $('#edit_last_name1').val($(this).parent().parent().parent().find("td:eq(1)").text());
      $('#edit_last_name2').val($(this).parent().parent().parent().find("td:eq(2)").text());
      $('#edit_dni').val($(this).parent().parent().parent().find("td:eq(3)").text());
      $('#edit_email').val($(this).parent().parent().parent().find("td:eq(4)").text());
      $('#edit_transaction').val($(this).parent().parent().parent().find("td:eq(5)").text());
      $('#edit_phone_num').val($(this).parent().parent().parent().find("td:eq(6)").text());
      $('#edit_direction').val($(this).parent().parent().parent().find("td:eq(7)").text());
      $('#edit_zipcode').val($(this).parent().parent().parent().find("td:eq(8)").text());
      $('#edit_lopd').val($(this).parent().parent().parent().find("td:eq(9)").text());
    });

    $('#btn_update').click(function(){
      var edit_customer_name = $('#edit_customer_name').val();
      var edit_last_name1 = $('#edit_last_name1').val();
      var edit_last_name2 = $('#edit_last_name2').val();
      var edit_dni = $('#edit_dni').val();
      var edit_email = $('#edit_email').val();
      var edit_transaction = $('#edit_transaction').val();
      var edit_phone_num = $('#edit_phone_num').val();
      var edit_direction = $('#edit_direction').val();
      var edit_zipcode = $('#edit_zipcode').val();
      var edit_lopd = $('#edit_lopd').val();

      var edit_customer_id = $('#edit_customer_id').val();
      $.ajax({
        url: '<?= site_url(); ?>admin/customer_setting/edit_customer',
        type: 'POST',
        data: {edit_customer_id: edit_customer_id, edit_customer_name: edit_customer_name, edit_last_name1: edit_last_name1, edit_last_name2: edit_last_name2, edit_email: edit_email, edit_dni: edit_dni, edit_transaction: edit_transaction, edit_phone_num: edit_phone_num, edit_direction: edit_direction, edit_zipcode: edit_zipcode, edit_lopd: edit_lopd},
        success: function(response){
          var edit_status = JSON.parse(response);
          if(edit_status){
            toastr.success("Edited the row successfully.");
            init_customer_list();
          }else{
            toastr.warning("Editing is failed.");
          }
        }
      })
    });

    $('#customer_list tbody').on('click', 'td input.tgl_checkbox', function(){
      var selected_customer_id = $(this).attr('id');
      var b_flag = 0;
      if($('.tgl_checkbox').prop("checked")){
        b_flag = 1;
        set_block_customer(selected_customer_id, b_flag);
      }else{
        b_flag = 0;
        set_block_customer(selected_customer_id, b_flag);
      }
    });

    function init_customer_list(){
      $('#customer_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/customer_setting/get_customer_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'customer_name' },
           { data: 'last_name1' },
           { data: 'last_name2' },
           { data: 'DNI' },
           { data: 'email' },
           { data: 'transaction' },
           { data: 'phone_num' },
           { data: 'delivery_direction' },
           { data: 'zipcode' },
           { data: 'LOPD' },
           { data: 'block' },
           { data: 'action', "width": "5%"},
        ]
      });
    }

    function set_block_customer(selected_customer_id, flag)
    {
      $.ajax({
        url: '<?= site_url(); ?>admin/customer_setting/set_block_customer',
        type: 'POST',
        data: {selected_customer_id: selected_customer_id, flag: flag},
        success: function(response){
          var status = JSON.parse(response);
          console.log(selected_customer_id);
          if(status == 1){
            toastr.success("Selected Customer is blocked successfully.");
            init_customer_list();
          }else if(status == 0){
            toastr.success("Selected Customer is unblocked successfully.");
          }
        }
      })
    }

  });
</script>