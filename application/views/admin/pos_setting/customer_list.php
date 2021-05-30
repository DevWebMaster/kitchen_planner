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
                      <label for="" class="control-label mb-1">POS</label>:
                      <select class="form-control form-control-sm" name="pos_id" id="pos_id">
                        <?php for($i = 0; $i < count($pos_arr); $i++){ ?>
                          <option value="<?= $pos_arr[$i]['pos_id']; ?>"><?= $pos_arr[$i]['pos_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-2">
                    <div class="form-group mt-4">
                      <input type="button" class="btn btn-sm btn-info filter px-5" id="filter" value="Filter">
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
                  <table id='customer_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nombre del Cliente</th>
                        <th>Email</th>
                        <th>Teléfono Número</th>
                        <th>Dirección</th>
                        <th>Zipcode</th>
                        <th>Planner Count</th>
                        <th>Status</th>
                        <!-- <th width="10%">Acciones</th> -->
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
    var pos_id = $('#pos_id').val();
    init_customer_list_by_pos(pos_id);

    $('#filter').click(function() {
      pos_id = $('#pos_id').val();
      init_customer_list_by_pos(pos_id);
    })

    function init_customer_list_by_pos(pos_id){
      $('#customer_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/pos_setting/get_customer_list_by_pos',
            'data': {pos_id: pos_id},
        },
        'columns': [
           { data: 'no' },
           { data: 'customer_name' },
           { data: 'email' },
           { data: 'phone_num' },
           { data: 'delivery_direction' },
           { data: 'zipcode' },
           { data: 'planner_count' },
           { data: 'status' },
        ]
      });
    }

  });
</script>