
/*
 * Camera Buttons
 */

var CameraButtons = function(blueprint3d) {

  var orbitControls = blueprint3d.three.controls;
  var three = blueprint3d.three;

  var panSpeed = 30;
  var directions = {
    UP: 1,
    DOWN: 2,
    LEFT: 3,
    RIGHT: 4
  }

  function init() {
    // Camera controls
    $("#zoom-in").click(zoomIn);
    $("#zoom-out").click(zoomOut);  
    $("#zoom-in").dblclick(preventDefault);
    $("#zoom-out").dblclick(preventDefault);

    $("#reset-view").click(three.centerCamera)

    $("#move-left").click(function(){
      pan(directions.LEFT)
    })
    $("#move-right").click(function(){
      pan(directions.RIGHT)
    })
    $("#move-up").click(function(){
      pan(directions.UP)
    })
    $("#move-down").click(function(){
      pan(directions.DOWN)
    })

    $("#move-left").dblclick(preventDefault);
    $("#move-right").dblclick(preventDefault);
    $("#move-up").dblclick(preventDefault);
    $("#move-down").dblclick(preventDefault);
  }

  function preventDefault(e) {
    e.preventDefault();
    e.stopPropagation();
  }

  function pan(direction) {
    switch (direction) {
      case directions.UP:
        orbitControls.panXY(0, panSpeed);
        break;
      case directions.DOWN:
        orbitControls.panXY(0, -panSpeed);
        break;
      case directions.LEFT:
        orbitControls.panXY(panSpeed, 0);
        break;
      case directions.RIGHT:
        orbitControls.panXY(-panSpeed, 0);
        break;
    }
  }

  function zoomIn(e) {
    e.preventDefault();
    orbitControls.dollyIn(1.1);
    orbitControls.update();
  }

  function zoomOut(e) {
    e.preventDefault;
    orbitControls.dollyOut(1.1);
    orbitControls.update();
  }

  init();
}

/*
 * Context menu for selected item
 */ 

var ContextMenu = function(blueprint3d) {

  var scope = this;
  var selectedItem;
  var three = blueprint3d.three;

  function init() {
    $("#context-menu-delete").click(function(event) {
        selectedItem.remove();
    });
    $('#shortkey-menu').delegate('a.add-item', 'mousedown',function(e) {
      selectedItem.remove();
    });
    three.itemSelectedCallbacks.add(itemSelected);
    three.itemUnselectedCallbacks.add(itemUnselected);

    initResize();

    $("#fixed").click(function() {
        var checked = $(this).prop('checked');
        selectedItem.setFixed(checked);
    });
  }

  function cmToIn(cm) {
    return cm / 2.54;
  }

  function inToCm(inches) {
    return inches * 2.54;
  }

  function itemSelected(item) {
    selectedItem = item;
    $('#model_id').val(item.metadata.model_id);
    $('#short_menu_key').val(item.metadata.short_menu_key).trigger("change");;
    $("#context-menu-name").text(item.metadata.itemName);
    $('#item-countertop').text(item.metadata.itemCountertop);
    $('#item-exteriocolor').text(item.metadata.itemExteriocolor);
    $('#item-interiorcolor').text(item.metadata.itemInteriorcolor);
    $('#item-skirting').text(item.metadata.itemSkirting);
    // console.log($('#short_menu_key').val());
    // $("#item-width").val(cmToIn(selectedItem.getWidth()).toFixed(0));
    // $("#item-height").val(cmToIn(selectedItem.getHeight()).toFixed(0));
    // $("#item-depth").val(cmToIn(selectedItem.getDepth()).toFixed(0));
    $("#item-width").val(selectedItem.getWidth().toFixed(0));
    $("#item-height").val(selectedItem.getHeight().toFixed(0));
    $("#item-depth").val(selectedItem.getDepth().toFixed(0));

    $("#context-menu").show();
    $("#shortkey-menu").show();
    $("#fixed").prop('checked', item.fixed);
    $('.short-search-group').show();
    $('.search-group').hide();

    // $('#user_label').html('User: '+user_name);
  }

  function resize() {
    selectedItem.resize(
      // inToCm($("#item-height").val()),
      // inToCm($("#item-width").val()),
      // inToCm($("#item-depth").val())
      $("#item-height").val(),
      $("#item-width").val(),
      $("#item-depth").val()
    );
  }

  function initResize() {
    $("#item-height").change(resize);
    $("#item-width").change(resize);
    $("#item-depth").change(resize);
  }

  function itemUnselected() {
    selectedItem = null;
    $("#context-menu").hide();
    $("#shortkey-menu").hide();
  }

  init();
}

