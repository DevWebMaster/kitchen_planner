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
			    $this->set_js_lib($this->default_theme_path.'/bootstrap/js/jquery-plugins/jquery.form.js');
			    $this->set_js_lib($this->default_theme_path.'/bootstrap/js/common/cache-library.js');
			    $this->set_js_lib($this->default_theme_path.'/bootstrap/js/common/common.js');
			}




?>
    <div class="container-fluid gc-container">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">

                <!--Panel-->
                <div class="card">
                    <div class="card-header <?php echo $this->theme_config['grocery_crud_dialog_color'] ?> <?php echo $this->theme_config['grocery_crud_dialog_text_color'] ?>-text">
                        <?php echo $this->l('list_view'); ?>
                        <?php echo $subject?>
                    </div>
                    <div class="card-body">
                        <?php echo form_open( $update_url, 'method="post" id="crudForm"  enctype="multipart/form-data"'); ?>
                        <?php foreach($fields as $field) { ?>

                        <div class="row">
                            <div class="col-5 text-right">
                                <?php echo $input_fields[$field->field_name]->display_as?>:
                            </div>
                            <div class="col-6">
                                <?php echo $input_fields[$field->field_name]->input; ?>
                            </div>
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
							<!--Card Danger-->
					        <div id="report-error" class="report-div card danger-color text-center z-depth-2" style="display:none">
					            <div class="card-body white-text">
					            </div>
					        </div>
					        <!--/.Card Danger-->
							<!--Card Success-->
					        <div id="report-success" class="report-div card success-color text-center z-depth-2 text-white" style="display:none">
					            <div class="card-body white-text">
					            </div>
					        </div>
					        <!--/.Card Success-->

                            <?php echo form_close(); ?>
                    </div>
                    <div class="card-footer text-muted white danger-text">
                        <?php 	if(!$this->unset_back_to_list) { ?>
                        <button class="btn btn-info cancel-button" type="button" onclick="window.location = '<?php echo $list_url; ?>'">
                                    <i class="fa fa-arrow-left"></i>
                                    <?php echo $this->l('form_back_to_list'); ?>
                                </button>
                        <?php } ?>
                    </div>
                </div>
                <!--/.Panel-->

            </div>
        </div>
    </div>

    <?php
	// ajax modal dialog
  } else {

?>
        <!--Header-->
        <div class="modal-header <?php echo $this->theme_config['grocery_crud_dialog_color'] ?> <?php echo $this->theme_config['grocery_crud_dialog_text_color'] ?>-text">
            <h4 class="title">
                <i class="fa fa-eye"></i>
                <?php echo $this->l('list_view'); ?>
                <?php echo $subject?>
            </h4>
            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true"><i class="fa fa-close"></i></span>
			        </button>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">

            <?php echo form_open( $update_url, 'method="post" id="crudForm"  enctype="multipart/form-data"'); ?>
            <?php foreach($fields as $field) { ?>

            <div class="row">
                <div class="col-5 text-right">
                    <?php echo $input_fields[$field->field_name]->display_as?>:
                </div>
                <div class="col-7">
                    <?php echo $input_fields[$field->field_name]->input; ?>
                </div>
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
                <div id='report-error' class='report-div error'></div>
                <div id='report-success' class='report-div success'></div>

                <?php echo form_close(); ?>

        </div>
        <div class="modal-footer display-footer">
            <button type="button" class="btn btn-outline-danger waves-effects ml-auto" data-dismiss="modal">
                      	<i class="fa fa-arrow-left"></i>
                      	<?php echo $this->l('form_back_to_list'); ?>
                      </button>
        </div>

        <?php

 }
?>
