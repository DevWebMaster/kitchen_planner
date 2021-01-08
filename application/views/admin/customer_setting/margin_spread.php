<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" enctype="multipart/form-data" id="uploadForm">
                <div class="col-md-12" style="display: inline-flex;">
                   <div class="col-12 col-md-2 offset-md-1">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Customer Margin(%)</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="customer_margin" id="customer_margin">
                    </div>
                  </div>
                   <div class="col-12 col-md-2">
                    <div class="form-group mb-2">
                      <label for="" class="control-label mb-1">Customer Spread(EUR)</label>:
                      <input type="number" min="0" oninput="validity.valid||(value='');" class="form-control form-control-sm" name="customer_spread" id="customer_spread">
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mt-4">
                      <input type="submit" class="btn btn-sm btn-info add_label_no px-5" value="<?= $is_exist ? "Reset" : "Set"; ?>">
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
                  <table id='margin_spread_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Customer Margin (%)</th>
                        <th>Customer Spread (EUR)</th>
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

    init_margin_spread_list();

    $('#uploadForm').submit(function(e) {
      e.preventDefault();
        var formData = new FormData(this);
        if($('#customer_margin').val() == '' && $('#customer_spread').val() == ''){
          toastr.warning("Please insert the value.");
        }else{
          $.ajax({
            url: '<?= site_url(); ?>admin/customer_setting/save_margin_spread',
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
                toastr.success('The data is changed successfully.');
                init_margin_spread_list();
                $('#customer_margin').val('');
                $('#customer_spread').val('');
              }
              
            }
          })
        }
    });

    function init_margin_spread_list(){
      $('#margin_spread_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/customer_setting/get_margin_spread_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'customer_margin' },
           { data: 'customer_spread' },
        ]
      });
    }

  });
</script>