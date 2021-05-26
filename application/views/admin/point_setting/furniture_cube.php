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
                      <input type="text" class="form-control form-control-sm" name="furniture_cube_name" id="furniture_cube_name">
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
                  <table id='furniture_cube_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Nombre del Cubo de precios</th>
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
      
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {

    init_furniture_cube_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#furniture_cube_name').val()){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/point_setting/save_furniture_cube',
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
              init_furniture_cube_list();
              $('#furniture_cube_name').val('');
              $('#price').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#furniture_cube_list tbody').on('click', 'td a.delete-row', function(){
      var furniture_cube_id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/point_setting/delete_furniture_cube_record',
        type: 'POST',
        data: {furniture_cube_id: furniture_cube_id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_furniture_cube_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    
    function init_furniture_cube_list(){
      $('#furniture_cube_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/point_setting/get_furniture_cube_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'name' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>