<div class="content-wrapper">
    <section class="content">
      <label><h3><?= $title; ?></h3></label>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="col-12 col-md-10 offset-md-1">
                <div class="table-responsive">  
                  <table id='customer_list' class='table table-bordered table-striped text-center'>
                    <thead>
                      <tr>
                        <th>Customer Name</th>
                        <th>Last Name1</th>
                        <th>Last Name2</th>
                        <th>DNI</th>
                        <th>Email</th>
                        <th>Transaction</th>
                        <th>Phone Number</th>
                        <th>Direction</th>
                        <th>Zipcode</th>
                        <th>LOPD</th>
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

    init_customer_list();

    $('#customer_list tbody').on('click', 'td a.delete-row', function(){
      var id = $(this).attr('id');  
      $.ajax({
        url: '<?= site_url(); ?>admin/customer_setting/delete_customer_record',
        type: 'POST',
        data: {id: id},
        success: function(response){
          var del_status = JSON.parse(response);
          if(del_status){
            toastr.success("Deleted the row successfully.");
            init_customer_list();
          }else{
            toastr.warning("Deleting is failed.");
          }
        }
      })
    });

    $('#customer_list tbody').on('click', 'td input.tgl_checkbox', function(){
      var selected_customer_id = $(this).attr('id');
      var b_flag = 0;
      if($('.tgl_checkbox').prop("checked")){
        b_flag = 1;
        set_block_customer(selected_customer_id, b_flag);
      }else{
        b_flag = 0;
        set_block_customer(selected_customer_id, b_flag);
      }
    });

    function init_customer_list(){
      $('#customer_list').DataTable({
        'destroy': true,
        'processing': true,
        // 'serverSide': true,
        'pagingType': "simple",
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url(); ?>admin/customer_setting/get_customer_list',
            // 'data': {search_key: search_key},
        },
        'columns': [
           { data: 'customer_name' },
           { data: 'last_name1' },
           { data: 'last_name2' },
           { data: 'DNI' },
           { data: 'email' },
           { data: 'transaction' },
           { data: 'phone_num' },
           { data: 'delivery_direction' },
           { data: 'zipcode' },
           { data: 'LOPD' },
           { data: 'block' },
           { data: 'action', "width": "5%"},
        ]
      });
    }

    function set_block_customer(selected_customer_id, flag)
    {
      $.ajax({
        url: '<?= site_url(); ?>admin/customer_setting/set_block_customer',
        type: 'POST',
        data: {selected_customer_id: selected_customer_id, flag: flag},
        success: function(response){
          var status = JSON.parse(response);
          console.log(selected_customer_id);
          if(status == 1){
            toastr.success("Selected Customer is blocked successfully.");
            init_customer_list();
          }else if(status == 0){
            toastr.success("Selected Customer is unblocked successfully.");
          }
        }
      })
    }

  });
</script>