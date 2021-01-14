<div class="content-wrapper">
    <section class="content">
      <label><h3>Edit Main Menu</h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadForm">
                <input type="hidden" name="edit_main_menu_id" id="edit_main_menu_id" value="<?= $main_menu_id; ?>">
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="tracking_no" class="control-label mb-1">Menu Name</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_menu_name" id="edit_menu_name" value="<?= $main_menu_info['name']; ?>">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="tracking_no" class="control-label mb-1">Menu Image</label>:
                      <input type="file" name="edit_imageToUpload" id="edit_imageToUpload">
                      <input type="hidden" name="flag_image" id="flag_image" value="0">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mt-4">
                      <input type="submit" class="btn btn-sm btn-info add_label_no px-4" value="Update">
                      <a href="<?= site_url(); ?>admin/menu_setting/index" type="button" class="btn btn-sm btn-info px-4">Back</a>
                    </div>
                  </div>
                  
                </div>
                
              </form>
            </div>
          </div>
        </div>    
      </div><!--/ row --> 
        
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#edit_imageToUpload').click(function () {
      $('#flag_image').val(1);
    })
    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#edit_menu_name').val()){
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/update_main_menu_image',
          type: 'POST',
          data: formData,       
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
            var result = JSON.parse(response);
            console.log(result);
            if(!result.status){
              toastr.warning(result.message);
            }else{
              toastr.success(result.message);
            }
            
          }
        })
      }else{
        toastr.warning('Please select the image for the main menu.');
        return;
      }
      
    });

  });
</script>