/*
 * Loading modal for items
 */

var ModalEffects = function(blueprint3d) {

  var scope = this;
  var blueprint3d = blueprint3d;
  var itemsLoading = 0;

  this.setActiveItem = function(active) {
    itemSelected = active;
    update();
  }

  function update() {
    if (itemsLoading > 0) {
      $("#loading-modal").show();
    } else {
      $("#loading-modal").hide();
    }
  }

  function init() {
    blueprint3d.model.scene.itemLoadingCallbacks.add(function() {
      itemsLoading += 1;
      update();
    });

     blueprint3d.model.scene.itemLoadedCallbacks.add(function() {
      itemsLoading -= 1;
      update();
    });   

    update();
  }

  init();
}

/*
 * Side menu
 */

var SideMenu = function(blueprint3d, floorplanControls, modalEffects) {
  var blueprint3d = blueprint3d;
  var floorplanControls = floorplanControls;
  var modalEffects = modalEffects;
  var selectedItem;
  var ACTIVE_CLASS = "active";

  var tabs = {
    "FLOORPLAN" : $("#floorplan_tab"),
    "SHOP" : $("#items_tab"),
    "DESIGN" : $("#design_tab")
  }

  var scope = this;
  this.stateChangeCallbacks = $.Callbacks();

  this.states = {
    "DEFAULT" : {
      "div" : $("#viewer"),
      "tab" : tabs.DESIGN
    },
    "FLOORPLAN" : {
      "div" : $("#floorplanner"),
      "tab" : tabs.FLOORPLAN
    }    ,
    "SHOP" : {
      "div" : $("#add-items"),
      "tab" : tabs.SHOP
    }
  }

  // sidebar state
  var currentState = scope.states.FLOORPLAN;

  function init() {
    for (var tab in tabs) {
      var elem = tabs[tab];
      elem.click(tabClicked(elem));
    }

    $("#update-floorplan").click(floorplanUpdate);
    $("#update-floorplan1").click(floorplanUpdate);

    initLeftMenu();

    blueprint3d.three.updateWindowSize();
    handleWindowResize();

    initItems();

    setCurrentState(scope.states.DEFAULT);
  }

  function floorplanUpdate() {
    setCurrentState(scope.states.DEFAULT);
  }

  function tabClicked(tab) {
    return function() {
      // Stop three from spinning
      blueprint3d.three.stopSpin();

      // Selected a new tab
      for (var key in scope.states) {
        var state = scope.states[key];
        if (state.tab == tab) {
          setCurrentState(state);
          break;
        }
      }
    }
  }
  
  function setCurrentState(newState) {

    if (currentState == newState) {
      return;
    }

    // show the right tab as active
    // if (currentState.tab !== newState.tab) {
      if (currentState.tab != null) {
        currentState.tab.removeClass(ACTIVE_CLASS);          
      }
      if (newState.tab != null) {
        newState.tab.addClass(ACTIVE_CLASS);
      }
    // }

    // set item unselected
    blueprint3d.three.getController().setSelectedObject(null);

    // show and hide the right divs
    currentState.div.hide()
    newState.div.show()

    // custom actions
    if (newState == scope.states.FLOORPLAN) {
      floorplanControls.updateFloorplanView();
      floorplanControls.handleWindowResize();
    } 

    if (currentState == scope.states.FLOORPLAN) {
      blueprint3d.model.floorplan.update();
    }

    if (newState == scope.states.DEFAULT) {
      blueprint3d.three.updateWindowSize();
    }
 
    // set new state
    handleWindowResize();    
    currentState = newState;

    scope.stateChangeCallbacks.fire(newState);
  }

  function initLeftMenu() {
    $( window ).resize( handleWindowResize );
    handleWindowResize();
  }

  function handleWindowResize() {
    // $(".sidebar").height(window.innerHeight);
    // $("#add-items").height(window.innerHeight);

  };

  // TODO: this doesn't really belong here
  function initItems() {
    $('#add-items').delegate('a.add-item', 'mousedown',function(e) {
      var modelUrl = $(this).attr("model-url");
      var itemType = parseInt($(this).attr("model-type"));
      var metadata = {
        model_id: $(this).attr("model_id"),
        short_menu_key: $(this).attr("short_menu_key"),
        itemName: $(this).attr("model-name"),
        itemCountertop: $(this).attr("model-countertop"),
        itemExteriocolor: $(this).attr("model-exteriocolor"),
        itemInteriorcolor: $(this).attr("model-interiorcolor"),
        itemSkirting: $(this).attr("model-skirting"),
        resizable: true,
        modelUrl: modelUrl,
        itemType: itemType
      }

      blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
      setCurrentState(scope.states.DEFAULT);
    });
    $('#shortkey-menu').delegate('a.add-item', 'mousedown',function(e) {
      // selectedItem.remove();
      var modelUrl = $(this).attr("model-url");
      var itemType = parseInt($(this).attr("model-type"));
      var metadata = {
        model_id: $(this).attr("model_id"),
        short_menu_key: $(this).attr("short_menu_key"),
        itemName: $(this).attr("model-name"),
        itemCountertop: $(this).attr("model-countertop"),
        itemExteriocolor: $(this).attr("model-exteriocolor"),
        itemInteriorcolor: $(this).attr("model-interiorcolor"),
        itemSkirting: $(this).attr("model-skirting"),
        resizable: true,
        modelUrl: modelUrl,
        itemType: itemType
      }

      blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
      setCurrentState(scope.states.DEFAULT);
    });
    // $("#add-items").find(".add-item").mousedown(function(e) {
    //   var modelUrl = $(this).attr("model-url");
    //   var itemType = parseInt($(this).attr("model-type"));
    //   var metadata = {
    //     itemName: $(this).attr("model-name"),
    //     resizable: true,
    //     modelUrl: modelUrl,
    //     itemType: itemType
    //   }

    //   blueprint3d.model.scene.addItem(itemType, modelUrl, metadata);
    //   setCurrentState(scope.states.DEFAULT);
    // });
  }

  init();

}

