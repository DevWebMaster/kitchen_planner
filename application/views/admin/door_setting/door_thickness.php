<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Grosores</label>:
                      <input type="text" class="form-control form-control-sm" name="door_thickness_name" id="door_thickness_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Precios</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="price" id="price">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
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
                  <table id='door_thickness_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Grosores</th>
                        <th>Precios</th>
                        <th width="10%">Acciones</th>
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
      <div class="modal fade" id="thickness_edit_modal" tabindex="-1" role="dialog" aria-labelledby="thickness_editLabel">
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="thickness_editLabel"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Grosores</label>:
                    <input type="text" class="form-control form-control-sm" name="edit_style_name" id="edit_thickness_name">
                  </div>
                </div>
                <div class="col-12 col-md-5">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Precios</label>:
                    <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="edit_price" id="edit_price">
                  </div>
                </div>
              </div>

          </div><!--/body -->
          <div class="modal-footer">
            <input type="hidden" id="edit_thickness_id">
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

    init_door_thickness_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#door_thickness_name').val() && $('#price').val()){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/door_setting/save_door_thickness',
          type: 'POST',
          data: formData,       
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
            var result = JSON.parse(response);
            console.log(result);
            if(!result.status){
              toastr.warning('Saving the data is failed.');
            }else{
              toastr.success('The data is saved successfully.');
              init_door_thickness_list();
              $('#door_thickness_name').val('');
              $('#price').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#door_thickness_list tbody').on('click', 'td a.delete-row', function(){
      var thickness_id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/door_setting/delete_door_thickness_record',
        type: 'POST',
        data: {thickness_id: thickness_id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_door_thickness_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    $('#door_thickness_list tbody').on('click', 'td a.edit-row', function(){
      var thickness_id = $(this).attr('id');  
      $('#thickness_editLabel').html('Edit - '+thickness_id);
      $('#edit_thickness_id').val(thickness_id);
      $('#edit_thickness_name').val($(this).parent().parent().find("td:eq(0)").text());
      $('#edit_price').val($(this).parent().parent().find("td:eq(1)").text());
    });

    $('#btn_update').click(function(){
      var edit_thickness_name = $('#edit_thickness_name').val();
      var edit_price = $('#edit_price').val();
      var thickness_id = $('#edit_thickness_id').val();
      $.ajax({
        url: '<?= site_url(); ?>admin/door_setting/edit_door_thickness_record',
        type: 'POST',
        data: {thickness_id: thickness_id, edit_thickness_name: edit_thickness_name, edit_price: edit_price},
        success: function(response){
          var edit_status = JSON.parse(response);
          if(edit_status){
            toastr.success("Edited the row successfully.");
            init_door_thickness_list();
          }else{
            toastr.warning("Editing is failed.");
          }
        }
      })
    });

    function init_door_thickness_list(){
      $('#door_thickness_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/door_setting/get_door_thickness_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'name' },
           { data: 'price' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>