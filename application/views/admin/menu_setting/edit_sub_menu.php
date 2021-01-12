<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadEditForm">
                <input type="hidden" id="sub_menu_id" value="<?= $sub_menu_id; ?>">
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Sub Menu Name</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_sub_menu_name" id="edit_edit_sub_menu_name" value="<?= $sub_menu_info['name']; ?>">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Parent Menu</label>:
                      <input class="form-control form-control-sm" tabindex="1" value="<?= $sub_menu_info['parent']; ?>" readonly>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Sub Menu Image</label>:
                      <input type="file" name="edit_imageToUpload" id="edit_imageToUpload">
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group mt-4">
                      <input type="submit" class="btn btn-sm btn-info px-5" value="Update">
                      <a href="<?= site_url(); ?>admin/menu_setting/sub_menu" type="button" class="btn btn-sm btn-info px-5">Back</a>
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

    $('#uploadEditForm').submit(function(e) {
      e.preventDefault();
      if($('#edit_imageToUpload').val()){
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/update_sub_menu_image',
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
              // window.location.href = "<?= site_url(); ?>admin/menu_setting/sub_menu";
            }
            
          }
        })
      }else{
        toastr.warning('Please select the image for the sub menu.');
        return;
      }
      
    });

  });
</script>