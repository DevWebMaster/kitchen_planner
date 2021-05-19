const express = require('express');
const mysql = require('mysql');
const cors = require('cors');
//create express app
const app = express();
const path = require('path');
const router = express.Router();
const fs = require('fs');

// const file_path = __dirname.split('application')[0]+'uploads/';
const file_path = path.join(__dirname, '..', 'kitchen_planner', 'uploads/')
console.log(file_path)

const hostname = 'localhost';
//set up server port
const port = process.env.PORT || 8080;

//parse requests of content-type - application/x-www-form-urlencoded
// app.use(bodyParser.urlencoded({extended: false}));

//parse requests of content-type - application/json
var bodyParser = require('body-parser');
app.use(cors());
app.use(bodyParser.json());
app.use(express.json());

const pool = mysql.createPool({
  connectionLimit: 10,
  host: "localhost",
  user: "root",
  password: "123qweasdzxc!@#QWE",
  database: "kitchen"
});

app.post('/load_product', function(req, res){
  var product_id = req.body.product_id;
  res.contentType('json');

  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query("SELECT product_name, check_order FROM tbl_product_history_log where product_id = "+product_id, function (err, product_name) {
      if (err) throw err;
      connection.release();
      
      fs.readFile(file_path+product_name[0].product_name, 'utf8' , (err, data) => {
        if (err) {
          console.error(err)
          return
        }
        var response = {
          'contents': data,
          'check_order': product_name[0].check_order
        }
        res.send({ data: response });
      })
      
    });
  });
  
})

app.post('/get_user_name', function(req, res){
  var user_id = req.body.user_id;
  var user_flag = req.body.user_flag;
  res.contentType('json');
  if(user_flag == 1){
    var query = "SELECT customer_name as user_name FROM tbl_customers where id = "+user_id;
  }else if(user_flag == 2){
    query = "SELECT pos_name as user_name FROM tbl_pos where pos_id = "+user_id;
  }
  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query(query, function (err, result) {
      if (err) throw err;
      // console.log(result);
      connection.release();
      res.send({ data: result });
    });
  });
  
})
app.post('/get_wall_floor', function(req, res){
  // console.log('body: ' + req.body.title);
  res.contentType('json');
  var wall_query = "SELECT name, concat('planner/', image) as image FROM tbl_wall_texture";
  var floor_query = "SELECT name, concat('planner/', image) as image FROM tbl_floor_texture";
  var wall_floor_arr = { 
    wall_data: [],
    floor_data: []
  }
  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query(wall_query, function (err, wall) {
      if (err) throw err;
      // connection.release();
      wall_floor_arr.wall_data = wall;
      connection.query(floor_query, function (err, floor) {
        if (err) throw err;
        wall_floor_arr.floor_data = floor;
        res.send({ data: wall_floor_arr });
      });
    });
  });
})
app.post('123/get_main_menu', function(req, res){
  // console.log('body: ' + req.body.title);
  res.contentType('json');

  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query("SELECT a1.id, a1.name, concat('planner/', a1.image) as image FROM tbl_main_menu as a1", function (err, result) {
      if (err) throw err;
      connection.release();
      res.send({ data: result });
    });
  });
  
})

app.post('/get_sub_menu', function(req, res){
  var main_menu_id = req.body.main_menu_id;
  res.contentType('json');

  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query("SELECT a1.id, a1.main_id, a1.name, concat('planner/', a1.image) as image FROM tbl_sub_menu as a1 where main_id = "+main_menu_id, function (err, result) {
      if (err) throw err;
      // console.log(result);
      connection.release();
      res.send({ data: result });
    });
  });
  
})

