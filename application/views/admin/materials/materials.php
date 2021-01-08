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
                      <label for="" class="control-label mb-1">Material</label>:
                      <input type="text" class="form-control form-control-sm" name="material_name" id="material_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Price</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="price" id="price">
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
                  <table id='material_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Material</th>
                        <th>Price</th>
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
      <div class="modal fade" id="material_edit_modal" tabindex="-1" role="dialog" aria-labelledby="material_editLabel">
      <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="material_editLabel"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-5 offset-1">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Material</label>:
                    <input type="text" class="form-control form-control-sm" name="edit_material_name" id="edit_material_name">
                  </div>
                </div>
                <div class="col-12 col-md-5">
                  <div class="form-group mb-2">
                    <label for="" class="control-label mb-1">Price</label>:
                    <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="edit_price" id="edit_price">
                  </div>
                </div>
              </div>

          </div><!--/body -->
          <div class="modal-footer">
            <input type="hidden" id="edit_material_id">
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

    init_material_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#material_name').val() && $('#price').val()){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/materials/save_material',
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
              init_material_list();
              $('#material_name').val('');
              $('#price').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#material_list tbody').on('click', 'td a.delete-row', function(){
      var material_id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/materials/delete_material_record',
        type: 'POST',
        data: {material_id: material_id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_material_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    $('#material_list tbody').on('click', 'td a.edit-row', function(){
      var material_id = $(this).attr('id');  
      $('#material_editLabel').html('Edit - '+material_id);
      $('#edit_material_id').val(material_id);
      $('#edit_material_name').val($(this).parent().parent().find("td:eq(0)").text());
      $('#edit_price').val($(this).parent().parent().find("td:eq(1)").text());
    });

    $('#btn_update').click(function(){
      var edit_material_name = $('#edit_material_name').val();
      var edit_price = $('#edit_price').val();
      var material_id = $('#edit_material_id').val();
      $.ajax({
        url: '<?= site_url(); ?>admin/materials/edit_material_record',
        type: 'POST',
        data: {material_id: material_id, edit_material_name: edit_material_name, edit_price: edit_price},
        success: function(response){
          var edit_status = JSON.parse(response);
          if(edit_status){
            toastr.success("Edited the row successfully.");
            init_material_list();
          }else{
            toastr.warning("Editing is failed.");
          }
        }
      })
    });

    function init_material_list(){
      $('#material_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/materials/get_material_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'name' },
           { data: 'price' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>