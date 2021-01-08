<?php
	if(config_item('grocery_crud_dialog_color'))
		$this->theme_config['grocery_crud_dialog_color'] = config_item('grocery_crud_dialog_color');

	if(config_item('grocery_crud_dialog_text_color'))
		$this->theme_config['grocery_crud_dialog_text_color'] = config_item('grocery_crud_dialog_text_color');

	if (!$is_ajax) {
			$this->set_css($this->default_theme_path.'/mdb/css/font-awesome/css/font-awesome.min.css');
		    $this->set_css($this->default_theme_path.'/mdb/css/mdb/bootstrap.min.css');
		    $this->set_css($this->default_theme_path.'/mdb/css/mdb/mdb.min.css');
		    $this->set_css($this->default_theme_path.'/mdb/css/mdb/style.css');
		    $this->set_css($this->default_theme_path.'/mdb/css/plugins/animate.min.css');

			if ($this->config->environment == 'production') {
		        $this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);
		        $this->set_js_lib($this->default_theme_path.'/mdb/build/js/global-libs.min.js');

			} else {
		        $this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);
		        $this->set_js_lib($this->default_theme_path.'/mdb/js/jquery-plugins/jquery.form.min.js');
		        $this->set_js_lib($this->default_theme_path.'/mdb/js/common/common.min.js');
			}
    $this->set_js_config($this->default_theme_path.'/mdb/js/form/add.js');
    $this->set_js_lib($this->default_theme_path.'/mdb/js/mdb/popper.min.js');
    $this->set_js_lib($this->default_theme_path.'/mdb/js/mdb/bootstrap.min.js');

        $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
        $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
?>
<div class="crud-form" data-unique-hash="<?php echo $unique_hash; ?>">
    <div class="container-fluid gc-container">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
                <?php echo form_open( $insert_url, 'method="post" id="crudForm"  enctype="multipart/form-data" class="form-horizontal"'); ?>
                <!--Panel-->
                <div class="card">
                    <div class="card-header <?php echo $this->theme_config['grocery_crud_dialog_color'] ?> <?php echo $this->theme_config['grocery_crud_dialog_text_color'] ?>-text">
                        <?php echo $this->l('form_add'); ?>
                        <?php echo $subject?>
                    </div>

            <div class="card-body">


                <?php foreach($fields as $field) { ?>

						<div class="md-form <?php echo $field->field_name; ?>_form_group">
					        <label><?php echo $input_fields[$field->field_name]->display_as; ?><?php echo ($input_fields[$field->field_name]->required) ? "<span class='required'>*</span> " : ""; ?></label>
					        <?php echo $input_fields[$field->field_name]->input?>
					    </div>
                <?php }?>
                <!-- Start of hidden inputs -->
                <?php if(!empty($hidden_fields)){?>

                    <?php
                    foreach($hidden_fields as $hidden_field){
                        echo $hidden_field->input;
                    }
                    ?>
                    <!-- End of hidden inputs -->
                <?php } ?>
                <?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
	                    <div class="small-loading" id="FormLoading">
	                        <?php echo $this->l('form_insert_loading'); ?>
	                    </div>
	                    <div class="form-group">
	                    	<div class="row">
		                        <div class="col-12 text-center">
									<div id="report-error" class="report-div color-block danger-color z-depth-2 white-text" style="display:none"></div>
									<div id="report-success" class="report-div color-block success-color z-depth-2 white-text" style="display:none"></div>
		                        </div>
	                        </div>
	                    </div>
                    </div>
                    <div class="card-footer text-muted white text-center">

                            <button class="btn btn-success" type="submit" id="form-button-save">
                            <i class="fa fa-check"></i>
                            <?php echo $this->l('form_save'); ?>
                        </button>
                            <?php   if(!$this->unset_back_to_list) { ?>
                            <button class="btn btn-info btn-sm" type="button" id="save-and-go-back-button">
                                <i class="fa fa-rotate-left"></i>
                                <?php echo $this->l('form_save_and_go_back'); ?>
                            </button>
                            <button class="btn btn-warning cancel-button" type="button" id="cancel-button">
                                <i class="fa fa-warning"></i>
                                <?php echo $this->l('form_cancel'); ?>
                            </button>
                            <?php } ?>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <!--/.Panel-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url($this->default_theme_path.'/mdb/js/mdb/mdb.min.js');?>"></script>
<?php
} else {
	 $this->set_js_config($this->default_theme_path.'/mdb/js/form/add.js');
?>

        <!--Header-->
        <div class="modal-header <?php echo $this->theme_config['grocery_crud_dialog_color'] ?> <?php echo $this->theme_config['grocery_crud_dialog_text_color'] ?>-text">
            <h4 class="title">
                <i class="fa fa-plus"></i>
                <?php echo $this->l('form_add'); ?>
                <?php echo $subject?>
            </h4>
            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true"><i class="fa fa-close"></i></span>
			        </button>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">

                    <div class="row col-12 small-loading" id="FormLoading">
                        <?php echo $this->l('form_insert_loading'); ?>
                    </div>

            <?php echo form_open( $insert_url, 'method="post" id="crudForm"  enctype="multipart/form-data" class="form-horizontal"'); ?>
            <?php foreach($fields as $field) { ?>
						<div class="md-form <?php echo $field->field_name; ?>_form_group">
					        <label><?php echo $input_fields[$field->field_name]->display_as; ?><?php echo ($input_fields[$field->field_name]->required) ? "<span class='required'>*</span> " : ""; ?></label>
					        <?php echo $input_fields[$field->field_name]->input?>
					    </div>
            <?php }?>

            <?php if(!empty($hidden_fields)){?>
            <!-- Start of hidden inputs -->
            <?php
                foreach($hidden_fields as $hidden_field){
                    echo $hidden_field->input;
                }
            ?>
                <!-- End of hidden inputs -->
                <?php } ?>
                <?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" />
                <?php }?>
                    <div class="form-group">
                    	<div class="row">
	                        <div class="col-12 text-center">
								<div id="report-error" class="report-div color-block danger-color z-depth-2 white-text" style="display:none"></div>
								<div id="report-success" class="report-div color-block success-color z-depth-2 white-text" style="display:none"></div>
	                        </div>
                        </div>
                    </div>

                <?php echo form_close(); ?>

        </div>
        <div class="modal-footer display-footer">

                            <?php   if(!$this->unset_back_to_list) { ?>
                            <button class="btn btn-success" type="button" id="save-and-go-back-button">
                                <i class="fa fa-check"></i>
                                <?php echo $this->l('form_save'); ?>
                            </button>
                            <button class="btn btn-warning cancel-button" type="button" id="cancel-button">
                                <i class="fa fa-warning"></i>
                                <?php echo $this->l('form_cancel'); ?>
                            </button>
                            <?php } ?>

        </div>

        <?php
}
?>
        <script>
            var validation_url = '<?php echo $validation_url?>';
            var list_url = '<?php echo $list_url?>';

            var message_alert_add_form = "<?php echo $this->l('alert_add_form')?>";
            var message_insert_error = "<?php echo $this->l('insert_error')?>";

        </script>