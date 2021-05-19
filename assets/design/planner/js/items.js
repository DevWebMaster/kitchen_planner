// add items to the "Add Items" tab
$(document).ready(function() {
  $('#alertmodal').modal('show');
  $('#btn_gen').click(function(){
    $('#floorplan_tab').click()
  })

  $('#confirm_product').click(function(){
    if($('#gen_product_name').val()){
      $('#product_name').val($('#gen_product_name').val())
      $('#saveFile').click()
    }else{
      alert("please insert the Product Name to save it.")
    }
  })

  $.ajax({
    url: 'kitchen_planner/customer/planner/get_user_name',
    type: 'POST',
    headers: {'Access-Control-Allow-Origin': '*'},
    success: function(response){
      var result = JSON.parse(response)
      if(result.user_role == 1){
        $('#user_label').html('Customer: '+result.userfname);
      }if(result.user_role == 2){
        $('#user_label').html('POS: '+result.userfname);
      }
      
    }
  })

  var global_main_id = 0;
  var global_sub_id = 0;
  $('.search-group').hide();
  $('.short-search-group').hide();
  var btn_back_level = 0;
  var itemsDiv = $("#items-wrapper")
  $.ajax({
    url: 'kitchen_planner/customer/planner/get_main_menu',
    headers: {'Access-Control-Allow-Origin': '*'},
    type: 'POST',
    success: function(response){
      // console.log(data.data);
      var main_menu = JSON.parse(response);
      for(var inx = 0; inx < main_menu.length; inx++){
        var main_html = '<div class="col-sm-4 menu-div" id="'+main_menu[inx].id+'">' +
                      '<a class="thumbnail select-menu" style="border-color: #ffa200; color: #ffa200;"><img src="' +
                      main_menu[inx].image + 
                      '" alt="Select Menu"> '+
                      main_menu[inx].name +
                      '</a></div>';
          itemsDiv.append(main_html);
      }
    }
  })
  
  $('div').delegate('a.select-menu', 'click',function() {  //click the main menu
    $('.search-group').hide();
    $('.short-search-group').hide();
    itemsDiv.empty();
    var main_menu_id = $(this).parents('div').attr('id');
    $.ajax({
      url: 'kitchen_planner/customer/planner/get_sub_menu',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      data: {main_menu_id: main_menu_id},
      success: function(response){
        var sub_menu = JSON.parse(response)
        if(sub_menu && sub_menu.length > 0){
          for (var j = 0; j < sub_menu.length; j++) {                                                                                                                  
            var sub_html = '<div class="col-sm-4 menu-div" id="'+sub_menu[j].main_id+'-'+sub_menu[j].id+'">' +
                        '<a class="thumbnail select-submenu" style="border-color: #ffa200; color: #ffa200;"><img src="' +
                        sub_menu[j].image + 
                        '" alt="Select Menu"> '+
                        sub_menu[j].name +
                        '</a></div>';
            itemsDiv.append(sub_html);
          }
          btn_back_level = 1;
          var btn_back = '<button class="btn btn-sm btn-default" id="btn_back">Atrás</button>';
          $("#back-menu").append(btn_back);
        }else{
          btn_back_level = 1;
          var btn_back = '<button class="btn btn-sm btn-default" id="btn_back">Atrás</button>';
          $("#back-menu").append(btn_back);
        }
      }
    })
  });
  var old_status = '';
  $('#short_menu_key').change(function(){
    var new_status = $('#short_menu_key').val();
    console.log("short_menu_key: "+$('#short_menu_key').val());
    var main_id = global_main_id = new_status.split('-')[0];
    var sub_id = global_sub_id = new_status.split('-')[1];
    $.ajax({
      url: 'kitchen_planner/customer/planner/get_shortkey_menu',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      data: {main_id: main_id, sub_id: sub_id},
      success: function(response){
        var shortkey_menu = JSON.parse(response)
        if(shortkey_menu && shortkey_menu.length > 0 && old_status != new_status){
          $('#shortkey-menu').empty();
          for (var i = 0; i < shortkey_menu.length; i++) {
            if(shortkey_menu[i].name.length > 8){
              shortkey_menu[i].name = shortkey_menu[i].name.slice(0, 8)+' ...';
            }
            var html = '<div class="col-sm-4">' +
                        '<a class="thumbnail add-item" style="border-color: #ffa200; color: #ffa200;" model-name="' + 
                        shortkey_menu[i].name + 
                        '" model_id="' +
                        shortkey_menu[i].model_id +
                        '" short_menu_key="' +
                        shortkey_menu[i].main_id + '-' + shortkey_menu[i].sub_id +
                        '" model-url="' +
                        shortkey_menu[i].model +
                        '" model-countertop="' +
                        shortkey_menu[i].countertop_type + ' - ' + shortkey_menu[i].countertop_color +
                        '" model-exteriocolor="' +
                        shortkey_menu[i].exterio_color +
                        '" model-interiorcolor="' +
                        shortkey_menu[i].interior_color +
                        '" model-skirting="' +
                        shortkey_menu[i].skirting_type + ' - ' + shortkey_menu[i].skirting_color +
                        '" model-type="' +
                        shortkey_menu[i].type + 
                        '"><img src="' +
                        shortkey_menu[i].image + 
                        '"> '+
                        shortkey_menu[i].name +
                        // '<span class="tooltiptext">' +
                        // '<b>Countertop Type: </b>' +
                        // shortkey_menu[i].countertop_type +
                        // '<br><b>Countertop Color: </b>' +
                        // shortkey_menu[i].countertop_color +
                        // '<br><b>Exterio Color: </b>' +
                        // shortkey_menu[i].exterio_color +
                        // '<br><b>Interior Color: </b>' +
                        // shortkey_menu[i].interior_color +
                        // '<br><b>Skirting Color: </b>' +
                        // shortkey_menu[i].skirting_color +
                        // '<br><b>Skirting Type: </b>' +
                        // shortkey_menu[i].skirting_type +
                        // '<br><b>Dooropen Type: </b>' +
                        // shortkey_menu[i].dooropen_type +
                        // '<br><b>Door Thickness: </b>' +
                        // shortkey_menu[i].door_thickness +
                        // '<br><b>Furniture Price: </b>' +
                        // shortkey_menu[i].furniture_price + 'EUR' +
                        // '<br><b>Countertio Price: </b>' +
                        // (shortkey_menu[i].countertop_type_price+
                        //  shortkey_menu[i].countertop_color_price+
                        //  shortkey_menu[i].skirting_type_price+
                        //  shortkey_menu[i].skirting_color_price+
                        //  shortkey_menu[i].exterio_color_price+
                        //  shortkey_menu[i].interior_color_price+
                        //  shortkey_menu[i].dooropen_type_price+
                        //  shortkey_menu[i].door_thickness_price+
                        //  shortkey_menu[i].furniture_price) + 'EUR' +
                        // '</span>' +
                        '</a></div>';
            $('#shortkey-menu').append(html);
          }
          old_status = new_status;
        }
      }
    })
  });
  
  $('div').delegate('a.select-submenu', 'click',function() {
    var tmp_id = $(this).parents('div').attr('id');
    var sub_id = global_sub_id = tmp_id.split('-')[1];
    var main_id = global_main_id = tmp_id.split('-')[0];
    itemsDiv.empty();
    $('#shortkey-menu').empty();
    $.ajax({
      url: 'kitchen_planner/customer/planner/get_thumbnail_menu',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      data: {main_id: main_id, sub_id: sub_id},
      success: function(response){
        $('.search-group').show();
        $('.short-search-group').hide();
        var thumbnail_menu = JSON.parse(response)
        if(thumbnail_menu && thumbnail_menu.length > 0){
          for (var i = 0; i < thumbnail_menu.length; i++) {
            var html = '<div class="col-sm-4">' +
                        '<a class="thumbnail add-item" style="border-color: #ffa200; color: #ffa200;" model-name="' + 
                        thumbnail_menu[i].name + 
                        '" model_id="' +
                        thumbnail_menu[i].model_id +
                        '" short_menu_key="' +
                        thumbnail_menu[i].main_id + '-' + thumbnail_menu[i].sub_id +
                        '" model-url="' +
                        thumbnail_menu[i].model +
                        '" model-countertop="' +
                        thumbnail_menu[i].countertop_type + ' - ' + thumbnail_menu[i].countertop_color +
                        '" model-exteriocolor="' +
                        thumbnail_menu[i].exterio_color +
                        '" model-interiorcolor="' +
                        thumbnail_menu[i].interior_color +
                        '" model-skirting="' +
                        thumbnail_menu[i].skirting_type + ' - ' + thumbnail_menu[i].skirting_color +
                        '" model-type="' +
                        thumbnail_menu[i].type + 
                        '"><img src="' +
                        thumbnail_menu[i].image + 
                        '" alt="Add Item"> '+
                        thumbnail_menu[i].name +
                        '<span class="tooltiptext">' +
                        '<b>Countertop Type: </b>' +
                        thumbnail_menu[i].countertop_type +
                        '<br><b>Countertop Color: </b>' +
                        thumbnail_menu[i].countertop_color +
                        '<br><b>Exterio Color: </b>' +
                        thumbnail_menu[i].exterio_color +
                        '<br><b>Interior Color: </b>' +
                        thumbnail_menu[i].interior_color +
                        '<br><b>Skirting Color: </b>' +
                        thumbnail_menu[i].skirting_color +
                        '<br><b>Skirting Type: </b>' +
                        thumbnail_menu[i].skirting_type +
                        '<br><b>Dooropen Type: </b>' +
                        thumbnail_menu[i].dooropen_type +
                        '<br><b>Door Thickness: </b>' +
                        thumbnail_menu[i].door_thickness +
                        '<br><b>Furniture Price: </b>' +
                        thumbnail_menu[i].furniture_price + 'EUR' +
                        '<br><b>Countertio Price: </b>' +
                        (thumbnail_menu[i].countertop_type_price+
                         thumbnail_menu[i].countertop_color_price+
                         thumbnail_menu[i].skirting_type_price+
                         thumbnail_menu[i].skirting_color_price+
                         thumbnail_menu[i].exterio_color_price+
                         thumbnail_menu[i].interior_color_price+
                         thumbnail_menu[i].dooropen_type_price+
                         thumbnail_menu[i].door_thickness_price+
                         thumbnail_menu[i].furniture_price) + 'EUR' +
                        '</span>' +
                        '</a></div>';
            itemsDiv.append(html);
            $('#shortkey-menu').append(html);
          }
          $("#btn_back").remove();
          btn_back_level = 2;
          var btn_back = '<button class="btn btn-sm btn-default btn_back" id="btn_back" name="'+thumbnail_menu[0].main_id+'-'+thumbnail_menu[0].sub_id+'">Atrás</button>';
          $("#back-menu").append(btn_back);
        }else{
          $("#btn_back").remove();
          btn_back_level = 2;
          var btn_back = '<button class="btn btn-sm btn-default btn_back" id="btn_back" name="'+main_id+'-'+sub_id+'">Atrás</button>';
          $("#back-menu").append(btn_back);
        }
      }
    })
    
  });
  $('div#back-menu').delegate('button#btn_back', 'click',function() {
    $('.search-group').hide();
    $('.short-search-group').hide();
    if(btn_back_level == 1){
      itemsDiv.empty();
      $.ajax({
        url: 'kitchen_planner/customer/planner/get_main_menu',
        headers: {'Access-Control-Allow-Origin': '*'},
        type: 'POST',
        success: function(response){
          // console.log(data.data);
          var main_menu = JSON.parse(response);
          for(var inx = 0; inx < main_menu.length; inx++){
            var html_main_clone = '<div class="col-sm-4 menu-div" id="'+main_menu[inx].id+'">' +
                          '<a class="thumbnail select-menu" style="border-color: #ffa200; color: #ffa200;"><img src="' +
                          main_menu[inx].image + 
                          '" alt="Select Menu"> '+
                          main_menu[inx].name +
                          '</a></div>';
              itemsDiv.append(html_main_clone);
          }
          $("#btn_back").remove();
        }
      })
    }
    else if(btn_back_level == 2){
      itemsDiv.empty();
      
      var btn_id = $(this).attr('name');
      var main_id = btn_id.split('-')[0];
      $.ajax({
        url: 'kitchen_planner/customer/planner/get_sub_menu',
        headers: {'Access-Control-Allow-Origin': '*'},
        type: 'POST',
        data: {main_menu_id: main_id},
        success: function(response){
          var sub_menu = JSON.parse(response)
          if(sub_menu && sub_menu.length > 0){
            for(var inx = 0; inx < sub_menu.length; inx++){
              var html_sub_clone = '<div class="col-sm-4 menu-div" id="'+sub_menu[inx].main_id+'-'+sub_menu[inx].id+'">' +
                            '<a class="thumbnail select-submenu" style="border-color: #ffa200; color: #ffa200;"><img src="' +
                            sub_menu[inx].image + 
                            '" alt="Select Menu"> '+
                            sub_menu[inx].name +
                            '</a></div>';
                itemsDiv.append(html_sub_clone);
            }
            $('#btn_back').remove();
            btn_back_level = 1;
            var btn_back = '<button class="btn btn-sm btn-default" id="btn_back">Atrás</button>';
            $("#back-menu").append(btn_back);
          }
        }
      });
    }

  });
  $('#context-menu-search').click(function(){
    var search_str = $('#search-box').val();
    itemsDiv.empty();
    $('#shortkey-menu').empty();
    get_search_result(global_main_id, global_sub_id, search_str);
  })
  $('#short-menu-search').click(function(){
    var search_str = $('#short-search-box').val();
    itemsDiv.empty();
    $('#shortkey-menu').empty();
    get_search_result(global_main_id, global_sub_id, search_str);
  })
  function get_search_result(main_id, sub_id, search_str){
    $.ajax({
      url: 'kitchen_planner/customer/planner/get_thumbnail_menu',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      data: {main_id: main_id, sub_id: sub_id, search_str: search_str},
      success: function(response){
        var thumbnail_menu = JSON.parse(response)
        if(thumbnail_menu && thumbnail_menu.length > 0){
          for (var i = 0; i < thumbnail_menu.length; i++) {
            var html = '<div class="col-sm-4">' +
                        '<a class="thumbnail add-item" style="border-color: #ffa200; color: #ffa200;" model-name="' + 
                        thumbnail_menu[i].name + 
                        '" model_id="' +
                        thumbnail_menu[i].model_id +
                        '" short_menu_key="' +
                        thumbnail_menu[i].main_id + '-' + thumbnail_menu[i].sub_id +
                        '" model-url="' +
                        thumbnail_menu[i].model +
                        '" model-countertop="' +
                        thumbnail_menu[i].countertop_type + '-' + thumbnail_menu[i].countertop_color +
                        '" model-countertop_color="' +
                        thumbnail_menu[i].countertop_color +
                        '" model-exteriocolor="' +
                        thumbnail_menu[i].exterio_color +
                        '" model-interiorcolor="' +
                        thumbnail_menu[i].interior_color +
                        '" model-skirting="' +
                        thumbnail_menu[i].skirting_type + '-' + thumbnail_menu[i].skirting_color +
                        '" model-type="' +
                        thumbnail_menu[i].type + 
                        '"><img src="' +
                        thumbnail_menu[i].image + 
                        '" alt="Add Item"> '+
                        thumbnail_menu[i].name +
                        '<span class="tooltiptext">' +
                        '<b>Countertop Type: </b>' +
                        thumbnail_menu[i].countertop_type +
                        '<br><b>Countertop Color: </b>' +
                        thumbnail_menu[i].countertop_color +
                        '<br><b>Exterio Color: </b>' +
                        thumbnail_menu[i].exterio_color +
                        '<br><b>Interior Color: </b>' +
                        thumbnail_menu[i].interior_color +
                        '<br><b>Skirting Color: </b>' +
                        thumbnail_menu[i].skirting_color +
                        '<br><b>Skirting Type: </b>' +
                        thumbnail_menu[i].skirting_type +
                        '<br><b>Dooropen Type: </b>' +
                        thumbnail_menu[i].dooropen_type +
                        '<br><b>Door Thickness: </b>' +
                        thumbnail_menu[i].door_thickness +
                        '<br><b>Furniture Price: </b>' +
                        thumbnail_menu[i].furniture_price + 'EUR' +
                        '<br><b>Countertio Price: </b>' +
                        (thumbnail_menu[i].countertop_type_price+
                         thumbnail_menu[i].countertop_color_price+
                         thumbnail_menu[i].skirting_type_price+
                         thumbnail_menu[i].skirting_color_price+
                         thumbnail_menu[i].exterio_color_price+
                         thumbnail_menu[i].interior_color_price+
                         thumbnail_menu[i].dooropen_type_price+
                         thumbnail_menu[i].door_thickness_price+
                         thumbnail_menu[i].furniture_price) + 'EUR' +
                        '</span>' +
                        '</a></div>';
            itemsDiv.append(html);
            $('#shortkey-menu').append(html);
            $('#search-box').val('');
            console.log(html)
          }
          $("#btn_back").remove();
          btn_back_level = 2;
          var btn_back = '<button class="btn btn-sm btn-default btn_back" id="btn_back" name="'+thumbnail_menu[0].main_id+'-'+thumbnail_menu[0].sub_id+'">Atrás</button>';
          $("#back-menu").append(btn_back);
        }else{
          $("#btn_back").remove();
          btn_back_level = 2;
          var btn_back = '<button class="btn btn-sm btn-default btn_back" id="btn_back" name="'+main_id+'-'+sub_id+'">Atrás</button>';
          $("#back-menu").append(btn_back);
        }
      }
    })
  }
  $('.btn_show_observation').click(function(){
    var product_id = $('#product_id').val();
    $.ajax({
      url: 'kitchen_planner/customer/planner/get_observation',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      data: {product_id: product_id},
      success: function(response){
        console.log(response);
        var furnitures = JSON.parse(response);
        var html = '';
        for(var i = 0; i < furnitures.length; i++){
          html += '<tr>'+
                     '<td>'+furnitures[i].name+'</td>'+
                     '<td>'+'countertop Type: '+furnitures[i].countertop_type+', Countertop Color: '+furnitures[i].countertop_color+', Skirting Type: '+furnitures[i].skirting_type+', Skirting Color: '+furnitures[i].skirting_color+', Exterio Color: '+furnitures[i].exterio_color+', Interior Color: '+furnitures[i].interior_color+', Dooropen Type: '+furnitures[i].dooropen_type+', Door Thickness: '+furnitures[i].door_thickness+'</td>'+
                     '<td><textarea id="summary'+i+'" model_id="'+furnitures[i].model_id+'" rows="4" class="form-control" style="width: 150px;"></textarea></td>'+
                    '</tr>';

        }
        $('#observation_list').html(html);
        $('#summary_count').val(furnitures.length);
       
      }
    })
  });

  $('.design2').click(function(){
    $.ajax({
      url: 'kitchen_planner/customer/planner/get_customer',
      headers: {'Access-Control-Allow-Origin': '*'},
      type: 'POST',
      success: function(response){
        console.log(response);
        var customers = JSON.parse(response);
        $('#customer_list').empty();
        var html = '';
        for(var i = 0; i < customers.length; i++){
          html += '<option value="'+customers[i].id+'">'+customers[i].name+'</option>';
        }
        $('#customer_list').append(html);
        console.log(html);
      }
    })
  })
});