/*
 * Change floor and wall textures
 */

var TextureSelector = function (blueprint3d, sideMenu) {

  var scope = this;
  var three = blueprint3d.three;
  var isAdmin = isAdmin;

  var currentTarget = null;

  function initTextureSelectors() {
    $('.panel-body').delegate('a.texture-select-thumbnail', 'mousedown',function(e) {
      var textureUrl = $(this).attr("texture-url");
      var textureStretch = ($(this).attr("texture-stretch") == "true");
      var textureScale = parseInt($(this).attr("texture-scale"));
      currentTarget.setTexture(textureUrl, textureStretch, textureScale);

      e.preventDefault();
    });
  }

  function init() {
    $.ajax({
      url: 'customer/planner/get_wall_floor',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      success: function(response){
        var result = JSON.parse(response)
        var wall_data = result.wall_data
        var wall_html = '';
        for(var i = 0; i < wall_data.length; i++){
          wall_html += '<div class="col-sm-6" style="padding: 3px">'
                      +'<a class="thumbnail texture-select-thumbnail" texture-url="'+wall_data[i]['image']+'" texture-stretch="false" texture-scale="300">'
                      +'<img alt="Thumbnail light fine wood" src="'+wall_data[i]['image']+'" />'+wall_data[i]['name']+'</a></div>'
        }
        $("#wall_panel").append(wall_html);

        var floor_data = result.floor_data
        var floor_html = ''
        for(var j = 0; j < floor_data.length; j++){
          floor_html += '<div class="col-sm-6" style="padding: 3px">'
                       +'<a class="thumbnail texture-select-thumbnail" texture-url="'+floor_data[j]['image']+'" texture-stretch="false" texture-scale="300">'
                       +'<img alt="Thumbnail marbletiles" src="'+floor_data[j]['image']+'" />'+floor_data[j]['name']+'</a></div>'
        }
        floor_html += '</div></div>'
        $("#floor_panel").append(floor_html)

      }
    })
    three.wallClicked.add(wallClicked);
    three.floorClicked.add(floorClicked);
    three.itemSelectedCallbacks.add(reset);
    three.nothingClicked.add(reset);
    sideMenu.stateChangeCallbacks.add(reset);
    initTextureSelectors();
  }

  function wallClicked(halfEdge) {
    currentTarget = halfEdge;
    $("#floorTexturesDiv").hide();  
    $("#wallTextures").show();  
  }

  function floorClicked(room) {
    currentTarget = room;
    $("#wallTextures").hide();  
    $("#floorTexturesDiv").show();  
  }

  function reset() {
    $("#wallTextures").hide();  
    $("#floorTexturesDiv").hide();  
  }

  init();
}

