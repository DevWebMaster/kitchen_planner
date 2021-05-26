<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Tiendas Nombre</label>:
                      <input type="text" class="form-control form-control-sm" name="pos_name" id="pos_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Company Nombre</label>:
                      <input type="text" class="form-control form-control-sm" name="company_name" id="company_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Email</label>:
                      <input type="text" class="form-control form-control-sm" name="email" id="email">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">CIF</label>:
                      <input type="text" class="form-control form-control-sm" name="cif" id="cif">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Móvil Number</label>:
                      <input type="text" class="form-control form-control-sm" name="phone_num" id="phone_num">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Código Postal</label>:
                      <input type="text" class="form-control form-control-sm" name="zipcode" id="zipcode">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Address</label>:
                      <input type="text" class="form-control form-control-sm" name="address" id="address">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Position_lat</label>:
                      <input type="text" class="form-control form-control-sm" name="position_lat" id="position_lat">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Position_lon</label>:
                      <input type="text" class="form-control form-control-sm" name="position_lon" id="position_lon">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Descripción</label>:
                      <input type="text" class="form-control form-control-sm" name="description" id="description">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Contraseña</label>:
                      <input type="password" class="form-control form-control-sm" name="password" id="password">
                    </div>
                  </div>
                  <div class="col-12 col-md-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Plan Count</label>:
                      <input type="number" class="form-control form-control-sm" name="plan_count" id="plan_count">
                    </div>
                  </div>
                  <div class="col-12 col-md-1">
                    <div class="form-group mt-4">
                      <input type="submit" class="btn btn-sm btn-info add_label_no px-5" value="Add">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>    
      </div><!--/ row --> 
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="col-12 col-md-10 offset-md-1">
                <div class="table-responsive">  
                  <table id='pos_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Tiendas Nombre</th>
                        <th>Company Nombre</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>CIF</th>
                        <th>Móvil Number</th>
                        <th>Position_lat</th>
                        <th>Position_lon</th>
                        <th>Código Postal</th>
                        <th>Descripción</th>
                        <th>Plan Count</th>
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
      <div class="modal fade" id="edit_pos_modal" tabindex="-1" role="dialog" aria-labelledby="edit_pos_modalLabel">
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="edit_pos_modalLabel"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Tiendas Nombre</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_pos_name" id="edit_pos_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Company Nombre</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_company_name" id="edit_company_name">
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
                      <label for="" class="control-label mb-1">CIF</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_cif" id="edit_cif">
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
                      <label for="" class="control-label mb-1">Código Postal</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_zipcode" id="edit_zipcode">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Address</label>:
                      <input type="text" class="form-control form-control-sm" name="address" id="edit_address">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Descripción</label>:
                      <input type="text" class="form-control form-control-sm" name="description" id="edit_description">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Position_lat</label>:
                      <input type="text" class="form-control form-control-sm" name="position_lat" id="edit_position_lat">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Position_lon</label>:
                      <input type="text" class="form-control form-control-sm" name="position_lon" id="edit_position_lon">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Passward</label>:
                      <input type="password" class="form-control form-control-sm" name="edit_password" id="edit_password">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Plan Count</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_plan_count" id="edit_plan_count">
                    </div>
                  </div>
              </div>

          </div><!--/body -->
          <div class="modal-footer">
            <input type="hidden" id="edit_pos_id">
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

    init_pos_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#pos_name').val() != '' && $('#company_name').val() != '' && $('#email').val() != '' && $('#cif').val() != '' && $('#phone_num').val() != '' && $('#zipcode').val() != '' && $('#password').val() != '' && $('#address').val() != '' && $('#position_lat').val() != '' && $('#position_lon').val() != '' && $('#plan_count').val() != ''){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/pos_setting/save_pos',
          type: 'POST',
          data: formData,       
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
            var result = JSON.parse(response);
            if(!result.status){
              toastr.warning('Saving the pos is failed.');
            }else{
              toastr.success('The pos is saved successfully.');
              init_pos_list();
              $('#pos_name').val('');
              $('#company_name').val('');
              $('#email').val('');
              $('#cif').val('');
              $('#phone_num').val('');
              $('#direction').val('');
              $('#zipcode').val('');
              $('#password').val('');
              $('#address').val('');
              $('#description').val('');
              $('#position_lat').val('');
              $('#position_lon').val('');
              $('#plan_count').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#pos_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/delete_pos_record',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_pos_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    $('#pos_list tbody').on('click', 'td a.edit-row', function(){
      var json_data = JSON.parse($(this).attr('json_data'));

      var id = $(this).attr('id');  
      $('#edit_pos_modalLabel').html('Edit POS - '+id);
      $('#edit_pos_id').val(id);
      $('#edit_pos_name').val($(this).parent().parent().parent().find("td:eq(0)").text());
      $('#edit_company_name').val($(this).parent().parent().parent().find("td:eq(1)").text());
      $('#edit_email').val($(this).parent().parent().parent().find("td:eq(3)").text());
      $('#edit_cif').val($(this).parent().parent().parent().find("td:eq(4)").text());
      $('#edit_phone_num').val($(this).parent().parent().parent().find("td:eq(5)").text());
      $('#edit_zipcode').val($(this).parent().parent().parent().find("td:eq(8)").text());
      $('#edit_password').val(json_data['password']);
      $('#edit_address').val($(this).parent().parent().parent().find("td:eq(2)").text());
      $('#edit_position_lat').val($(this).parent().parent().parent().find("td:eq(6)").text());
      $('#edit_position_lon').val($(this).parent().parent().parent().find("td:eq(7)").text());
      $('#edit_description').val($(this).parent().parent().parent().find("td:eq(9)").text());
      $('#edit_plan_count').val($(this).parent().parent().parent().find("td:eq(10)").text());
    });

    $('#btn_update').click(function(){
      var edit_pos_name = $('#edit_pos_name').val();
      var edit_company_name = $('#edit_company_name').val();
      var edit_cif = $('#edit_cif').val();
      var edit_email = $('#edit_email').val();
      var edit_phone_num = $('#edit_phone_num').val();
      var edit_pos_location = $('#edit_pos_location').val();
      var edit_zipcode = $('#edit_zipcode').val();
      var edit_password = $('#edit_password').val();
      var edit_address = $('#edit_address').val();
      var edit_description = $('#edit_description').val();
      var edit_plan_count = $('#edit_plan_count').val();
      var edit_position_lat = $('#edit_position_lat').val();
      var edit_position_lon = $('#edit_position_lon').val();

      var edit_pos_id = $('#edit_pos_id').val();
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/edit_pos',
        type: 'POST',
        data: {edit_pos_id: edit_pos_id, edit_pos_name: edit_pos_name, edit_company_name: edit_company_name, edit_email: edit_email, edit_cif: edit_cif, edit_phone_num: edit_phone_num, edit_pos_location: edit_pos_location, edit_zipcode: edit_zipcode, edit_password: edit_password, edit_address: edit_address, edit_plan_count: edit_plan_count, edit_description: edit_description, edit_position_lat: edit_position_lat, edit_position_lon: edit_position_lon},
        success: function(response){
          var edit_status = JSON.parse(response);
          if(edit_status){
            toastr.success("Edited the row successfully.");
            init_pos_list();
          }else{
            toastr.warning("Editing is failed.");
          }
        }
      })
    });

    $('#pos_list tbody').on('click', 'td input.tgl_checkbox', function(){
      var selected_pos_id = $(this).attr('id');
      var b_flag = 0;
      if($('.tgl_checkbox').prop("checked")){
        b_flag = 1;
        set_block_pos(selected_pos_id, b_flag);
      }else{
        b_flag = 0;
        set_block_pos(selected_pos_id, b_flag);
      }
    });

    function init_pos_list(){
      $('#pos_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/pos_setting/get_pos_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'pos_name' },
           { data: 'company_name' },
           { data: 'address' },
           { data: 'email' },
           { data: 'CIF' },
           { data: 'phone_num' },
           { data: 'position_lat' },
           { data: 'position_lon' },
           { data: 'zipcode' },
           { data: 'description' },
           { data: 'plan_count'},
           { data: 'block' },
           { data: 'action', "width": "5%"},
        ]
      });
    }

    function set_block_pos(selected_pos_id, flag)
    {
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/set_block_pos',
        type: 'POST',
        data: {selected_pos_id: selected_pos_id, flag: flag},
        success: function(response){
          var status = JSON.parse(response);
          console.log(selected_pos_id);
          if(status == 1){
            toastr.success("Selected POS is blocked successfully.");
            init_pos_list();
          }else if(status == 0){
            toastr.success("Selected POS is unblocked successfully.");
          }
        }
      })
    }

  });
</script>