app.post('/get_shortkey_menu', function(req, res){
  var sub_id = req.body.sub_id;
  var main_id = req.body.main_id;
  res.contentType('json');

  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query("SELECT a1.model_id, a1.main_id, a1.sub_id, a1.name, concat('planner/', a1.image) as image, concat('planner/', a1.model) as model, a1.type, a1.countertop_type, a1.countertop_color, a1.exterio_color, a1.interior_color, a1.skirting_color, a1.skirting_type, a1.dooropen_type, a1.door_thickness, a1.cube_id, a1.summary, a2.name as main_menu, a3.name as sub_menu, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.price as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type FROM tbl_model_list as a1 "
                        +"LEFT JOIN tbl_main_menu as a2 ON a1.main_id = a2.id "
                        +"LEFT JOIN tbl_sub_menu as a3 ON a1.sub_id = a3.id "
                        +"LEFT JOIN tbl_material as a4 ON a1.countertop_type = a4.material_id "
                        +"LEFT JOIN tbl_material as a5 ON a1.skirting_type = a5.material_id "
                        +"LEFT JOIN tbl_color as a6 ON a1.countertop_color = a6.color_id "
                        +"LEFT JOIN tbl_color as a7 ON a1.exterio_color = a7.color_id "
                        +"LEFT JOIN tbl_color as a8 ON a1.interior_color = a8.color_id "
                        +"LEFT JOIN tbl_color as a9 ON a1.skirting_color = a9.color_id "
                        +"LEFT JOIN tbl_door_style as a10 ON a1.dooropen_type = a10.style_id "
                        +"LEFT JOIN tbl_door_thickness as a11 ON a1.door_thickness = a11.thickness_id "
                        +"LEFT JOIN tbl_model_type as a12 ON a1.type = a12.type "
                        + "where a1.main_id = "+main_id+" AND a1.sub_id = "+sub_id, function (err, result) {
      if (err) throw err;
      connection.release();
      res.send({ data: result });
    });
  });
  
})

app.post('/get_thumbnail_menu', function(req, res){
  var sub_id = req.body.sub_id;
  var main_id = req.body.main_id;
  var search_str = req.body.search_str;
  // console.log(main_id+'-'+sub_id);
  res.contentType('json');

  pool.getConnection(function(err, connection) {
    if (err) throw err;
    if(search_str != undefined){
      connection.query("SELECT a1.model_id, a1.main_id, a1.sub_id, a1.name, concat('planner/', a1.image) as image, concat('planner/', a1.model) as model, a1.type, a1.countertop_type, a1.countertop_color, a1.exterio_color, a1.interior_color, a1.skirting_color, a1.skirting_type, a1.dooropen_type, a1.door_thickness, a1.cube_id, a1.summary, a2.name as main_menu, a3.name as sub_menu, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.price as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type FROM tbl_model_list as a1 "
                        +"LEFT JOIN tbl_main_menu as a2 ON a1.main_id = a2.id "
                        +"LEFT JOIN tbl_sub_menu as a3 ON a1.sub_id = a3.id "
                        +"LEFT JOIN tbl_material as a4 ON a1.countertop_type = a4.material_id "
                        +"LEFT JOIN tbl_material as a5 ON a1.skirting_type = a5.material_id "
                        +"LEFT JOIN tbl_color as a6 ON a1.countertop_color = a6.color_id "
                        +"LEFT JOIN tbl_color as a7 ON a1.exterio_color = a7.color_id "
                        +"LEFT JOIN tbl_color as a8 ON a1.interior_color = a8.color_id "
                        +"LEFT JOIN tbl_color as a9 ON a1.skirting_color = a9.color_id "
                        +"LEFT JOIN tbl_door_style as a10 ON a1.dooropen_type = a10.style_id "
                        +"LEFT JOIN tbl_door_thickness as a11 ON a1.door_thickness = a11.thickness_id "
                        +"LEFT JOIN tbl_model_type as a12 ON a1.type = a12.type "
                        +"where a1.main_id = "+main_id+" AND a1.sub_id = "+sub_id+" AND a1.name LIKE '%"+search_str+"%'", function (err, result) {
        if (err) throw err;
        // console.log(result);
        connection.release();
        res.send({ data: result });
      });
    }else{
      connection.query("SELECT a1.model_id, a1.main_id, a1.sub_id, a1.name, concat('planner/', a1.image) as image, concat('planner/', a1.model) as model, a1.type, a1.countertop_type, a1.countertop_color, a1.exterio_color, a1.interior_color, a1.skirting_color, a1.skirting_type, a1.dooropen_type, a1.door_thickness, a1.cube_id, a1.summary, a2.name as main_menu, a3.name as sub_menu, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.price as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type FROM tbl_model_list as a1 "
                        +"LEFT JOIN tbl_main_menu as a2 ON a1.main_id = a2.id "
                        +"LEFT JOIN tbl_sub_menu as a3 ON a1.sub_id = a3.id "
                        +"LEFT JOIN tbl_material as a4 ON a1.countertop_type = a4.material_id "
                        +"LEFT JOIN tbl_material as a5 ON a1.skirting_type = a5.material_id "
                        +"LEFT JOIN tbl_color as a6 ON a1.countertop_color = a6.color_id "
                        +"LEFT JOIN tbl_color as a7 ON a1.exterio_color = a7.color_id "
                        +"LEFT JOIN tbl_color as a8 ON a1.interior_color = a8.color_id "
                        +"LEFT JOIN tbl_color as a9 ON a1.skirting_color = a9.color_id "
                        +"LEFT JOIN tbl_door_style as a10 ON a1.dooropen_type = a10.style_id "
                        +"LEFT JOIN tbl_door_thickness as a11 ON a1.door_thickness = a11.thickness_id "
                        +"LEFT JOIN tbl_model_type as a12 ON a1.type = a12.type "
                        +"where a1.main_id = "+main_id+" AND a1.sub_id = "+sub_id, function (err, result) {
        if (err) throw err;
        // console.log(result);
        connection.release();
        res.send({ data: result });
      });
    }
    
  });
  
})

