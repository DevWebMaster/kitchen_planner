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
                      <label for="" class="control-label mb-1">Sub Menu Name</label>:
                      <input type="text" class="form-control form-control-sm" name="sub_menu_name" id="sub_menu_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Parent Menu</label>:
                      <select class="form-control form-control-sm" tabindex="1" name="main_menu_id" id="main_menu_id">
                        <?php for($i = 0; $i < count($main_menu_ids); $i++){ ?>
                          <option value="<?= $main_menu_ids[$i]['id']; ?>"><?= $main_menu_ids[$i]['name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Sub Menu Image</label>:
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
                <div class="col-md-12">
                  <div class="col-12 col-md-10 offset-md-1">
                    <div class="tab-content  br-n pn">
                      <div id="navpills-1" class="tab-pane active">
                        <div class="table-responsive">  
                          <table id='sub_menu_list' class='table table-bordered table-striped'>
                            <thead>
                              <tr>
                                <th>Sub Menu Name</th>
                                <th>Parent Menu Name</th>
                                <th>Sub Menu Image</th>
                                <th width="10%">Acciones</th>
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

    init_sub_menu_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#imageToUpload').val()){
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/upload_sub_menu_image',
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
              init_sub_menu_list();
              $('#sub_menu_name').val('');
              $('#imageToUpload').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please select the image for the sub menu.');
        return;
      }
      
    });

    $('#sub_menu_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/menu_setting/delete_sub_menu_record',
        type: 'POST',
        data: {id: id},
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
      $('#sub_menu_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/menu_setting/get_sub_menu_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'name' },
           { data: 'parent' },
           { data: 'image' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>