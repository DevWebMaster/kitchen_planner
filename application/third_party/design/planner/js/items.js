// add items to the "Add Items" tab
$(document).ready(function() {
  var url_str = window.location.search;
  if(url_str != '' && url_str != 'undefined'){
    var user_id_tmp = url_str.split('=')[1];
    var user_id = user_id_tmp.split('-')[0];
    // var product_id = user_id_tmp.split('-')[1];
    // if(product_id != 0){
    //   $.ajax({
    //     url: '/load_product',
    //     type: 'POST',
    //     data: JSON.stringify({product_id: product_id}),
    //     contentType: 'application/json',
    //     success: function(response){
    //       // console.log(response.data);
    //       // load_Design(response.data[0].product_name);
    //       $('#load_data').val(response.data);
    //       // console.log("123")
    //     }
    //   })
    // }
    if(user_id == 'admin'){
      $('#user_label').html('Admin User');
      localStorage.setItem("g_current_user_id", 'Admin User');
    }else{
      var prefix = url_str.split('=')[0];
      if(prefix == '?customer_id'){
        var user_flag = 1;
      }else if(prefix == '?pos_id'){
        var user_flag = 2;
      }
      localStorage.setItem("g_current_user_id", user_id);
      localStorage.setItem("g_current_user_type", user_flag);
      var req_data = {};
      req_data.user_id = user_id;
      req_data.user_flag = user_flag;
      $.ajax({
        url: '/get_user_name',
        type: 'POST',
        data: JSON.stringify(req_data),
        contentType: 'application/json',
        success: function(response){
          // console.log(response.data[0].user_name);
          localStorage.setItem("g_current_user_name", response.data[0].user_name);
          if(user_flag == 1){
            $('#user_label').html('Customer: '+response.data[0].user_name);
          }if(user_flag == 2){
            $('#user_label').html('POS: '+response.data[0].user_name);
          }
          
        }
      })
    }
  }

  var global_main_id = 0;
  var global_sub_id = 0;
  $('.search-group').hide();
  $('.short-search-group').hide();
  var btn_back_level = 0;
  var itemsDiv = $("#items-wrapper")
  $.ajax({
    url: '/get_main_menu',
    type: 'POST',
    success: function(response){
      // console.log(data.data);
      var main_main = response.data;
      for(var inx = 0; inx < main_main.length; inx++){
        var main_html = '<div class="col-sm-4 menu-div" id="'+(inx+1)+'">' +
                      '<a class="thumbnail select-menu" style="border-color: #ffa200; color: #ffa200;"><img src="' +
                      main_main[inx].image + 
                      '" alt="Select Menu"> '+
                      main_main[inx].name +
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
    var req_data = {};
    req_data.main_menu_id = main_menu_id;
    $.ajax({
      url: '/get_sub_menu',
      type: 'POST',
      data: JSON.stringify(req_data),
      contentType: 'application/json',
      success: function(response){
        var sub_menu = response.data
        if(sub_menu && sub_menu.length > 0){
          for (var j = 0; j < sub_menu.length; j++) {                                                                                                                  
            var sub_html = '<div class="col-sm-4 menu-div" id="'+sub_menu[j].main_id+'-'+(j+1)+'">' +
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
    var req_data = {};
    req_data.main_id = main_id;
    req_data.sub_id = sub_id;
    $.ajax({
      url: '/get_shortkey_menu',
      type: 'POST',
      data: JSON.stringify(req_data),
      contentType: 'application/json',
      success: function(response){
        var shortkey_menu = response.data
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
    var req_data = {};
    req_data.main_id = main_id;
    req_data.sub_id = sub_id;
    itemsDiv.empty();
    $('#shortkey-menu').empty();
    $.ajax({
      url: '/get_thumbnail_menu',
      type: 'POST',
      data: JSON.stringify(req_data),
      contentType: 'application/json',
      success: function(response){
        $('.search-group').show();
        $('.short-search-group').hide();
        console.log(response);
        var thumbnail_menu = response.data
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
          var btn_back = '<button class="btn btn-sm btn-default btn_back" id="btn_back" name="'+thumbnail_menu[0].main_id+'-'+thumbnail_menu[0].sub_id+'">Atrás</button>';
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
        url: '/get_main_menu',
        type: 'POST',
        success: function(response){
          // console.log(data.data);
          var main_main = response.data;
          for(var inx = 0; inx < main_main.length; inx++){
            var html_main_clone = '<div class="col-sm-4 menu-div" id="'+(inx+1)+'">' +
                          '<a class="thumbnail select-menu" style="border-color: #ffa200; color: #ffa200;"><img src="' +
                          main_main[inx].image + 
                          '" alt="Select Menu"> '+
                          main_main[inx].name +
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
      var req_data = {};
      req_data.main_menu_id = main_id;
      console.log("main_id: "+main_id);
      $.ajax({
        url: '/get_sub_menu',
        type: 'POST',
        data: JSON.stringify(req_data),
        contentType: 'application/json',
        success: function(response){
          var sub_menu = response.data
          if(sub_menu && sub_menu.length > 0){
            for(var inx = 0; inx < sub_menu.length; inx++){
              var html_sub_clone = '<div class="col-sm-4 menu-div" id="'+sub_menu[inx].main_id+'-'+(inx+1)+'">' +
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
    var req_data = {};
    req_data.main_id = global_main_id;
    req_data.sub_id = global_sub_id;
    req_data.search_str = search_str;
    itemsDiv.empty();
    $('#shortkey-menu').empty();
    get_search_result(req_data);
  })
  $('#short-menu-search').click(function(){
    var search_str = $('#short-search-box').val();
    var req_data = {};
    req_data.main_id = global_main_id;
    req_data.sub_id = global_sub_id;
    req_data.search_str = search_str;
    itemsDiv.empty();
    $('#shortkey-menu').empty();
    get_search_result(req_data);
  })
  function get_search_result(search_data){
    $.ajax({
      url: '/get_thumbnail_menu',
      type: 'POST',
      data: JSON.stringify(search_data),
      contentType: 'application/json',
      success: function(response){
        var thumbnail_menu = response.data
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
          }
          $("#btn_back").remove();
          btn_back_level = 2;
          var btn_back = '<button class="btn btn-sm btn-default btn_back" id="btn_back" name="'+thumbnail_menu[0].main_id+'-'+thumbnail_menu[0].sub_id+'">Atrás</button>';
          $("#back-menu").append(btn_back);
        }else{
          $("#btn_back").remove();
          btn_back_level = 2;
          var btn_back = '<button class="btn btn-sm btn-default btn_back" id="btn_back" name="'+thumbnail_menu[0].main_id+'-'+thumbnail_menu[0].sub_id+'">Atrás</button>';
          $("#back-menu").append(btn_back);
        }
      }
    })
  }
  $('.btn_show_observation').click(function(){
    var user_id = localStorage.getItem("g_current_user_id");
    var user_type = localStorage.getItem("g_current_user_type");
    var product_id = $('#product_id').val();
    $.ajax({
      url: '/get_observation',
      type: 'POST',
      data: JSON.stringify({user_id: user_id, user_type: user_type, product_id: product_id}),
      contentType: 'application/json',
      success: function(response){
        console.log(response);
        var furnitures = response.data;
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
      url: '/get_customer',
      type: 'POST',
      contentType: 'application/json',
      success: function(response){
        console.log(response);
        var customers = response.data;
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