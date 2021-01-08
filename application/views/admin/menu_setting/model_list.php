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
                      <label for="" class="control-label mb-1">Model Name</label>:
                      <input type="text" class="form-control form-control-sm" name="model_name" id="model_name">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Model Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="model_type" id="model_type">
                        <?php for($i = 0; $i < count($model_type); $i++){ ?>
                          <option value="<?= $main_menu_ids[$i]['id']; ?>"><?= $model_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Main Menu</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="main_menu_id" id="main_menu_id">
                        <?php for($i = 0; $i < count($main_menu_ids); $i++){ ?>
                          <option value="<?= $main_menu_ids[$i]['id']; ?>"><?= $main_menu_ids[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Sub Menu</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="sub_menu_id" id="sub_menu_id">
                        <?php for($i = 0; $i < count($sub_menu_ids); $i++){ ?>
                          <option value="<?= $sub_menu_ids[$i]['id']; ?>"><?= $sub_menu_ids[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">CounterTop Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="countertop_type" id="countertop_type">
                        <?php for($i = 0; $i < count($countertop_type); $i++){ ?>
                          <option value="<?= $countertop_type[$i]['material_id']; ?>"><?= $countertop_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">CounterTop Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="countertop_color" id="countertop_color">
                        <?php for($i = 0; $i < count($countertop_color); $i++){ ?>
                          <option value="<?= $countertop_color[$i]['color_id']; ?>"><?= $countertop_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Exterio Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="exterio_color" id="exterio_color">
                        <?php for($i = 0; $i < count($exterio_color); $i++){ ?>
                          <option value="<?= $exterio_color[$i]['color_id']; ?>"><?= $exterio_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Interior Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="interior_color" id="interior_color">
                        <?php for($i = 0; $i < count($interior_color); $i++){ ?>
                          <option value="<?= $interior_color[$i]['color_id']; ?>"><?= $interior_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Skirting Color</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="skirting_color" id="skirting_color">
                        <?php for($i = 0; $i < count($skirting_color); $i++){ ?>
                          <option value="<?= $skirting_color[$i]['color_id']; ?>"><?= $skirting_color[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Skirting Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="skirting_type" id="skirting_type">
                        <?php for($i = 0; $i < count($skirting_type); $i++){ ?>
                          <option value="<?= $skirting_type[$i]['material_id']; ?>"><?= $skirting_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">DoorOpen Type</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="dooropen_type" id="dooropen_type">
                        <?php for($i = 0; $i < count($dooropen_type); $i++){ ?>
                          <option value="<?= $dooropen_type[$i]['style_id']; ?>"><?= $dooropen_type[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Door Thickness</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="door_thickness" id="door_thickness">
                        <?php for($i = 0; $i < count($door_thickness); $i++){ ?>
                          <option value="<?= $door_thickness[$i]['thickness_id']; ?>"><?= $door_thickness[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Furniture Cube</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="furniture_cube_id" id="furniture_cube_id">
                        <?php for($i = 0; $i < count($furniture_cube); $i++){ ?>
                          <option value="<?= $furniture_cube[$i]['cube_id']; ?>"><?= $furniture_cube[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">JS File</label>:
                      <input type="file" name="jsToUpload" id="jsToUpload">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Texture File</label>:
                      <input type="file" name="textureToUpload" id="textureToUpload">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Model Image</label>:
                      <input type="file" name="imageToUpload" id="imageToUpload">
                    </div>
                  </div>
                  <div class="col-12 col-md-1">
                    <div class="form-group mt-4">
                      <input type="submit" class="btn btn-sm btn-info add_label_no px-4" value="Add">
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
                <div class="col-md-12">
                  <div class="col-12 col-md-10 offset-md-1">
                    <div class="tab-content  br-n pn">
                      <div id="navpills-1" class="tab-pane active">
                        <div class="table-responsive">  
                          <table id='model_list' class='table table-bordered table-striped'>
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Model Type</th>
                                <th>Main Menu</th>
                                <th>Sub Menu</th>
                                <th>CounterTop Type</th>
                                <th>CounterTop Color</th>
                                <th>Exterio Color</th>
                                <th>Interior Color</th>
                                <th>Skirting Type</th>
                                <th>Skirting Color</th>
                                <th>DoorOpen Type</th>
                                <th>Door Thickness</th>
                                <th>Furniture Cube Type</th>
                                <!-- <th>Counterio Point</th> -->
                                <th>Image</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                        
                    </div>
                  </div><!-- col-12 -->
                </div><!-- row -->
            </div>
          </div>
        </div>
      </div>
        
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {

    $('#main_menu_id').change(function(){
      var main_id = $('#main_menu_id').val();
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
            $('#sub_menu_id').html(sub_html);
          }
      })
    });

    init_sub_menu_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#imageToUpload').val() && $('#textureToUpload').val() && $('#jsToUpload').val() && $('#model_name').val()){
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/upload_models',
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
              init_sub_menu_list();
            }
            
          }
        })
      }else{
        toastr.warning('Please select all fields correctly.');
        return;
      }
      
    });

    $('#model_list tbody').on('click', 'td a.delete-row', function(){
      var model_id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/menu_setting/delete_model_record',
        type: 'POST',
        data: {model_id: model_id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_sub_menu_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    function init_sub_menu_list(){
      $('#model_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/menu_setting/get_model_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'name' },
           { data: 'model_type' },
           { data: 'main_menu' },
           { data: 'sub_menu' },
           { data: 'countertop_type' },
           { data: 'countertop_color' },
           { data: 'exterio_color' },
           { data: 'interior_color' },
           { data: 'skirting_type' },
           { data: 'skirting_color' },
           { data: 'dooropen_type' },
           { data: 'door_thickness' },
           { data: 'cube_name' },
           // { data: 'counterio_point' },
           { data: 'image' },
           { data: 'action'},
        ]
      });
    }

  });
</script>