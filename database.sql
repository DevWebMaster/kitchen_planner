DROP TABLE IF EXISTS `tbl_model_select_log`;
CREATE TABLE IF NOT EXISTS `tbl_model_select_log` (
  `id`            int(11)      NOT NULL      AUTO_INCREMENT,
  `product_id`           int(11) NOT NULL,
  `model_id`          int(11)     NOT NULL,
  `furniture_cost`         decimal     NOT NULL,
  `countertio_cost`       decimal    NOT NULL,
  `created_at`         datetime     NOT NULL,
  `created_by`         int(11)      NOT NULL,
  `updated_at`         datetime     NULL,
  `updated_by`         int(11)      NULL,
  PRIMARY KEY (`id`),
  index(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `tbl_product_history_log`;
CREATE TABLE IF NOT EXISTS `tbl_product_history_log` (
  `product_id` 			int(11) 		  NOT NULL 			AUTO_INCREMENT,
  `order_no`            varchar(255)        NOT NULL,
  `status`          int(11)       NOT NULL,
  `estimated_furniture_cost`        decimal   NOT NULL,
  `estimated_countertio_cost`         decimal   NOT NULL,
  `actual_furniture_cost`      decimal      NOT NULL,
  `actual_countertio_cost`         decimal     NOT NULL,
  `customer_id`         int(11)     NOT NULL,
  `pos_id`         int(11)     NOT NULL,
  `submitted_date`         datetime     NOT NULL,
  `created_at` 		     datetime 		NOT NULL,
  `created_by`		     int(11)			NOT NULL,
  `updated_at` 		     datetime 		NULL,
  `updated_by`		     int(11)			NULL,
  PRIMARY KEY (`product_id`),
  index(product_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_product_status`;
CREATE TABLE IF NOT EXISTS `tbl_product_status` (
  `id`              int(11)     NOT NULL      AUTO_INCREMENT,
  `status`          varchar(255)    NOT NULL,
  PRIMARY KEY (`id`),
  index(id)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_model_list`;
CREATE TABLE IF NOT EXISTS `tbl_model_list` (
  `model_id`     int(11)            NOT NULL      AUTO_INCREMENT,
  `main_id`     int(11)       NOT NULL,
  `sub_id`  int(11)     NOT NULL,
  `name`       varchar(255)   NOT NULL,
  `image`      varchar(255)   NOT NULL,
  `model`        varchar(255)  NOT NULL,
  `type`        int(11)    NOT NULL,
  `countertop_type`         int(11)     NOT NULL,
  `countertop_color`         int(11)     NOT NULL,
  `exterio_color`         int(1)     NOT NULL,
  `interior_color`         int(11)     NOT NULL,
  `skirting_color`         int(11)     NOT NULL,
  `skirting_type`         int(11)      NOT NULL,
  `dooropen_type`         int(11)      NOT NULL,
  `door_thickness`         int(11)     NOT NULL,
  `furniture_price`     decimal     NOT NULL,
  `created_at`         datetime     NOT NULL,
  `created_by`         int(11)      NOT NULL,
  `updated_at`         datetime     NULL,
  `updated_by`         int(11)      NULL,
  PRIMARY KEY (`model_id`),
  index(model_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tbl_sub_menu`;
CREATE TABLE IF NOT EXISTS `tbl_sub_menu` (
  `id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `main_id`            int(11)       NOT NULL,
  `name`            varchar(255)       NOT NULL,
  `image`            varchar(255)       NOT NULL,
  PRIMARY KEY (`id`),
   index( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_main_menu`;
CREATE TABLE IF NOT EXISTS `tbl_main_menu` (
  `id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `name`            varchar(255)       NOT NULL,
  `image`            varchar(255)       NOT NULL,
  PRIMARY KEY (`id`),
   index( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_pos`;
CREATE TABLE IF NOT EXISTS `tbl_pos` (
  `pos_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `pos_name`            varchar(255)       NOT NULL,
  `company_name`            varchar(255)       NOT NULL,
  `password`            varchar(255)       NOT NULL,
  `CIF`            varchar(255)       NOT NULL,
  `phone_num`       varchar(255)      NOT NULL,
  `direction`            varchar(255)       NOT NULL,
  `zipcode`            varchar(255)       NOT NULL,
  `coordinates`            longtext       NOT NULL,
  `created_at`            datetime       NOT NULL,
  `updated_at`            datetime       NOT NULL,
  PRIMARY KEY (`pos_id`),
   index( `pos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_pos_location`;
CREATE TABLE IF NOT EXISTS `tbl_pos_location` (
  `id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `location`            varchar(255)       NOT NULL,
  PRIMARY KEY (`id`),
   index( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `customer_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `customer_name`            varchar(255)       NOT NULL,
  `last_name1`            varchar(255)       NOT NULL,
  `last_name2`            varchar(255)       NOT NULL,
  `DNI`            varchar(255)       NOT NULL,
  `email`       varchar(255)      NOT NULL,
  `transaction`            varchar(255)       NOT NULL,
  `phone_num`            varchar(255)       NOT NULL,
  `password`            varchar(255)       NOT NULL,
  `delivery_direction`            varchar(255)       NOT NULL,
  `zipcode`            varchar(255)       NOT NULL,
  `LOPD`            int(1)       NOT NULL,
  `created_at`            datetime       NOT NULL,
  `updated_at`            datetime       NOT NULL,
  PRIMARY KEY (`customer_id`),
   index( `customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_material`;
CREATE TABLE IF NOT EXISTS `tbl_material` (
  `material_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `name`            varchar(255)       NOT NULL,
  `price`           decimal           NOT NULL,
  PRIMARY KEY (`material_id`),
   index( `material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into tbl_material values
(1,"marble", 120),
(2,"antracite", 100)
;

DROP TABLE IF EXISTS `tbl_color`;
CREATE TABLE IF NOT EXISTS `tbl_color` (
  `color_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `name`            varchar(255)       NOT NULL,
  `price`           decimal           NOT NULL,
  PRIMARY KEY (`color_id`),
   index( `color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into tbl_color values
(1,"black", 120),
(2,"white", 100)
;

DROP TABLE IF EXISTS `tbl_door_style`;
CREATE TABLE IF NOT EXISTS `tbl_door_style` (
  `style_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `name`            varchar(255)       NOT NULL,
  `price`           decimal           NOT NULL,
  PRIMARY KEY (`style_id`),
   index( `style_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into tbl_door_style values
(1,"horizontal", 120),
(2,"vertical", 100)
;

DROP TABLE IF EXISTS `tbl_door_thickness`;
CREATE TABLE IF NOT EXISTS `tbl_door_thickness` (
  `thickness_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `name`            varchar(255)       NOT NULL,
  `price`           decimal           NOT NULL,
  PRIMARY KEY (`thickness_id`),
   index( `thickness_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into tbl_door_thickness values
(1,"20", 120),
(2,"22", 100)
;

DROP TABLE IF EXISTS `tbl_feedback`;
CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `survey_template_id`            int(11)       NOT NULL,
  `customer_id`           int(11)           NOT NULL,
  `pos_id`            int(11)       NOT NULL,
  `content`           longtext           NOT NULL,
  `mark`            int(11)       NOT NULL,
  `check_flag`           int(1)           NOT NULL,
  PRIMARY KEY (`id`),
   index( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_model_type`;
CREATE TABLE IF NOT EXISTS `tbl_model_type` (
  `id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `name`            varchar(255)       NOT NULL,
  `type`           int(2)           NOT NULL,
  PRIMARY KEY (`id`),
   index( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `order_no`            varchar(255)       NOT NULL,
  `status`           varchar(11)           NOT NULL,
  `customer_id`            int(11)       NOT NULL,
  `pos_id`           int(11)           NOT NULL,
  `order_content`            longtext       NOT NULL,
  `check_flag`           int(1)           NOT NULL,
  `created_at`            datetime       NOT NULL,
  `updated_at`            datetime       NOT NULL,
  PRIMARY KEY (`id`),
   index( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_survey_tempate`;
CREATE TABLE IF NOT EXISTS `tbl_survey_tempate` (
  `id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `survey`            varchar(255)       NOT NULL,
  PRIMARY KEY (`id`),
   index( `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_pa_message`;
CREATE TABLE IF NOT EXISTS `tbl_pa_message` (
  `pa_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `order_no`            varchar(255)       NOT NULL,
  `sender`           int(11)           NOT NULL,
  `receiver`            int(11)       NOT NULL,
  `content`            longtext       NOT NULL,
  `check_flag`           int(1)           NOT NULL,
  `created_at`            datetime       NOT NULL,
  `updated_at`            datetime       NOT NULL,
  PRIMARY KEY (`pa_id`),
   index( `pa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `tbl_pc_message`;
CREATE TABLE IF NOT EXISTS `tbl_pc_message` (
  `pc_id`            int(11)            NOT NULL      AUTO_INCREMENT,
  `order_no`            varchar(255)       NOT NULL,
  `sender`           int(11)           NOT NULL,
  `receiver`            int(11)       NOT NULL,
  `content`            longtext       NOT NULL,
  `check_flag`           int(1)           NOT NULL,
  `created_at`            datetime       NOT NULL,
  `updated_at`            datetime       NOT NULL,
  PRIMARY KEY (`pc_id`),
   index( `pc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
