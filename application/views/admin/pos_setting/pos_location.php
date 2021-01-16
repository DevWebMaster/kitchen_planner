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
                      <label for="" class="control-label mb-1">Location Name</label>:
                      <input type="text" class="form-control form-control-sm" name="location_name" id="location_name">
                    </div>
                  </div>
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
                      <label for="" class="control-label mb-1">Description</label>:
                      <input type="text" class="form-control form-control-sm" name="description" id="description">
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
                  <table id='pos_location_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Position_lat</th>
                        <th>Position_lon</th>
                        <th>Description</th>
                        <th width="10%">Action</th>
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
      <div class="modal fade" id="edit_pos_location_modal" tabindex="-1" role="dialog" aria-labelledby="edit_pos_location_modalLabel">
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="edit_pos_location_modalLabel"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Location Name</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_location_name" id="edit_location_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Address</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_address" id="edit_address">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Position_lat</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_position_lat" id="edit_position_lat">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Position_lon</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_position_lon" id="edit_position_lon">
                    </div>
                  </div>
                  <br>
                  <div class="col-12 col-md-6">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Description</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_description" id="edit_description">
                    </div>
                  </div>
              </div>

          </div><!--/body -->
          <div class="modal-footer">
            <input type="hidden" id="edit_pos_location_id">
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

    init_pos_location_list();
    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#location_name').val() && $('#address').val() && $('#position_lat').val() && $('#position_lon').val() && $('#description').val()){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/pos_setting/save_pos_location',
          type: 'POST',
          data: formData,       
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
            var result = JSON.parse(response);
            if(!result.status){
              toastr.warning('Saving the pos location is failed.');
            }else{
              toastr.success('The pos location is saved successfully.');
              init_pos_location_list();
              $('#location_name').val('');
              $('#address').val('');
              $('#position_lon').val('');
              $('#position_lat').val('');
              $('#description').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#pos_location_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/delete_pos_location_record',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_pos_location_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });
    $('#pos_location_list tbody').on('click', 'td a.edit-row', function(){
      var id = $(this).attr('id');  
      $('#edit_pos_location_modalLabel').html('Edit POS Location - '+id);
      $('#edit_pos_location_id').val(id);
      $('#edit_location_name').val($(this).parent().parent().parent().find("td:eq(1)").text());
      $('#edit_address').val($(this).parent().parent().parent().find("td:eq(2)").text());
      $('#edit_position_lat').val($(this).parent().parent().parent().find("td:eq(3)").text());
      $('#edit_position_lon').val($(this).parent().parent().parent().find("td:eq(4)").text());
      $('#edit_description').val($(this).parent().parent().parent().find("td:eq(5)").text());
    });

    $('#btn_update').click(function(){
      var edit_location_name = $('#edit_location_name').val();
      var edit_address = $('#edit_address').val();
      var edit_position_lat = $('#edit_position_lat').val();
      var edit_position_lon = $('#edit_position_lon').val();
      var edit_description = $('#edit_description').val();

      var pos_location_id = $('#edit_pos_location_id').val();
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/edit_pos_location',
        type: 'POST',
        data: {pos_location_id: pos_location_id, edit_location_name: edit_location_name, edit_address: edit_address, edit_position_lat: edit_position_lat, edit_position_lon: edit_position_lon, edit_description: edit_description},
        success: function(response){
          var edit_status = JSON.parse(response);
          if(edit_status){
            toastr.success("Edited the row successfully.");
            init_pos_location_list();
          }else{
            toastr.warning("Editing is failed.");
          }
        }
      })
    });

    function init_pos_location_list(){
      $('#pos_location_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/pos_setting/get_pos_location',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'id' },
           { data: 'name' },
           { data: 'address' },
           { data: 'position_lat' },
           { data: 'position_lon' },
           { data: 'description' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>