/*
 * Floorplanner controls
 */

var ViewerFloorplanner = function(blueprint3d) {

  var canvasWrapper = '#floorplanner';

  // buttons
  var move = '#move';
  var remove = '#delete';
  var draw = '#draw';

  var activeStlye = 'btn-primary disabled';

  this.floorplanner = blueprint3d.floorplanner;

  var scope = this;

  function init() {

    $( window ).resize( scope.handleWindowResize );
    scope.handleWindowResize();

    // mode buttons
    scope.floorplanner.modeResetCallbacks.add(function(mode) {
      $(draw).removeClass(activeStlye);
      $(remove).removeClass(activeStlye);
      $(move).removeClass(activeStlye);
      if (mode == BP3D.Floorplanner.floorplannerModes.MOVE) {
          $(move).addClass(activeStlye);
      } else if (mode == BP3D.Floorplanner.floorplannerModes.DRAW) {
          $(draw).addClass(activeStlye);
      } else if (mode == BP3D.Floorplanner.floorplannerModes.DELETE) {
          $(remove).addClass(activeStlye);
      }

      if (mode == BP3D.Floorplanner.floorplannerModes.DRAW) {
        $("#draw-walls-hint").show();
        scope.handleWindowResize();
      } else {
        $("#draw-walls-hint").hide();
      }
    });

    $(move).click(function(){
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.MOVE);
    });

    $(draw).click(function(){
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.DRAW);
    });

    $(remove).click(function(){
      scope.floorplanner.setMode(BP3D.Floorplanner.floorplannerModes.DELETE);
    });
  }

  this.updateFloorplanView = function() {
    scope.floorplanner.reset();
  }

  this.handleWindowResize = function() {
    $(canvasWrapper).height(window.innerHeight - $(canvasWrapper).offset().top);
    scope.floorplanner.resizeView();
  };

  init();
}; 

