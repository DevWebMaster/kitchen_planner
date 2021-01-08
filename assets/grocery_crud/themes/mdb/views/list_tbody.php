<?php
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

    $show_more_button  = $buttons_counter > 3 ? true : false;

    //The more lang string exists only in version 1.5.2 or higher
    $more_string =
        preg_match('/1\.(5\.[2-9]|[6-9]\.[0-9])/', Grocery_CRUD::VERSION)
            ? $this->l('list_more') : "More";

?>

<?php foreach($list as $num_row => $row){ ?>
    <tr>
       <td class="text-center" <?php if ($unset_delete) { ?> style="border-right: none;"<?php } ?>
            <?php if ($buttons_counter === 0) {?>class="invisible"<?php }?>>
            <?php if (!$unset_delete) { ?>
                <input type="checkbox" class="select-row" data-id="<?php echo $row->primary_key_value; ?>" />
            <?php } ?>
        </td>
        <?php foreach($columns as $column){?>
            <td>
                <?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?>
            </td>
        <?php }?>
        <td style="width: 142px;" <?php if ($buttons_counter === 0) {?>class="invisible"<?php }?>>
                <div class="d-none d-lg-block d-xl-block d-md-block"  style="white-space: nowrap">
                    <div class="btn-group">
                        <?php if(!$unset_edit){?>
                            <a class="btn default-color-dark btn-sm edit-button" href="<?php echo $row->edit_url?>"><i class="fa fa-pencil"></i></a>
                        <?php } ?>

                        <?php if (!empty($row->action_urls) || !$unset_read || !$unset_clone || !$unset_delete) { ?>
                            <?php if ($show_more_button) { ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    <!-- <?php echo $more_string; ?> -->
                                    <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu" aria-haspopup="true" aria-expanded="false">
                                        <?php
                                            if(!empty($row->action_urls)){
                                                foreach($row->action_urls as $action_unique_id => $action_url){
                                                    $action = $actions[$action_unique_id];
                                                    ?>
                                                        <a class="dropdown-item" href="<?php echo $action_url; ?>">
                                                            <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                                        </a>
                                                <?php }
                                            }
                                            ?>
                                            <?php if (!$unset_read) { ?>
                                                    <a class="dropdown-item read-button" data-id="<?php echo $row->primary_key_value; ?>" href="<?php echo $row->read_url?>"><i class="fa fa-eye"></i> <?php echo $this->l('list_view')?></a>
                                            <?php } ?>

							                <?php if(!$unset_clone){?>
								                    <a class="dropdown-item clone-button" data-id="<?php echo $row->primary_key_value; ?>" href="<?php echo $row->clone_url?>"><i class="fa fa-copy"></i>  <?php echo $this->l('list_clone')?></a>
							                <?php }?>

                                            <?php if (!$unset_delete) { ?>
                                                    <a data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>" class="delete-row dropdown-item">
                                                        <i class="fa fa-trash-o text-danger"></i>
                                                        <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                                    </a>
                                            <?php } ?>
                                    </div>
                                  </div>

                            <?php } else {
                                if(!empty($row->action_urls)){
                                    foreach($row->action_urls as $action_unique_id => $action_url){
                                        $action = $actions[$action_unique_id];
                                        ?>
                                        <a href="<?php echo $action_url; ?>" class="btn btn-primary btn-sm">
                                            <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                        </a>
                                    <?php }
                                }

                                if (!$unset_read) { ?>
                                    <a class="btn btn-info btn-sm read-button" data-id="<?php echo $row->primary_key_value; ?>" href="<?php echo $row->read_url?>"><i class="fa fa-eye"></i></a>
                                <?php }

				                if(!$unset_clone){?>
					                    <a class="btn btn-success btn-sm clone-button" data-id="<?php echo $row->primary_key_value; ?>" href="<?php echo $row->clone_url?>"><i class="fa fa-copy"></i></a>
				                <?php }

                                if (!$unset_delete) { ?>
                                    <a class="delete-row btn btn-danger btn-sm" data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                <?php } ?>
                            <?php } ?>

                        <?php } ?>

                    </div>

                </div>
                <div class="d-block d-md-none">
                    <?php if ($buttons_counter > 0) { ?>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                            <?php echo $this->l('list_actions'); ?>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <?php if (!$unset_edit) { ?>
                                <a class="dropdown-item edit-button" href="<?php echo $row->edit_url?>">
                                    <i class="fa fa-pencil"></i> <?php echo $this->l('list_edit'); ?>
                                </a>
                            <?php } ?>
                            <?php
                            if(!empty($row->action_urls)){
                                foreach($row->action_urls as $action_unique_id => $action_url){
                                    $action = $actions[$action_unique_id];
                                    ?>
                                        <a class="dropdown-item" href="<?php echo $action_url; ?>">
                                            <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                        </a>
                                <?php }
                            }
                            ?>
                            <?php if (!$unset_read) { ?>
                                    <a class="dropdown-item read-button" data-id="<?php echo $row->primary_key_value; ?>" href="<?php echo $row->read_url?>"><i class="fa fa-eye"></i> <?php echo $this->l('list_view')?></a>
                            <?php } ?>

				            <?php if(!$unset_clone){?>
					                <a class="dropdown-item clone-button" data-id="<?php echo $row->primary_key_value; ?>" href="<?php echo $row->clone_url?>"><i class="fa fa-copy"></i> <?php echo $this->l('list_clone')?></a>
				            <?php } ?>

                            <?php if (!$unset_delete) { ?>
                                    <a data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>" class="delete-row dropdown-item">
                                        <i class="fa fa-trash-o text-danger"></i> <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                    </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
        </td>
    </tr>
<?php } ?>