<?php
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
        $this->set_js_lib($this->default_theme_path.'/mdb/js/jquery-plugins/jquery.form.js');
        $this->set_js_lib($this->default_theme_path.'/mdb/js/common/cache-library.js');
    }

    $this->set_js_lib($this->default_theme_path.'/mdb/js/mdb/popper.min.js');
    $this->set_js_lib($this->default_theme_path.'/mdb/js/mdb/bootstrap.min.js');

    //section libs
    $this->set_js_lib($this->default_theme_path.'/mdb/js/bootstrap/dropdown.min.js');
    $this->set_js_lib($this->default_theme_path.'/mdb/js/jquery-plugins/bootstrap-growl.min.js');
    $this->set_js_lib($this->default_theme_path.'/mdb/js/jquery-plugins/jquery.print-this.js');

    $this->set_js_lib($this->default_theme_path.'/mdb/js/common/common.js');
    $this->set_js_lib($this->default_javascript_path.'/common/lazyload-min.js');

    //page js
    $this->set_js_lib($this->default_theme_path.'/mdb/js/datagrid/gcrud.datagrid.js');
    $this->set_js_lib($this->default_theme_path.'/mdb/js/datagrid/list.js');

		$this->set_css($this->default_css_path.'/jquery_plugins/chosen/chosen.css');
		$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.chosen.min.js');
        $this->set_js_config($this->default_javascript_path.'/jquery_plugins/config/jquery.chosen.config.js');

    $colspans = (count($columns) + 2);

    //Start counting the buttons that we have:
    $buttons_counter = 0;

    if (!$unset_edit) {
        $buttons_counter++;
    }

    if (!$unset_read) {
        $buttons_counter++;
    }

    if (!$unset_delete) {
        $buttons_counter++;
    }

    if (!empty($list[0]) && !empty($list[0]->action_urls)) {
        $buttons_counter = $buttons_counter +  count($list[0]->action_urls);
    }

    $list_displaying = str_replace(
        array(
            '{start}',
            '{end}',
            '{results}'
        ),
        array(
            '<span class="paging-starts">1</span>',
            '<span class="paging-ends">10</span>',
            '<span class="current-total-results">'. $this->get_total_results() . '</span>'
        ),
        $this->l('list_displaying'));

	if(config_item('grocery_crud_dialog_color'))
		$this->theme_config['grocery_crud_dialog_color'] = config_item('grocery_crud_dialog_color');

	if(config_item('grocery_crud_dialog_text_color'))
		$this->theme_config['grocery_crud_dialog_text_color'] = config_item('grocery_crud_dialog_text_color');
?>
<script type='text/javascript'>
    var base_url = '<?php echo base_url();?>';

    var subject = '<?php echo $subject?>';
    var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
    var ajax_list_url = '<?php echo $ajax_list_url;?>';
    var unique_hash = '<?php echo $unique_hash; ?>';

    var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";

</script>
<div class="navbar" style="display:none"></div>
<div class="success-message" style="display:none"><?php
if($success_message !== null){?>
   <?php echo $success_message; ?> &nbsp; &nbsp;
<?php }
?></div>

