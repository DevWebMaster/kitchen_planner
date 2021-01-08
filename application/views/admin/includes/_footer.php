<?php if(!isset($footer)): ?>

  <footer class="main-footer">
    <strong><?= $this->general_settings['copyright']; ?></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Developed By:</b> Bozo Krkeljas.
    </div>
  </footer>

  <?php endif; ?>  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  
</div>
<!-- ./wrapper -->


<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--script>
  $.widget.bridge('uibutton', $.ui.button)
</script-->
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->

<!-- Slimscroll -->
<script src="<?= base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<!-- Notify JS -->
<script src="<?= base_url() ?>assets/plugins/notify/notify.min.js"></script>
<!-- DROPZONE -->
<script src="<?= base_url() ?>assets/plugins/dropzone/dropzone.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>


  <?php if (isset($script['js']) && count($script['js']) >0  ) : ?>
    <?php foreach ( $script['js'] as  $js) { ?>
        <script src="<?= $js ?>"></script>
    <?php } ?>  
  <?php  endif; ?>


<script>

$(function () {
    //Initialize Select2 Elements
    // $('.select2').select2();

  })  


var csfr_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';

var csfr_token_value = '<?php echo $this->security->get_csrf_hash(); ?>';

$(function(){




//-------------------------------------------------------------------
// Country State & City Change

$(document).on('change','.country',function()
{

  if(this.value == '')
  {
    $('.state').html('<option value="">Select Option</option>');

    $('.city').html('<option value="">Select Option</option>');

    return false;
  }


  var data =  {

    country : this.value,

  }

  data[csfr_token_name] = csfr_token_value;

  $.ajax({

    type: "POST",

    url: "<?= base_url('admin/auth/get_country_states') ?>",

    data: data,

    dataType: "json",

    success: function(obj) {
      $('.state').html(obj.msg);
   },

  });
});

$(document).on('change','.state',function()
{

  var data =  {

    state : this.value,

  }

  data[csfr_token_name] = csfr_token_value;

  $.ajax({

    type: "POST",

    url: "<?= base_url('admin/auth/get_state_cities') ?>",

    data: data,

    dataType: "json",

    success: function(obj) {

      $('.city').html(obj.msg);

   },

  });
    });
  });
</script>



<!--script src="<?php echo base_url('vendor/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.js'); ?>"></script-->
<!-- <script src="<?php echo base_url('vendor/xcrud/plugins/jquery.min.js'); ?>"></script> -->
<script type="text/javascript">
            // var jQuery = $.noConflict(true);
            </script>
<!-- <script src="<?php echo base_url('vendor/xcrud/plugins/xcrud.js'); ?>"></script> -->

<script type="text/javascript"> 
 // var xcrud_config = {"url":"<?php echo base_url('api/xcrud_ajax'); ?>","editor_url":false,"editor_init_url":false,"force_editor":false,"date_first_day":1,"date_format":"dd.mm.yy","time_format":"HH:mm:ss","lang":{"add":"Add","edit":"Edit","view":"View","remove":"Remove","duplicate":"Duplicate","print":"Print","export_csv":"Export into CSV","search":"Search","go":"Go","reset":"Reset","save":"Save","save_return":"Save & Return","save_new":"Save & New","save_edit":"Save & Edit","return":"Return","modal_dismiss":"Close","add_image":"Add image","add_file":"Add file","exec_time":"Execution time:","memory_usage":"Memory usage:","bool_on":"Yes","bool_off":"No","no_file":"no file","no_image":"no image","null_option":"- none -","total_entries":"Total entries:","table_empty":"Entries not found.","all":"All","deleting_confirm":"Do you really want remove this entry?","undefined_error":"It looks like something went wrong...","validation_error":"Some fields are likely to contain errors. Fix errors and try again.","image_type_error":"This image type is not supported.","unique_error":"Some fields are not unique.","your_position":"Your position","search_here":"Search here...","all_fields":"All fields","choose_range":"- choose range -","next_year":"Next year","next_month":"Next month","today":"Today","this_week_today":"This week up to today","this_week_full":"This full week","last_week":"Last week","last_2weeks":"Last two weeks","this_month":"This month","last_month":"Last month","last_3months":"Last 3 months","last_6months":"Last 6 months","this_year":"This year","last_year":"Last year"},"rtl":0};
</script>  



</body>
</html>
