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
                      <label for="" class="control-label mb-1">POS Name</label>:
                      <input type="text" class="form-control form-control-sm" name="pos_name" id="pos_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Company Name</label>:
                      <input type="text" class="form-control form-control-sm" name="company_name" id="company_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Email</label>:
                      <input type="text" class="form-control form-control-sm" name="email" id="email">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">CIF</label>:
                      <input type="text" class="form-control form-control-sm" name="cif" id="cif">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Phone Number</label>:
                      <input type="text" class="form-control form-control-sm" name="phone_num" id="phone_num">
                    </div>
                  </div>
                </div>
                <div class="col-md-12" style="display: inline-flex;">
                  <div class="col-12 col-md-2 offset-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Direction</label>:
                      <input type="text" class="form-control form-control-sm" name="direction" id="direction">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">zipcode</label>:
                      <input type="text" class="form-control form-control-sm" name="zipcode" id="zipcode">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Coordinates</label>:
                      <input type="text" class="form-control form-control-sm" name="company_name" id="company_name">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Password</label>:
                      <input type="text" class="form-control form-control-sm" name="password" id="password">
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
                  <table id='pos_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>POS Name</th>
                        <th>Company Name</th>
                        <th>CIF</th>
                        <th>Phone Number</th>
                        <th>Direction</th>
                        <th>Zipcode</th>
                        <th>Coordinates</th>
                        <th>Block</th>
                        <th width="5%">Action</th>
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

    init_pos_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
      if($('#pos_name').val() && $('#company_name').val() && $('#email').val() && $('#cif').val() && $('#phone_num').val() && $('#direction').val() && $('#zipcode').val() && $('#coordinates').val() && $('#password').val()){
        var formData = new FormData(this);
        $.ajax({
          url: '<?= site_url(); ?>admin/pos_setting/save_pos',
          type: 'POST',
          data: formData,       
          cache: false,
          contentType: false,
          processData: false,
          success: function(response) {
            var result = JSON.parse(response);
            if(!result.status){
              toastr.warning('Saving the pos is failed.');
            }else{
              toastr.success('The pos is saved successfully.');
              init_pos_list();
              $('#pos_name').val('');
              $('#company_name').val('');
              $('#email').val('');
              $('#cif').val('');
              $('#phone_num').val('');
              $('#direction').val('');
              $('#zipcode').val('');
              $('#coordinates').val('');
              $('#password').val('');
            }
            
          }
        })
      }else{
        toastr.warning('Please fill all fields correctly.');
        return;
      }
      
    });

    $('#pos_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/delete_pos_record',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_pos_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    $('#pos_list tbody').on('click', 'td input.tgl_checkbox', function(){
      var selected_pos_id = $(this).attr('id');
      var b_flag = 0;
      if($('.tgl_checkbox').prop("checked")){
        b_flag = 1;
        set_block_pos(selected_pos_id, b_flag);
      }else{
        b_flag = 0;
        set_block_pos(selected_pos_id, b_flag);
      }
    });

    function init_pos_list(){
      $('#pos_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/pos_setting/get_pos_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'pos_name' },
           { data: 'company_name' },
           { data: 'CIF' },
           { data: 'phone_num' },
           { data: 'direction' },
           { data: 'zipcode' },
           { data: 'coordinates' },
           { data: 'block' },
           { data: 'action', "width": "5%"},
        ]
      });
    }

    function set_block_pos(selected_pos_id, flag)
    {
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/set_block_pos',
        type: 'POST',
        data: {selected_pos_id: selected_pos_id, flag: flag},
        success: function(response){
          var status = JSON.parse(response);
          console.log(selected_pos_id);
          if(status == 1){
            toastr.success("Selected POS is blocked successfully.");
            init_pos_list();
          }else if(status == 0){
            toastr.success("Selected POS is unblocked successfully.");
          }
        }
      })
    }

  });
</script>