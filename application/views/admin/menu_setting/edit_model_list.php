<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadForm">
                <input type="hidden" name="edit_model_id" id="edit_model_id" value="<?= $model_id; ?>">
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Model Name</label>:
                      <input type="text" class="form-control form-control-sm" name="edit_model_name" id="edit_model_name" value="<?= $model_info['name']; ?>">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_model_type" id="h_model_type" value="<?= $model_info['type']; ?>">
                      <label for="" class="control-label mb-1">Model Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_model_type" id="edit_model_type">
                        <?php for($i = 0; $i < count($model_type); $i++){ ?>
                          <option value="<?= $main_menu_ids[$i]['id']; ?>"><?= $model_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_main_menu_id" id="h_main_menu_id" value="<?= $model_info['main_id']; ?>">
                      <label for="" class="control-label mb-1">Main Menu</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_main_menu_id" id="edit_main_menu_id">
                        <?php for($i = 0; $i < count($main_menu_ids); $i++){ ?>
                          <option value="<?= $main_menu_ids[$i]['id']; ?>"><?= $main_menu_ids[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_sub_menu_id" id="h_sub_menu_id" value="<?= $model_info['sub_id']; ?>">
                      <label for="" class="control-label mb-1">Sub Menu</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_sub_menu_id" id="edit_sub_menu_id">
                        <?php for($i = 0; $i < count($sub_menu_ids); $i++){ ?>
                          <option value="<?= $sub_menu_ids[$i]['id']; ?>"><?= $sub_menu_ids[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_countertop_type" id="h_countertop_type" value="<?= $model_info['countertop_type']; ?>">
                      <label for="" class="control-label mb-1">CounterTop Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_countertop_type" id="edit_countertop_type">
                        <?php for($i = 0; $i < count($countertop_type); $i++){ ?>
                          <option value="<?= $countertop_type[$i]['material_id']; ?>"><?= $countertop_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_countertop_color" id="h_countertop_color" value="<?= $model_info['countertop_color']; ?>">
                      <label for="" class="control-label mb-1">CounterTop Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_countertop_color" id="edit_countertop_color">
                        <?php for($i = 0; $i < count($countertop_color); $i++){ ?>
                          <option value="<?= $countertop_color[$i]['color_id']; ?>"><?= $countertop_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_exterio_color" id="h_exterio_color" value="<?= $model_info['exterio_color']; ?>">
                      <label for="" class="control-label mb-1">Exterio Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_exterio_color" id="edit_exterio_color">
                        <?php for($i = 0; $i < count($exterio_color); $i++){ ?>
                          <option value="<?= $exterio_color[$i]['color_id']; ?>"><?= $exterio_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_interior_color" id="h_interior_color" value="<?= $model_info['interior_color']; ?>">
                      <label for="" class="control-label mb-1">Interior Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_interior_color" id="edit_interior_color">
                        <?php for($i = 0; $i < count($interior_color); $i++){ ?>
                          <option value="<?= $interior_color[$i]['color_id']; ?>"><?= $interior_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_skirting_color" id="h_skirting_color" value="<?= $model_info['skirting_color']; ?>">
                      <label for="" class="control-label mb-1">Skirting Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_skirting_color" id="edit_skirting_color">
                        <?php for($i = 0; $i < count($skirting_color); $i++){ ?>
                          <option value="<?= $skirting_color[$i]['color_id']; ?>"><?= $skirting_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_skirting_type" id="h_skirting_type" value="<?= $model_info['skirting_type']; ?>">
                      <label for="" class="control-label mb-1">Skirting Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_skirting_type" id="edit_skirting_type">
                        <?php for($i = 0; $i < count($skirting_type); $i++){ ?>
                          <option value="<?= $skirting_type[$i]['material_id']; ?>"><?= $skirting_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_dooropen_type" id="h_dooropen_type" value="<?= $model_info['dooropen_type']; ?>">
                      <label for="" class="control-label mb-1">DoorOpen Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_dooropen_type" id="edit_dooropen_type">
                        <?php for($i = 0; $i < count($dooropen_type); $i++){ ?>
                          <option value="<?= $dooropen_type[$i]['style_id']; ?>"><?= $dooropen_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_door_thickness" id="h_door_thickness" value="<?= $model_info['door_thickness']; ?>">
                      <label for="" class="control-label mb-1">Door Thickness</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_door_thickness" id="edit_door_thickness">
                        <?php for($i = 0; $i < count($door_thickness); $i++){ ?>
                          <option value="<?= $door_thickness[$i]['thickness_id']; ?>"><?= $door_thickness[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <input type="hidden" name="h_furniture_cube_id" id="h_furniture_cube_id" value="<?= $model_info['cube_id']; ?>">
                      <label for="" class="control-label mb-1">Furniture Cube</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="edit_furniture_cube_id" id="edit_furniture_cube_id">
                        <?php for($i = 0; $i < count($furniture_cube); $i++){ ?>
                          <option value="<?= $furniture_cube[$i]['cube_id']; ?>"><?= $furniture_cube[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">JS File</label>:
                      <input type="file" name="edit_jsToUpload" id="edit_jsToUpload">
                      <input type="hidden" name="flag_js" id="flag_js" value="0">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Texture File</label>:
                      <input type="file" name="edit_textureToUpload" id="edit_textureToUpload">
                      <input type="hidden" name="flag_texturefile" id="flag_texturefile" value="0">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Model Image</label>:
                      <input type="file" name="edit_imageToUpload" id="edit_imageToUpload">
                      <input type="hidden" name="flag_image" id="flag_image" value="0">
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group mt-4">
                      <input type="submit" class="btn btn-sm btn-info add_label_no px-4" value="Update">
                      <a href="<?= site_url(); ?>admin/menu_setting/model_list" type="button" class="btn btn-sm btn-info px-4">Back</a>
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
    $("#edit_model_type option[value='"+$('#h_model_type').val()+"']").prop('selected', true);
    $("#edit_main_menu_id option[value='"+$('#h_main_menu_id').val()+"']").prop('selected', true);
    $("#edit_sub_menu_id option[value='"+$('#h_sub_menu_id').val()+"']").prop('selected', true);
    $("#edit_countertop_type option[value='"+$('#h_countertop_type').val()+"']").prop('selected', true);
    $("#edit_countertop_color option[value='"+$('#h_countertop_color').val()+"']").prop('selected', true);
    $("#edit_exterio_color option[value='"+$('#h_exterio_color').val()+"']").prop('selected', true);
    $("#edit_interior_color option[value='"+$('#h_interior_color').val()+"']").prop('selected', true);
    $("#edit_skirting_color option[value='"+$('#h_skirting_color').val()+"']").prop('selected', true);
    $("#edit_skirting_type option[value='"+$('#h_skirting_type').val()+"']").prop('selected', true);
    $("#edit_dooropen_type option[value='"+$('#h_dooropen_type').val()+"']").prop('selected', true);
    $("#edit_door_thickness option[value='"+$('#h_door_thickness').val()+"']").prop('selected', true);
    $("#edit_furniture_cube_id option[value='"+$('#h_furniture_cube_id').val()+"']").prop('selected', true);

    $('#edit_imageToUpload').click(function () {
      $('#flag_image').val(1);
    })
    $('#edit_textureToUpload').click(function () {
      $('#flag_texturefile').val(1);
    })
    $('#edit_jsToUpload').click(function () {
      $('#flag_js').val(1);
    })
    $('#edit_main_menu_id').change(function(){
      var main_id = $('#edit_main_menu_id').val();
      $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/get_sub_menu_ids',
          type: 'POST',
          data: {main_id: main_id},
          success: function(response){
            var result = JSON.parse(response);
            var sub_html = '';
            for(var i = 0; i < result.length; i++){
              sub_html += '<option value="'+result[i].id+'">'+result[i].name+'</option>';
            }
            $('#edit_sub_menu_id').html(sub_html);
          }
      })
    });


    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#edit_model_name').val()){
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/update_models',
          type: 'POST',
          data: formData,       
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
            var result = JSON.parse(response);
            console.log(result);
            if(!result.status){
              for(var i = 0; i < result.message.length; i++){
                toastr.warning(result.message[i]);
              }
              
            }else{
              for(var i = 0; i < result.message.length; i++){
                toastr.success(result.message[i]);
              }
            }
            
          }
        })
      }else{
        toastr.warning('Please select all fields correctly.');
        return;
      }
      
    });

  });
</script>