app.post('/save_product', function(req, res){
  var contents = req.body.req_data;
  var filename = req.body.filename;
  var user_id = req.body.user_id;
  var user_type = req.body.user_type;
  var model_level = 'level1';  //get from kitchen planner..
  var items = JSON.parse(contents).items
  res.contentType('json');
  var created_at = get_date();
  fs.writeFile(file_path+filename, contents, function (err) {
    if (err) throw err;
    console.log('File is created successfully.');
  }); 
  if(user_type == 1){
    var pos_id = 0;
    var query1 = "INSERT INTO tbl_product_history_log (product_name, customer_id, pos_id, created_at, created_by) VALUES ('"+filename+"', "+user_id+", "+pos_id+", '"+created_at+"', "+user_id+")";
  }else{
    var query1 = "INSERT INTO tbl_product_history_log (product_name, pos_id, created_at, created_by) VALUES ('"+filename+"', "+user_id+", '"+created_at+"', "+user_id+")";
  }

  
  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query(query1, function (err, result1) {
      if (err) throw err;
      // connection.release();
      var product_id = result1.insertId;
      if(product_id){
        var values = [];
        for(var i = 0; i < items.length; i++){
          var item = items[i];
          var sql = "INSERT INTO tbl_model_select_log (product_id, model_id, width, length, model_level, created_at, created_by) VALUES ?";
          values[i] = [product_id, item.model_id, item.width, item.depth, model_level, created_at, user_id]
        }
        connection.query(sql, [values], function (err, result2) {
          if(err) throw err;
          connection.release();
          res.send({ data: product_id });
        })
      }
     
    });
  });
  
})
app.post('/get_budget', function(req, res){
  var items = req.body.req_data.items;
  var user_id = req.body.user_id;
  var user_type = req.body.user_type;
  var product_id = req.body.product_id;
  var customer_id = req.body.customer_id;
  var summary_arr = req.body.summary_arr;
  
  res.contentType('json');
  var total_furniture_cost = 0;
  var total_extra_cost = 0;
  pool.getConnection(function(err, connection) {
    Object.keys(summary_arr).map(function(key, index) {
      var sql = "UPDATE tbl_model_select_log SET summary = '"+summary_arr[key].summary+"' WHERE model_id = "+summary_arr[key].model_id+" and product_id = "+product_id;
      connection.query(sql, function (err, result) {
        if (err) throw err;
      }) 
    });
    var mainFunc = async function(connection) {
      var subFunc = function (item, connection) {
        return new Promise(resolve => {
          var furniture_cost = 0
          item.width = item.width-item.width%10;
          if(item.width > 80)
            item.width = 80;
          if(item.width < 60)
            item.width = 60;
          item.depth = item.depth-item.depth%10;
          if(item.depth > 120)
            item.depth = 120;
          if(item.depth < 60)
            item.depth = 60;
          var query1 = "SELECT a1.level1, a1.level2, a1.level3 FROM tbl_model_point_list as a1 LEFT JOIN tbl_model_list as a2 ON a1.cube = a2.cube_id WHERE a2.model_id = "+item.model_id+" AND a1.width = "+item.width+" AND a1.length = "+ item.depth;
          connection.query(query1, function (err, furniture_point){
            var f_point = furniture_point[0].level1;
            // console.log(furniture_point);
            // if(req.body.level == 'level2'){
            //   f_point = furniture_point[0].level2;
            // }if(req.body.level == 'level3'){
            //   f_point = furniture_point[0].level3;
            // }
            if(user_type == 1){  //online customer
              user_id  = 0;
            }
            var query2 = "SELECT * FROM tbl_point_rate WHERE pos_rate = "+user_id;
            connection.query(query2, function (err, point_rate) {
              if(f_point < point_rate[0].max){
                furniture_cost = f_point*point_rate[0].price;
              }if(point_rate[1].max > f_point > point_rate[1].min){
                furniture_cost = f_point*point_rate[1].price;
              }if(point_rate[2].min < f_point){
                furniture_cost = f_point*point_rate[2].price;
              }
              total_furniture_cost += furniture_cost;
              var query3 ="SELECT a1.model_id, SUM(a2.price+a3.price+a4.price+a5.price+a6.price+a7.price+a8.price+a9.price) as extra_price FROM tbl_model_list as a1 "
                        +"LEFT JOIN tbl_material as a2 ON a1.countertop_type = a2.material_id "
                        +"LEFT JOIN tbl_material as a3 ON a1.skirting_type = a3.material_id "
                        +"LEFT JOIN tbl_color as a4 ON a1.countertop_color = a4.color_id "
                        +"LEFT JOIN tbl_color as a5 ON a1.exterio_color = a5.color_id "
                        +"LEFT JOIN tbl_color as a6 ON a1.interior_color = a6.color_id "
                        +"LEFT JOIN tbl_color as a7 ON a1.skirting_color = a7.color_id "
                        +"LEFT JOIN tbl_door_style as a8 ON a1.dooropen_type = a8.style_id "
                        +"LEFT JOIN tbl_door_thickness as a9 ON a1.door_thickness = a9.thickness_id "
                        +" WHERE a1.model_id = "+item.model_id;
              connection.query(query3, function (err, extra_cost) {
                // console.log('extra_cost',extra_cost)
                extra_cost = extra_cost[0].extra_price;
                var query4 = "";
                if(user_type == 2){ // pos margin
                  query4 = "SELECT * FROM tbl_pos_margin_spread WHERE pos_id = "+user_id;
                }else if(user_type == 1){  //online customer margin
                  query4 = "SELECT * FROM tbl_customer_margin_spread";
                }
                connection.query(query4, function (err, margin_spread) {
                  if(user_type == 2){
                    extra_cost = extra_cost + extra_cost*margin_spread[0].pos_margin/100 + margin_spread[0].pos_spread;
                    extra_cost = extra_cost + extra_cost*margin_spread[0].pos_customer_margin/100 + margin_spread[0].pos_customer_spread;
                  }else if(user_type == 1){
                    extra_cost = extra_cost + extra_cost*margin_spread[0].customer_margin/100 + margin_spread[0].customer_spread;
                  }
                  total_extra_cost += extra_cost
                  resolve(123)
                }) 
              })
            })
          })
        })
      }
      for (var i = 0; i < items.length; i++) {
        var item = items[i];
        var cc = await subFunc(item, connection)
      }
      var budgets = {
        total_furniture_cost: total_furniture_cost,
        total_extra_cost: total_extra_cost
      }
      var online_mode = 0;
      var update_data = '';
      if(user_type == 1){
        online_mode = 1;
        update_data = "UPDATE tbl_product_history_log SET estimated_furniture_cost = "+total_furniture_cost+ ", estimated_countertio_cost = "+(total_furniture_cost+total_extra_cost)+", check_order = "+1+", online_mode = "+online_mode+", updated_by = "+user_id+" WHERE product_id = "+product_id;
      }
      else if(user_type == 2){
        update_data = "UPDATE tbl_product_history_log SET estimated_furniture_cost = "+total_furniture_cost+ ", estimated_countertio_cost = "+(total_furniture_cost+total_extra_cost)+", customer_id = "+customer_id+", check_order = "+1+", online_mode = "+online_mode+", updated_by = "+user_id+" WHERE product_id = "+product_id;
      }
      
      connection.query(update_data, function (err, result) {
        if (err) throw err;
      }) 
      res.send({ data: budgets })
    }
    mainFunc(connection)
  })
})
app.post('/get_observation', function(req, res){
  var user_id = req.body.user_id;
  var user_type = req.body.user_type;
  var product_id = req.body.product_id;
  res.contentType('json');
  var query = "SELECT a1.model_id, a1.main_id, a1.sub_id, a1.name, concat('planner/', a1.image) as image, concat('planner/', a1.model) as model, a1.type, a1.countertop_type, a1.countertop_color, a1.exterio_color, a1.interior_color, a1.skirting_color, a1.skirting_type, a1.dooropen_type, a1.door_thickness, a1.cube_id, a1.summary, a4.name as countertop_type, a4.price as countertop_type_price, a5.name as skirting_type, a5.price as skirting_type_price, a6.name as countertop_color, a6.price as countertop_color_price, a7.name as exterio_color, a7.price as exterio_color_price, a8.name as interior_color, a8.price as interior_color_price, a9.name as skirting_color, a9.price as skirting_color_price, a10.name as dooropen_type, a10.price as dooropen_type_price, a11.name as door_thickness, a11.price as door_thickness_price, a12.name as model_type FROM tbl_model_select_log as a2 "
                        +"LEFT JOIN tbl_model_list as a1 ON a1.model_id = a2.model_id "
                        +"LEFT JOIN tbl_material as a4 ON a1.countertop_type = a4.material_id "
                        +"LEFT JOIN tbl_material as a5 ON a1.skirting_type = a5.material_id "
                        +"LEFT JOIN tbl_color as a6 ON a1.countertop_color = a6.color_id "
                        +"LEFT JOIN tbl_color as a7 ON a1.exterio_color = a7.color_id "
                        +"LEFT JOIN tbl_color as a8 ON a1.interior_color = a8.color_id "
                        +"LEFT JOIN tbl_color as a9 ON a1.skirting_color = a9.color_id "
                        +"LEFT JOIN tbl_door_style as a10 ON a1.dooropen_type = a10.style_id "
                        +"LEFT JOIN tbl_door_thickness as a11 ON a1.door_thickness = a11.thickness_id "
                        +"LEFT JOIN tbl_model_type as a12 ON a1.type = a12.type "
                        +"where a2.product_id = "+product_id+" GROUP BY a2.model_id"
  pool.getConnection(function(err, connection) {
    if (err) throw err;
    connection.query(query, function (err, result) {
      if (err) throw err;
      connection.release();
      res.send({ data: result })
    });
  });
})
app.post('/get_customer', function(req, res){
  res.contentType('json');
  var query = 'SELECT id, concat(customer_name, last_name1, last_name2) as name FROM tbl_customers';
  pool.getConnection(function(err, connection) {
    if(err) throw err;
    connection.query(query, function (err, result) {
      if(err) throw err;
      connection.release();
      res.send({data: result})
    })
  })
})
app.set("views", path.join(__dirname, "planner"));
app.engine("html", require('ejs').renderFile);
app.set('view engine', 'ejs');
app.use(express.static(path.join(__dirname, '')))
router.get("/", (req, res)=>{
  res.render("index.html");
});

app.use("/", router);

  // listen for requests
const server = app.listen(port,hostname, () => {
    console.log(`Server is listening on port ${port}`);
});

function get_date()
{
  var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth()+1;
    var day = today.getDate();
    if (month.toString().length < 2) 
        month = '0' + month;
    if (day.toString().length < 2) 
        day = '0' + day;
    var hour = today.getHours();
    var minute = today.getMinutes();
    var second = today.getSeconds();
    if (hour.toString().length < 2) 
        hour = '0' + hour;
    if (minute.toString().length < 2) 
        minute = '0' + minute;
    if (second.toString().length < 2) 
        second = '0' + second;    

    return year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
}