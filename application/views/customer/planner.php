<!DOCTYPE html>
<html>
  <head>
    <title>Design Kitchen</title>
    <base href="/">
    <link href="<?php site_url(); ?>kitchen_planner/assets/design/planner/css/bootstrap.css" rel="stylesheet">
    <link href="<?php site_url(); ?>kitchen_planner/assets/design/planner/css/planner.css" rel="stylesheet">

    <script src="<?php site_url(); ?>kitchen_planner/assets/design/planner/js/three.min.js"></script>
    <script src="<?php site_url(); ?>kitchen_planner/assets/design/planner/js/blueprint3d.js"></script>

    <script src="<?php site_url(); ?>kitchen_planner/assets/design/planner/js/jquery.js"></script>
    <script src="<?php site_url(); ?>kitchen_planner/assets/design/planner/js/bootstrap.js"></script>
    
    <script src="<?php site_url(); ?>kitchen_planner/assets/design/planner/js/items.js"></script>
    <script src="<?php site_url(); ?>kitchen_planner/assets/design/planner/js/planner.js"></script>
    <script type="text/javascript">
      
    </script>
  </head>

  <body>
    <input type="hidden" name="product_id" id="product_id" value="<?= $product_id; ?>">
    <input type="hidden" name="product_name" id="product_name">
    <div class="container-fluid">
      <div class="row main-row">
        <!-- Left Column -->
        <div class="col-xs-3 sidebar">
          <!-- Main Navigation -->
          <ul class="nav nav-sidebar">
            <li id="floorplan_tab"><a >
              1. Generar espacio
              <span class="glyphicon glyphicon-chevron-right pull-right"></span>
            </a></li>
            <li id="items_tab"><a >
              2. Agregar muebles de cocina
              <span class="glyphicon glyphicon-chevron-right pull-right"></span>
            </a></li>
            <li id="design_tab"><a >
              3. Diseno 3D
              <span class="glyphicon glyphicon-chevron-right pull-right"></span>
            </a></li>
          </ul>
          <hr />
          <div class="form-group search-group" style="margin: 0 10px;">
            <div class="form-group" style="display: inline-flex; width: 100%;">
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <label class="control-label">
                  Countertop Type:
                </label>
              </div>
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <select class="form-control" id="search_countertop_type">
                  <?php 
                    for($i = 0; $i < count($search_list['countertop_type']); $i++) { ?>
                      <option value="<?= $search_list['countertop_type'][$i]['material_id']; ?>"><?= $search_list['countertop_type'][$i]['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>
            <div class="form-group" style="display: inline-flex; width: 100%;">
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <label class="control-label">
                  Countertop Color:
                </label>
              </div>
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <select class="form-control" id="search_countertop_color">
                  <?php 
                    for($i = 0; $i < count($search_list['countertop_color']); $i++) { ?>
                      <option value="<?= $search_list['countertop_color'][$i]['color_id']; ?>"><?= $search_list['countertop_color'][$i]['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>
            <div class="form-group" style="display: inline-flex; width: 100%;">
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <label class="control-label">
                  Exterio Color:
                </label>
              </div>
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <select class="form-control" id="search_exterio_color">
                  <?php 
                    for($i = 0; $i < count($search_list['exterio_color']); $i++) { ?>
                      <option value="<?= $search_list['exterio_color'][$i]['color_id']; ?>"><?= $search_list['exterio_color'][$i]['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>
            <div class="form-group" style="display: inline-flex; width: 100%;">
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <label class="control-label">
                  Interior Color:
                </label>
              </div>
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <select class="form-control" id="search_interior_color">
                  <?php 
                    for($i = 0; $i < count($search_list['interior_color']); $i++) { ?>
                      <option value="<?= $search_list['interior_color'][$i]['color_id']; ?>"><?= $search_list['interior_color'][$i]['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>
            <div class="form-group" style="display: inline-flex; width: 100%;">
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <label class="control-label">
                  Skirting Type:
                </label>
              </div>
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <select class="form-control" id="search_skirting_type">
                  <?php 
                    for($i = 0; $i < count($search_list['skirting_type']); $i++) { ?>
                      <option value="<?= $search_list['skirting_type'][$i]['material_id']; ?>"><?= $search_list['skirting_type'][$i]['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>
            <div class="form-group" style="display: inline-flex; width: 100%;">
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <label class="control-label">
                  Skirting Color:
                </label>
              </div>
              <div class="col-sm-6 col-md-6" style="padding-left: 0px; padding-right: 0px;">
                <select class="form-control" id="search_skirting_color">
                  <?php 
                    for($i = 0; $i < count($search_list['skirting_color']); $i++) { ?>
                      <option value="<?= $search_list['skirting_color'][$i]['color_id']; ?>"><?= $search_list['skirting_color'][$i]['name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <br>
            <div class="col-sm-7" style="margin-top: 5px;">
              <input type="text" class="form-control" placeholder="Model name..." id="search-box">
            </div>
            <div class="col-sm-5">
              <button class="btn btn-block" id="context-menu-search">Buscar</button>
            </div>
          </div>
          <!-- <hr /> -->
          <!-- Context Menu -->
          <div id="context-menu">
            <div style="margin: 0 20px">
            <br />
              <span id="context-menu-name" class="lead"></span>
              <div class="panel panel-default">
                <div class="panel-heading">Información detallada</div>
                <div class="panel-body" style="color: #333333">
                  <small><span class="text-muted">Medidas en mm.</span></small>
                  <div class="form form-horizontal" class="lead">
                    <div class="form-group">
                      <label class="col-sm-5 control-label">
                        Anchura:
                      </label>
                      <div class="col-sm-6">
                        <input type="number" class="form-control" id="item-width">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">
                        Profundidad:
                      </label>
                      <div class="col-sm-6">
                        <input type="number" class="form-control" id="item-depth">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">
                        Altura:
                      </label>
                      <div class="col-sm-6">
                        <input type="number" class="form-control" id="item-height" readonly>
                      </div>
                    </div>


                    <div class="form-group">
                      <input type="hidden" id="model_id">
                      <label class="col-sm-5 control-label">
                        Countertop:
                      </label>
                      <div class="col-sm-6">
                        <label class="control-label" id="item-countertop"></label>
                        <!-- <input type="text" readonly class="form-control" id="item-countertop"> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">
                        Exterio Color:
                      </label>
                      <div class="col-sm-6">
                        <label class="control-label" id="item-exteriocolor"></label>
                        <!-- <input type="text" readonly class="form-control" id="item-exteriocolor"> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">
                        Interior Color:
                      </label>
                      <div class="col-sm-6">
                        <label class="control-label" id="item-interiorcolor"></label>
                        <!-- <input type="text" readonly class="form-control" id="item-interiorcolor"> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-5 control-label">
                        Skirting:
                      </label>
                      <div class="col-sm-6">
                        <label class="control-label" id="item-skirting"></label>
                        <!-- <input type="text" readonly class="form-control" id="item-skirting"> -->
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="col-md-6">
                <label class="lock-string"><input type="checkbox" id="fixed" /> Bloquear en su lugar</label>
              </div>
              <div class="col-md-6" style="padding: 0px !important;"> 
                <button class="btn btn-block" id="context-menu-delete">
                  <span class="glyphicon glyphicon-trash"></span> 
                  Eliminar muebles
                </button>
              </div>
              <br /><br />
              <div class="form-group short-search-group" style="margin-top: 15px;">
                <div class="col-sm-7" style="margin-top: 5px;">
                  <input type="text" class="form-control" placeholder="Search..." id="short-search-box">
                </div>
                <div class="col-sm-5">
                  <button class="btn btn-block" id="short-menu-search">Buscar</button>
                </div>
              </div>
            </div>
            <br />
          </div>
          <br /><br />
          <!-- Short Key Menu-->
          <input type="hidden" id="short_menu_key" value="">
          <div id="shortkey-menu" style="overflow-y: scroll; max-height: 160px;">

          </div>

          <!-- Floor textures -->
          <div id="floorTexturesDiv" style="display:none; padding: 0 20px">
            <div class="panel panel-default">
              <div class="panel-heading">Ajustar piso</div>
              <div class="panel-body" id="floor_panel" style="color: #333333; overflow-y: scroll; max-height: 560px;">

              </div>
            </div>
          </div>

          <!-- Wall Textures -->
          <div id="wallTextures" style="display:none; padding: 0 20px">
            <div class="panel panel-default">
              <div class="panel-heading">Ajustar pared</div>
              <div class="panel-body" id="wall_panel" style="color: #333333; overflow-y: scroll; max-height: 560px;">
                
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column -->
        <div class="col-xs-9 main">

          <!-- 3D Viewer -->
          <div id="viewer">

            <div id="main-controls">
              <!-- <a class="btn btn-default btn-sm design" id="new">
                New Plan
              </a> -->
              <input type="hidden" name="user_type" id="user_type" value="<?php print_r($this->session->userdata('user_role')); ?>">
              <a class="btn btn-default btn-sm design1" id="productmodal" data-dismiss="modal" data-toggle="modal" data-target="#productnameModal">
                Save Plan
              </a>
              <a class="btn btn-default btn-sm design1" id="saveFile" style="display: none;">
                Save Plan
              </a>
              <a class="btn btn-default btn-sm design1" id="design1" data-toggle="modal" data-target="#confirmmodal" style="display: none;">
                Budget
              </a>
              <a class="btn btn-default btn-sm design2" data-toggle="modal" data-target="#customer_list_modal" style="display: none;">
                Budget
              </a>
              <!-- <a class="btn btn-sm btn-default btn-file design">
               <input type="file" class="hidden-input" id="loadFile">
               Load Plan
              </a> -->
              <label class="control-label" id="budget_label"></label>
              <label class="control-label pull-right" id="user_label"><?php print_r($this->session->userdata('userfname')); ?></label>
            </div>

            <div id="camera-controls">
              <a class="btn btn-default bottom camera_control" id="zoom-out">
                <span class="glyphicon glyphicon-zoom-out"></span>
              </a>
              <a class="btn btn-default bottom camera_control" id="reset-view">
                <span class="glyphicon glyphicon glyphicon-home"></span>
              </a>
              <a class="btn btn-default bottom camera_control" id="zoom-in">
                <span class="glyphicon glyphicon-zoom-in"></span>
              </a>
              
              <span>&nbsp;</span>

              <a class="btn btn-default bottom camera_control"  id="move-left" >
                <span class="glyphicon glyphicon-arrow-left"></span>
              </a>
              <span class="btn-group-vertical">
                <a class="btn btn-default camera_control"  id="move-up" style="margin-bottom: 5px;">
                  <span class="glyphicon glyphicon-arrow-up"></span>
                </a>
                <a class="btn btn-default camera_control"  id="move-down">
                  <span class="glyphicon glyphicon-arrow-down"></span>
                </a>
              </span>
              <a class="btn btn-default bottom camera_control"  id="move-right" >
                <span class="glyphicon glyphicon-arrow-right"></span>
              </a>
            </div>

            <div id="loading-modal">
              <h1>Cargando...</h1>  
            </div>
            <!-- confirm modal -->
            <div class="modal fade" id="confirmmodal" tabindex="-1" role="dialog" aria-labelledby="confirmmodalLabel">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label><h3>Do you want to add observation?</h3></label>
                    </div>       
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-info btn_show_observation px-3" data-dismiss="modal" data-toggle="modal" data-target="#observationmodal">Yes</button>
                  <button type="button" class="btn btn-sm btn-warning add_no px-3" id="budget" data-toggle="modal" data-target="#budgetmodal" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-sm btn-default" id="btn_close" data-dismiss="modal">Return</button>
                </div>
            </div>
            </div>
            </div>
            <!---------confirm modal---------->
            <!-- budget message modal -->
            <div class="modal fade" id="budgetmodal" tabindex="-1" role="dialog" aria-labelledby="budgetmodalLabel">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label><h3>Please go to your budgets menu to confirm it.</h3></label>
                    </div>       
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-default" id="btn_close" data-dismiss="modal">Cancel</button>
                  <a href="http://207.154.243.81/kitchen_planner/customer/main/budget" class="btn btn-warning btn-sm" target="_blank" style="color: red;">Go to budget menu</a>
                </div>
            </div>
            </div>
            </div>
            <!---------budget message modal---------->
            
          </div>

          <!-- 2D Floorplanner -->
          <div id="floorplanner">
            <canvas id="floorplanner-canvas"></canvas>
            <div id="floorplanner-controls">

              <button id="move" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-move"></span>
                Mover paredes
              </button>
              <button id="draw" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-pencil"></span>
                Dibujar paredes
              </button>
              <button id="delete" class="btn btn-sm btn-default">
                <span class="glyphicon glyphicon-remove"></span>
                Eliminar Pared
              </button>
              
              <!-- <span class="pull-right"> -->
                <button class="btn btn-primary btn-sm" id="update-floorplan">GUARDAR &raquo;</button>
              <!-- </span> -->

              <a class="btn btn-default btn-sm design" id="new" style="margin-left: 15%;">
                New Plan
              </a>
              <a class="btn btn-sm btn-default btn-file design">
                <input type="file" accept=".kitchenplanner" class="hidden-input" id="loadFile">
                Load Plan
              </a>

            </div>
            <div id="draw-walls-hint">
              Presiona la tecla "Esc" para dejar de dibujar muros
            </div>
          </div>
          <!-- customer_list modal -->
            <div class="modal fade" id="customer_list_modal" tabindex="-1" role="dialog" aria-labelledby="customer_list_modalLabel">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="uploadcsvfileLabel">Select Customer</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Customer List</label>
                      <select class="form-control" id="customer_list">
                      </select>
                    </div>       
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-info btn_customer_select px-3" id="select_customer" data-dismiss="modal" data-toggle="modal" data-target="#confirmmodal">Select</button>
                  <a href="http://207.154.243.81/kitchen_planner/customer/auth/register" target="_blank" class="btn btn-sm btn-warning add_no px-3" data-toggle="modal">New Customer</a>
                  <button type="button" class="btn btn-sm btn-default" id="btn_close" data-dismiss="modal">Return</button>
                </div>
            </div>
            </div>
            </div>
            <!---------customer_list modal---------->
            <!-- observation modal-->
            <div class="modal fade" id="observationmodal" tabindex="-1" role="dialog" aria-labelledby="observationmodalLabel">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-strip table-order">
                        <thead>
                          <tr>
                            <th>Furniture</th>
                            <th>Observation</th>  
                            <th>Summary</th>                          
                          </tr>
                        </thead>
                        <tbody id="observation_list">
                          
                        </tbody>
                      </table>
                    </div>       
                  </div> 
                </div>
                <div class="modal-footer">
                  <input type="hidden" id="summary_count">
                  <button type="button" class="btn btn-sm btn-default" id="btn_close" data-dismiss="modal">Return</button>
                  <button type="button" class="btn btn-sm btn-info observation_confirm px-3" id="budget1" data-dismiss="modal" data-toggle="modal" data-target="#budgetmodal">Confirm</button>
                </div>
            </div>
            </div>
            </div>
            <!--end of observation modal-->
            <!-- alert to floorplanner -->
            <div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="alertmodalLabel">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #ffa200;"><label style="color: white; font-size: x-large;">Notification</label></div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label><h3 style="color: #ffa200;">If you want to customize the floorplan, go to the floorplan!</h3></label>
                    </div>       
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-default btn_gen" style="color: white; background-color: #ffa200;" id="btn_gen" data-dismiss="modal">OK</button>
                </div>
            </div>
            </div>
            </div>
            <!-- end of the floorplanner -->
            <!-- alert to new planner -->
            <div class="modal fade" id="newplannermodal" tabindex="-1" role="dialog" aria-labelledby="newplannermodalLabel">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: red;"><label style="color: white; font-size: x-large;">Warning</label></div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <label><h3 style="color: #ffa200;">You can't create the new planner because your account is expired now!</h3></label>
                    </div>       
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-default" style="color: white; background-color: #ffa200;" data-dismiss="modal">Confirm</button>
                </div>
            </div>
            </div>
            </div>
            <!-- end of the new planner -->
            <!-- alert to product name -->
            <div class="modal fade" id="productnameModal" tabindex="-1" role="dialog" aria-labelledby="productnameModal">
            <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #ffa200;"><label style="color: white; font-size: x-large;">Product Name</label></div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label style="color: #ffa200;">Product Name</label>
                    </div>   
                    <div class="col-md-4">
                      <input type="text" name="gen_product_name" id="gen_product_name">
                    </div>    
                  </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-default" id="confirm_product" data-dismiss="modal">Confirm</button>
                </div>
            </div>
            </div>
            </div>
            <!-- end of the product name -->
          <!-- Add Items -->
          <div id="add-items">
            <div class="row" id="items-wrapper">

              <!-- Items added here by items.js -->
            </div>
            <div class="row" id="back-menu">

            </div>
          </div>
      
        </div>
        <!-- End Right Column -->
      </div>
    </div>

  </body>
</html>
<script type="text/javascript">
  function myFunc(){
    $.ajax({
      url: 'kitchen_planner/customer/planner/leave_planner',
      type: 'POST',
      headers: {'Access-Control-Allow-Origin': '*'},
      success: function(response) {
      }
    })
  }
  function detectCancel(){
    $.ajax({
      url: 'kitchen_planner/customer/planner/detect_planner',
      type: 'POST',
      headers: {'Access-Control-Allow-Origin': '*'},
      success: function(response) {
      }
    })
  }
  $(window).bind('beforeunload', function() {
      myFunc();
      setTimeout(function() {
        setTimeout(function() {
            detectCancel();
        }, 1000);
      },1);
      return 'are you sure';
  });
</script>
