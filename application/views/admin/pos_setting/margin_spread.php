<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-3">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Tiendas Margen (%)</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="pos_margin" id="pos_margin">
                    </div>
                  </div>
                  <div class="col-12 col-md-3">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Tiendas Margen Fijo(EUR)</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="pos_spread" id="pos_spread">
                    </div>
                  </div>
                   <div class="col-12 col-md-3">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Tiendas Clientes Margen (%)</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="pos_customer_margin" id="pos_customer_margin">
                    </div>
                  </div>
                  <div class="col-12 col-md-3">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Tiendas Clientes Margen Fijo(EUR)</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="pos_customer_spread" id="pos_customer_spread">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-3 ">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Select the Tiendas</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="pos_id" id="pos_id">
                        <?php for($i = 0; $i < count($pos_arr); $i++){ ?>
                          <option value="<?= $pos_arr[$i]['pos_id']; ?>"><?= $pos_arr[$i]['pos_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-3">
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
                  <table id='margin_spread_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Tiendas Name</th>
                        <th>Tiendas Margen  (%)</th>
                        <th>Tiendas Margen Fijo (EUR)</th>
                        <th>Tiendas Clientes Margen  (%)</th>
                        <th>Tiendas Clientes Margen Fijo (EUR)</th>
                        <th>Acciones</th>
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
      <div class="modal fade" id="margin_spread_edit_modal" tabindex="-1" role="dialog" aria-labelledby="margin_spread_editLabel">
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="margin_spread_editLabel"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Tiendas Margen (%)</label>:
                    <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="edit_pos_margin" id="edit_pos_margin">
                  </div>
                </div>
                <div class="col-12 col-md-5">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Tiendas Margen Fijo(EUR)</label>:
                    <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="edit_pos_spread" id="edit_pos_spread">
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Tiendas Clientes Margen (%)</label>:
                    <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="edit_pos_customer_margin" id="edit_pos_customer_margin">
                  </div>
                </div>
                <div class="col-12 col-md-5">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Tiendas Clientes Margen Fijo(EUR)</label>:
                    <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="edit_pos_customer_spread" id="edit_pos_customer_spread">
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

    init_margin_spread_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
        var formData = new FormData(this);
        if($('#pos_margin').val() == '' && $('#pos_spread').val() == '' && $('#pos_customer_margin').val() == '' && $('#pos_customer_spread').val() == ''){
          toastr.warning("Please insert the value.");
        }else{
          $.ajax({
            url: '<?= site_url(); ?>admin/pos_setting/save_margin_spread',
            type: 'POST',
            data: formData,       
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
              var result = JSON.parse(response);
              if(!result.status){
                toastr.warning('Saving the data is failed.');
              }else{
                toastr.success('The data is saved successfully.');
                init_margin_spread_list();
                $('#pos_margin').val('');
                $('#pos_spread').val('');
                $('#pos_customer_margin').val('');
                $('#pos_customer_spread').val('');
              }
              
            }
          })
        }
    });

    $('#margin_spread_list tbody').on('click', 'td a.edit-row', function(){
      var pos_id = $(this).attr('id');  
      var pos_name = $(this).parent().parent().find("td:eq(0)").text();
      $('#edit_pos_id').val(pos_id);
      $('#edit_pos_margin').val($(this).parent().parent().find("td:eq(1)").text());
      $('#edit_pos_spread').val($(this).parent().parent().find("td:eq(2)").text());
      $('#edit_pos_customer_margin').val($(this).parent().parent().find("td:eq(3)").text());
      $('#edit_pos_customer_spread').val($(this).parent().parent().find("td:eq(4)").text());
      $('#margin_spread_editLabel').html('Edit - '+ pos_name);
    });

    $('#btn_update').click(function(){
      var edit_pos_margin = $('#edit_pos_margin').val();
      var edit_pos_spread = $('#edit_pos_spread').val();
      var edit_pos_customer_margin = $('#edit_pos_customer_margin').val();
      var edit_pos_customer_spread = $('#edit_pos_customer_spread').val();
      var edit_pos_id = $('#edit_pos_id').val();
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/update_margin_spread',
        type: 'POST',
        data: {edit_pos_id: edit_pos_id, edit_pos_margin: edit_pos_margin, edit_pos_spread: edit_pos_spread, edit_pos_customer_margin: edit_pos_customer_margin, edit_pos_customer_spread: edit_pos_customer_spread},
        success: function(response){
          var edit_status = JSON.parse(response);
          if(edit_status){
            toastr.success("Edited the row successfully.");
            init_margin_spread_list();
          }else{
            toastr.warning("Editing is failed.");
          }
        }
      })
    });

    function init_margin_spread_list(){
      $('#margin_spread_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/pos_setting/get_margin_spread_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'pos_name' },
           { data: 'pos_margin' },
           { data: 'pos_spread' },
           { data: 'pos_customer_margin' },
           { data: 'pos_customer_spread' },
           { data: 'action' }
        ]
      });
    }

  });
</script>