<div class="gc-container <?php echo $this->theme_config['crud_container_class'] ?>">
  <div class="card">
    <div class="card-header <?php echo $this->theme_config['grocery_crud_dialog_color'] ?> <?php echo $this->theme_config['grocery_crud_dialog_text_color'] ?>-text">
        <?php echo $subject_plural; ?>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4  col-sm-6 col-xs-12">
                <?php if(!$unset_add){?>
                        <a class="add-button float-left btn btn-primary btn-sm" href="<?php echo $add_url?>"><i class="fa fa-plus"></i> &nbsp; <?php echo $this->l('list_add'); ?> <?php echo $subject?></a>
                <?php } ?>

                    <!-- Start of: Settings button -->
                                <a href="javascript:void(0)" class="float-left btn btn-sm btn-info clear-filtering">
                                    <i class="fa fa-eraser"></i> <?php echo $this->l('list_clear_filtering');?>
                                </a>
                    <!-- End of: Settings button -->
            </div>
            <div class="col-md-4 col-sm-6">

			    <div class="md-form form-group">
			        <i class="fa fa-search prefix blue-text"></i>
			        <input type="text" id="search-input" name="search" class="form-control search-input">
			        <label for="search-input"><?php echo $this->l('list_search_all');?></label>
			    </div>

			    <div class="md-form form-group float-right">
			        <a class="btn btn-danger btn-sm search-button"><?php echo $this->l('list_search');?></a>
			    </div>


            </div>
            <div class="col-md-4 col-xs-12 text-right">
                <?php if(!$unset_export) { ?>
                    <a class="btn btn-indigo btn-sm gc-export" data-url="<?php echo $export_url; ?>">
                        <i class="fa fa-cloud-download"></i>
                        <span class="invisible-xs">
                            <?php echo $this->l('list_export');?>
                        </span>
                        <div class="clear"></div>
                    </a>
                <?php } ?>
                <?php if(!$unset_print) { ?>
                    <a class="btn btn-secondary btn-sm gc-print" data-url="<?php echo $print_url; ?>">
                        <i class="fa fa-print"></i>
                        <span class="hidden-xs">
                            <?php echo $this->l('list_print');?>
                        </span>
                        <div class="clear"></div>
                    </a>
                <?php }?>

            </div>
        </div>

        <div class="table-container" width="100%">
        <?php if($this->theme_config['crud_paging'] == false){ echo '<div class="table-scroller-wrapper">';} ?>
        <?php echo form_open("", 'method="post" autocomplete="off" id="gcrud-search-form"'); ?>
            <table class="table table-bordered table-responsive table-hover table-sm grocery-crud-table" width="100%">
                <thead>
                    <tr>
                        <th <?php if ($buttons_counter === 0) {?>class="invisible text-center"<?php }?>>
                            <?php echo $this->l('list_actions'); ?>
                        </th>
                        <?php foreach($columns as $column){?>
                            <th class="column-with-ordering" data-order-by="<?php echo $column->field_name; ?>"><?php echo $column->display_as; ?></th>
                        <?php }?>
                        <th class=" text-center">
                            <?php echo $this->l('list_actions'); ?>
                        </th>
                    </tr>

                    <tr class="filter-row gc-search-row">
                        <td class="no-border-right text-center <?php if ($buttons_counter === 0) {?>invisible<?php }?>">
                            <div>
                            <?php if (!$unset_delete) { ?>
                                     <input type="checkbox" class="select-all-none" />
                             <?php } ?>
                             </div>
                             <div>
                                <a href="javascript:void(0);" title="<?php echo $this->l('list_delete')?>"
                                   class="btn btn-danger btn-block btn-sm delete-selected-button" style="display:none">
                                    <i class="fa fa-trash-o"></i>
                                    <?php echo $this->l('list_delete')?>
                                </a>
                              </div>
                                <a href="javascript:void(0);" class="btn btn-secondary btn-sm btn-block gc-refresh">
                                    <i class="fa fa-refresh"></i>
                                </a>

                         </td>
                        <?php foreach($columns as $column){?>
                            <td>
                                <input type="text" class="form-control searchable-input float-left" placeholder="Search <?php echo $column->display_as; ?>" name="<?php echo $column->field_name; ?>" />
                            </td>
                        <?php }?>

                        <th></th>
                    </tr>

                </thead>
                <tbody>
                    <?php include(__DIR__."/list_tbody.php"); ?>
                </tbody>
            </table>
        <?php echo form_close(); ?>
        </div>
        <?php if($this->theme_config['crud_paging'] == false){ echo '</div>';} ?>
    </div>

    <div class="card-footer text-muted white clear-fix">
        <div class="row">
            <div class="col" <?php if($this->theme_config['crud_paging'] == false) echo 'style="display:none"' ?>>
                    <div class="float-left">
                        <?php list($show_lang_string, $entries_lang_string) = explode('{paging}', $this->l('list_show_entries')); ?>
                        <?php echo $show_lang_string; ?>
                    </div>
                    <div class="float-left">
                        <select name="per_page" class="per_page form-control chosen-select">
                            <?php foreach($paging_options as $option){?>
                                <option value="<?php echo $option; ?>"
                                        <?php if($option == $default_per_page){?>selected="selected"<?php }?>>
                                            <?php echo $option; ?>&nbsp;&nbsp;
                                </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="float-left t10">
                        <?php echo $entries_lang_string; ?>
                    </div>
                    <div class="clear"></div>
            </div>

            <div class="col" <?php if($this->theme_config['crud_paging'] == false) echo 'style="display:none"' ?>>

				<!--Pagination -->
				<nav class="my-4">
				    <ul class="pagination pagination-circle pg-blue mb-0">

				        <!--First-->
				        <li class="page-item disabled paging-first"><a class="page-link"><?php echo $this->l('list_paging_first'); ?></a></li>

				        <!--Arrow left-->
				        <li class="page-item prev disabled paging-previous">
				            <a class="page-link" aria-label="Previous">
				                <span aria-hidden="true">&laquo;</span>
				                <span class="sr-only"><?php echo $this->l('list_paging_previous'); ?></span>
				            </a>
				        </li>

                        <span class="page-number-input-container">
                            <input type="number" value="1" class="text-center form-control page-number-input" />
                        </span>

				        <!--Arrow right-->
				        <li class="page-item next paging-next">
				            <a class="page-link" aria-label="Next">
				                <span aria-hidden="true">&raquo;</span>
				                <span class="sr-only"><?php echo $this->l('list_paging_next'); ?></span>
				            </a>
				        </li>

				        <!--First-->
				        <li class="page-item paging-last"><a class="page-link"><?php echo $this->l('list_paging_last'); ?></a></li>

				    </ul>
				    <input type="hidden" name="page_number" class="page-number-hidden" value="1" />
				</nav>
				<!--/Pagination -->

            </div>
            <div class="col-4 text-center" style="padding-top: 10px;">
                <?php echo $list_displaying; ?>
                <span class="full-total-container invisible">
                    <?php echo str_replace(
                                "{total_results}",
                                "<span class='full-total'>" . $this->get_total_results() . "</span>",
                                $this->l('list_filtered_from'));
                    ?>
                </span>
            </div>

        </div>
    </div>
</div>

<!-- Delete confirmation dialog -->
<div class="modal fade delete-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->l('list_delete'); ?> <?php echo $subject?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->l('alert_delete'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->l('form_cancel'); ?></button>
                <button type="button" class="btn btn-danger delete-confirmation-button btn-sm"><?php echo $this->l('list_delete'); ?></button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Multiple confirmation dialog -->
<div class="modal fade delete-multiple-confirmation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->l('list_delete'); ?> <?php echo $subject?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->l('alert_delete'); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                    <?php echo $this->l('form_cancel'); ?>
                </button>
                <button type="button" class="btn btn-danger delete-multiple-confirmation-button btn-sm"
                        data-target="<?php echo $delete_multiple_url; ?>">
                    <?php echo $this->l('list_delete'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End of Delete Multiple confirmation dialog -->

<div class="modal fade add-edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog cascading-modal modal-lg" role="document">
        <div class="modal-content">
           <div id="add-edit-content"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url($this->default_theme_path.'/mdb/js/mdb/mdb.min.js');?>"></script>
<script>
$(document).ready(function() {
     new WOW().init();
    $(".navbar").offset().top > OFFSET_TOP ? $(".scrolling-navbar").addClass("top-nav-collapse") : $(".scrolling-navbar").removeClass("top-nav-collapse")
})
</script>