var mainControls = function(blueprint3d) {
  var blueprint3d = blueprint3d;

  function newDesign() {
    var data = blueprint3d.model.exportSerialized();
    var filename = $('#product_name').val()

    $.ajax({
      url: 'customer/planner/validation_count',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      data: {content: data, filename: filename},
      success: function(response){
        var result = JSON.parse(response)
        if(result){
          // blueprint3d.model.loadSerialized('{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":204.85099999999989,"y":289.052},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":672.2109999999999,"y":289.052},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":672.2109999999999,"y":-178.308},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":204.85099999999989,"y":-178.308}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
          blueprint3d.model.loadSerialized('{"floorplan":{"corners":{},"walls":[],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
        }else{
          // alert("You can't create the new planner because your account is expired now.");
          $('#expiredmodal').modal('show');
          return;
        }
      }
    })
  }

  function loadDesign() {
    files = $("#loadFile").get(0).files;
    var reader  = new FileReader();
    reader.onload = function(event) {
        var data = event.target.result;
        blueprint3d.model.loadSerialized(data);
    }
    reader.readAsText(files[0]);
    $('#design_tab').click();
  }
  function load_Design(data) {
    blueprint3d.model.loadSerialized(data.contents);
    if(data.check_order == 2){
      $('#saveFile').hide();
    }
    $('#product_name').val(data.product_name.split('-')[0])
  }

  function saveDesign() {
    var data = blueprint3d.model.exportSerialized();
    // var a = window.document.createElement('a');
    // var blob = new Blob([data], {type : 'text'});
    // a.href = window.URL.createObjectURL(blob);
    // var filename = 'design'+year+'-'+month+'-'+day+'-'+hour+'-'+minute+'-'+second+'.kitchenplanner';
    var filename = $('#product_name').val();
    var product_id = $('#product_id').val();
    // a.download = filename;
    // document.body.appendChild(a)
    // a.click();
    // document.body.removeChild(a)
    //insert the product row when click the save button.
    save_result_product_table(data, filename, product_id);
    var user_type = $('#user_type').val();
    if(user_type == 1){
      $('#design1').show();
      $('.design2').hide();
    }else if(user_type == 2){
      $('#design1').hide();
      $('.design2').show();
    }
    
  }

  function getBudget(){
    var data = JSON.parse(blueprint3d.model.exportSerialized());
    var product_id = $('#product_id').val();
    var customer_id = 0;
    if($('#customer_list').val()){
      customer_id = $('#customer_list').val();
    }
    var summary_count = $('#summary_count').val();
    var summary_arr = {
        model_id: {},
        summary: {}
    };
    var summary_arr = []
    for(var i = 0; i < summary_count; i++){
      if (!summary_arr[i])
      {
        summary_arr[i] = {model_id: '', summary: ''}
      }
      summary_arr[i].model_id = $('#summary'+i).attr('model_id');
      summary_arr[i].summary = $('#summary'+i).val();
    }
    $.ajax({
      url: 'customer/planner/get_budget',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      data: {req_data: data, product_id: product_id, customer_id: customer_id, summary_arr: summary_arr},
      success: function(response){
        console.log(response)
        var result = JSON.parse(response)
        $('#budget_label').show();
        $('#budget_label').html('Total Furniture Cost: '+(result.total_furniture_cost).toFixed(2)+'EUR,   Total Extra Cost: '+(result.total_extra_cost).toFixed(2)+'EUR')
        
        setTimeout(function(){
          $('#budget_label').hide()
        }, 5000)
      }
    })
  }

  function init() {
    $("#new").click(newDesign);
    $("#loadFile").change(loadDesign);
    $("#saveFile").click(saveDesign);
    $("#budget").click(getBudget);
    $("#budget1").click(getBudget);
    var product_id = $('#product_id').val();
    if(product_id != 0){
      $('.goto3DModal').hide()
      $('.goto3DButton').show()
      $.ajax({
        url: 'customer/planner/load_product',
        headers: {'Access-Control-Allow-Origin': '*'},
        type: 'POST',
        data: {product_id: product_id},
        success: function(response){
          var result = JSON.parse(response)
          load_Design(result);
        }
      })
    }
  }

  init();
  function save_result_product_table(content, filename, product_id)
  {
    var data = JSON.parse(content);
    var items = data.items;
    if(items.length > 0)
    {
      $.ajax({
        url: 'customer/planner/save_product',
        headers: {'Access-Control-Allow-Origin': '*'},
        type: 'POST',
        data: {req_data: content, filename: filename, product_id: product_id},
        success: function(response){
          var product_id = JSON.parse(response)
          $('#product_id').val(product_id)
          // $('#observ_product_id')
        }
      })
    }
  }
}

/*
 * Initialize!
 */

$(document).ready(function() {

  // main setup
  var opts = {
    floorplannerElement: 'floorplanner-canvas',
    threeElement: '#viewer',
    threeCanvasElement: 'three-canvas',
    textureDir: "planner/models/textures/",
    widget: false
  }
  var blueprint3d = new BP3D.Blueprint3d(opts);

  var modalEffects = new ModalEffects(blueprint3d);
  var viewerFloorplanner = new ViewerFloorplanner(blueprint3d);
  var contextMenu = new ContextMenu(blueprint3d);
  var sideMenu = new SideMenu(blueprint3d, viewerFloorplanner, modalEffects);
  var textureSelector = new TextureSelector(blueprint3d, sideMenu);        
  var cameraButtons = new CameraButtons(blueprint3d);
  mainControls(blueprint3d);

  // This serialization format needs work
  // Load a simple rectangle room
  // blueprint3d.model.loadSerialized('{"floorplan":{"corners":{"f90da5e3-9e0e-eba7-173d-eb0b071e838e":{"x":204.85099999999989,"y":289.052},"da026c08-d76a-a944-8e7b-096b752da9ed":{"x":672.2109999999999,"y":289.052},"4e3d65cb-54c0-0681-28bf-bddcc7bdb571":{"x":672.2109999999999,"y":-178.308},"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2":{"x":204.85099999999989,"y":-178.308}},"walls":[{"corner1":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","corner2":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"f90da5e3-9e0e-eba7-173d-eb0b071e838e","corner2":"da026c08-d76a-a944-8e7b-096b752da9ed","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"da026c08-d76a-a944-8e7b-096b752da9ed","corner2":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}},{"corner1":"4e3d65cb-54c0-0681-28bf-bddcc7bdb571","corner2":"71d4f128-ae80-3d58-9bd2-711c6ce6cdf2","frontTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0},"backTexture":{"url":"assets/design/planner/rooms/textures/wallmap.png","stretch":true,"scale":0}}],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
  blueprint3d.model.loadSerialized('{"floorplan":{"corners":{},"walls":[],"wallTextures":[],"floorTextures":{},"newFloorTextures":{}},"items":[]}');
});
