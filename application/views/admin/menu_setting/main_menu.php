<div class="content-wrapper">
    <section class="content">
      <label><h3>Main Menu</h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="tracking_no" class="control-label mb-1">Menu Name</label>:
                      <input type="text" class="form-control form-control-sm" name="menu_name" id="menu_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="tracking_no" class="control-label mb-1">Menu Image</label>:
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
                          <table id='main_menu_list' class='table table-bordered table-striped'>
                            <thead>
                              <tr>
                                <th>Menu Name</th>
                                <th>Menu Image</th>
                                <th width="10%">Action</th>
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
    var main_name = '';
    var main_image = '';

    init_main_menu_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#imageToUpload').val()){
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
          url: '<?= site_url(); ?>admin/menu_setting/upload_main_menu_image',
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
              init_main_menu_list();
            }
            
          }
        })
      }else{
        toastr.warning('Please select the image for the main menu.');
        return;
      }
      
    });

    $('#main_menu_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/menu_setting/delete_main_menu_record',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_main_menu_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    function init_main_menu_list(){
      $('#main_menu_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/menu_setting/get_main_menu_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'name' },
           { data: 'image' },
           { data: 'action', "width": "10%"}
        ]
      });
    }

  });
</script>