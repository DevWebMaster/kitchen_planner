<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="col-12 col-md-10 offset-md-1">
                <div class="table-responsive">  
                  <table id='pos_location_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Position_lat</th>
                        <th>Position_lon</th>
                        <th>Description</th>
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
    </section>  
</div>

<script type="text/javascript">
  $(document).ready(function() {

    init_pos_location_list();

    $('#pos_location_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/pos_setting/delete_pos_location_record',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_pos_location_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    function init_pos_location_list(){
      $('#pos_location_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/pos_setting/get_pos_location',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'id' },
           { data: 'name' },
           { data: 'address' },
           { data: 'position_lat' },
           { data: 'position_lon' },
           { data: 'description' },
           { data: 'action', "width": "10%"},
        ]
      });
    }

  });
</script>