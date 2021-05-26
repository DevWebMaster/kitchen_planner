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
                      <label for="" class="control-label mb-1">Nombre del Cubo de precios</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="furniture_cube_id" id="furniture_cube_id">
                        <?php for($i = 0; $i < count($furniture_cube); $i++){ ?>
                          <option value="<?= $furniture_cube[$i]['cube_id']; ?>"><?= $furniture_cube[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Model Width</label>:
                      <input type="number" class="form-control form-control-sm" name="model_width" id="model_width">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Model Length</label>:
                      <input type="number" class="form-control form-control-sm" name="model_length" id="model_length">
                    </div>
                  </div>
                  <div class="col-12 col-md-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">1 Star</label>:
                      <input type="number" class="form-control form-control-sm" name="level1" id="level1">
                    </div>
                  </div>
                  <div class="col-12 col-md-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">3 Stars</label>:
                      <input type="number" class="form-control form-control-sm" name="level2" id="level2">
                    </div>
                  </div>
                  <div class="col-12 col-md-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">5 Stars</label>:
                      <input type="number" class="form-control form-control-sm" name="level3" id="level3">
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
                  <table id='model_point_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Cube Type</th>
                        <th>Model Width(cm)</th>
                        <th>Model Length(cm)</th>
                        <th>1 Star(points)</th>
                        <th>3 Stars(points)</th>
                        <th>5 Stars(points)</th>
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
      <div class="modal fade" id="model_point_edit_modal" tabindex="-1" role="dialog" aria-labelledby="model_point_editLabel">
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="model_point_editLabel"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Model Width</label>:
                    <input type="text" class="form-control form-control-sm" name="edit_model_width" id="edit_model_width">
                  </div>
                </div>
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Model Length</label>:
                    <input type="text" class="form-control form-control-sm" name="edit_model_length" id="edit_model_length">
                  </div>
                </div>
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">1 Star</label>:
                    <input type="text" class="form-control form-control-sm" name="edit_level1" id="edit_level1">
                  </div>
                </div>
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">3 Stars</label>:
                    <input type="text" class="form-control form-control-sm" name="edit_level2" id="edit_level2">
                  </div>
                </div>
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">5 Stars</label>:
                    <input type="text" class="form-control form-control-sm" name="edit_level3" id="edit_level3">
                  </div>
                </div>
              </div>

          </div><!--/body -->
          <div class="modal-footer">
            <input type="hidden" id="edit_model_point_id">
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
    var furniture_cube_id = $('#furniture_cube_id').val();
    init_model_point_list(furniture_cube_id);

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#model_width').val() && $('#model_length').val() && $('#level1').val() && $('#level2').val() && $('#level3').val()){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/point_setting/save_model_point',
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
              init_model_point_list(furniture_cube_id);
              $('#model_width').val('');
              $('#model_length').val('');
              $('#level1').val('');
              $('#level2').val('');
              $('#level3').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#model_point_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/point_setting/delete_model_point',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_model_point_list(furniture_cube_id);
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    $('#model_point_list tbody').on('click', 'td a.edit-row', function(){
      var id = $(this).attr('id');  
      $('#model_point_editLabel').html('Edit - '+id);
      $('#edit_model_point_id').val(id);
      $('#edit_model_width').val($(this).parent().parent().find("td:eq(0)").text());
      $('#edit_model_length').val($(this).parent().parent().find("td:eq(1)").text());
      $('#edit_level1').val($(this).parent().parent().find("td:eq(2)").text());
      $('#edit_level2').val($(this).parent().parent().find("td:eq(3)").text());
      $('#edit_level3').val($(this).parent().parent().find("td:eq(4)").text());
    });

    $('#btn_update').click(function(){
      var edit_model_width = $('#edit_model_width').val();
      var edit_model_length = $('#edit_model_length').val();
      var edit_level1 = $('#edit_level1').val();
      var edit_level2 = $('#edit_level2').val();
      var edit_level3 = $('#edit_level3').val();
      var model_point_id = $('#edit_model_point_id').val();
      $.ajax({
        url: '<?= site_url(); ?>admin/point_setting/edit_model_point',
        type: 'POST',
        data: {model_point_id: model_point_id, edit_model_width: edit_model_width, edit_model_length: edit_model_length, edit_level1: edit_level1, edit_level2: edit_level2, edit_level3: edit_level3},
        success: function(response){
          var edit_status = JSON.parse(response);
          if(edit_status){
            toastr.success("Edited the row successfully.");
            init_model_point_list();
          }else{
            toastr.warning("Editing is failed.");
          }
        }
      })
    });

    $('#furniture_cube_id').change(function(){
      var cube_id = $('#furniture_cube_id').val();
      init_model_point_list(cube_id);
    })

    function init_model_point_list(furniture_cube_id){
      $('#model_point_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/point_setting/get_model_point_list',
            'data': {furniture_cube_id: furniture_cube_id},
        },
        'columns': [
           { data: 'cube_type'},
           { data: 'model_width' },
           { data: 'model_length' },
           { data: 'level1' },
           { data: 'level2' },
           { data: 'level3' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>