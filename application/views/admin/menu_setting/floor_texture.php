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
                      <label for="tracking_no" class="control-label mb-1">Floor Texture</label>:
                      <input type="text" class="form-control form-control-sm" name="floor_texture_name" id="floor_texture_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="tracking_no" class="control-label mb-1">Floor Image</label>:
                      <input type="file" name="imageToUpload" id="imageToUpload">
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
                  <table id='floor_texture_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Floor Texture</th>
                        <th>Image</th>
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
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {

    init_floor_texture_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#floor_texture_name').val() && $('#price').val()){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/save_floor_texture',
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
              init_floor_texture_list();
              $('#floor_texture_name').val('');
              $('#price').val('');
              $('#imageToUpload').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#floor_texture_list tbody').on('click', 'td a.delete-row', function(){
      var floor_texture_id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/menu_setting/delete_floor_texture_record',
        type: 'POST',
        data: {floor_texture_id: floor_texture_id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_floor_texture_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });


    function init_floor_texture_list(){
      $('#floor_texture_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/menu_setting/get_floor_texture',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'name' },
           { data: 'image' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>