DROP TABLE IF EXISTS backup_reminder;

CREATE TABLE `backup_reminder` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `sys_date` datetime NOT NULL,
  `backup_date` datetime NOT NULL,
  `day_count` int(30) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO backup_reminder VALUES("1","2021-09-01 10:47:12","2021-09-22 07:17:12","22","2021-09-22 10:47:24");



DROP TABLE IF EXISTS category_list;

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO category_list VALUES("1","Cfl Bulb"),
("2","Screw"),
("3","Nail"),
("4","Pipe"),
("5","Motor"),
("6","Water Tank"),
("7","Test"),
("8","Water Bottle");



DROP TABLE IF EXISTS customer_list;

CREATE TABLE `customer_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO customer_list VALUES("0","Guest","9876543210","Thoothukudi"),
("1","Suresh","9087981163","tuty"),
("2","Test","9876543212","Thoothukudi");



DROP TABLE IF EXISTS inventory;

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1= stockin , 2 = stockout',
  `stock_from` varchar(100) NOT NULL COMMENT 'sales/receiving',
  `form_id` int(30) NOT NULL,
  `other_details` text NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

INSERT INTO inventory VALUES("10","1","100","1","receiving","3","{\"price\":\"10\",\"qty\":\"100\"}","Stock from Receiving-p_invoice-2","0000-00-00 00:00:00","2021-09-23 12:48:19"),
("12","1","2","2","Sales","2","{\"price\":\"450\",\"qty\":\"2\"}","Stock out from Sales-s_invoice-1","2021-09-01 00:00:00","2021-09-23 13:22:54"),
("15","2","10","2","Sales","2","{\"price\":\"45\",\"qty\":\"10\"}","Stock out from Sales-s_invoice-1","2021-09-01 00:00:00","2021-09-23 14:54:58"),
("19","6","100","1","receiving","3","{\"price\":\"50\",\"qty\":\"100\"}","Stock from Receiving-p_invoice-2","0000-00-00 00:00:00","2021-09-23 15:41:07"),
("20","3","50","1","receiving","3","{\"price\":\"10\",\"qty\":\"50\"}","Stock from Receiving-p_invoice-2","0000-00-00 00:00:00","2021-09-23 15:43:20"),
("24","2","150","1","receiving","3","{\"price\":\"23\",\"qty\":\"150\"}","Stock from Receiving-p_invoice-2","0000-00-00 00:00:00","2021-09-23 15:57:51"),
("25","1","1","2","Sales","2","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-1","2021-09-01 00:00:00","2021-09-23 16:05:50"),
("26","1","1","2","Sales","4","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-2","2021-09-02 00:00:00","2021-09-24 11:28:26"),
("27","2","3","2","Sales","4","{\"price\":\"45\",\"qty\":\"3\"}","Stock out from Sales-s_invoice-2","2021-09-02 00:00:00","2021-09-24 11:28:26"),
("28","1","2","2","Sales","4","{\"price\":\"450\",\"qty\":\"2\"}","Stock out from Sales-s_invoice-2","2021-09-02 00:00:00","2021-09-24 11:40:16"),
("29","1","2","2","Sales","5","{\"price\":\"450\",\"qty\":\"2\"}","Stock out from Sales-s_invoice-3","2021-09-01 00:00:00","2021-09-24 11:52:25"),
("30","2","3","2","Sales","5","{\"price\":\"45\",\"qty\":\"3\"}","Stock out from Sales-s_invoice-3","2021-09-01 00:00:00","2021-09-24 11:52:25"),
("31","4","20","1","receiving","3","{\"price\":\"10\",\"qty\":\"20\"}","Stock from Receiving-p_invoice-2","0000-00-00 00:00:00","2021-09-24 12:33:41"),
("32","1","1","2","Sales","6","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-4","2021-09-16 00:00:00","2021-09-24 19:37:21"),
("34","1","1","2","Sales","8","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-5","2021-09-03 00:00:00","2021-09-27 14:25:12"),
("35","1","1","2","Sales","9","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-6","2021-09-03 00:00:00","2021-09-27 14:40:57"),
("36","2","2","2","Sales","9","{\"price\":\"45\",\"qty\":\"2\"}","Stock out from Sales-s_invoice-6","2021-09-03 00:00:00","2021-09-27 14:40:57"),
("37","1","1","2","Sales","10","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-7","2021-09-27 00:00:00","2021-09-27 17:01:12"),
("38","2","1","2","Sales","10","{\"price\":\"45\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-7","2021-09-27 00:00:00","2021-09-27 17:01:12"),
("39","1","1","2","Sales","11","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-8","2021-09-27 00:00:00","2021-09-27 17:02:11"),
("40","2","2","2","Sales","11","{\"price\":\"45\",\"qty\":\"2\"}","Stock out from Sales-s_invoice-8","2021-09-27 00:00:00","2021-09-27 17:02:11"),
("41","1","1","2","Sales","12","{\"price\":\"450\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-9","2021-09-27 00:00:00","2021-09-27 17:05:51"),
("42","2","2","2","Sales","12","{\"price\":\"45\",\"qty\":\"2\"}","Stock out from Sales-s_invoice-9","2021-09-27 00:00:00","2021-09-27 17:05:51"),
("43","6","1","2","Sales","12","{\"price\":\"5000\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-9","2021-09-27 00:00:00","2021-09-27 17:05:51"),
("44","3","1","2","Sales","12","{\"price\":\"50\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-9","2021-09-27 00:00:00","2021-09-27 17:05:51"),
("45","4","1","2","Sales","12","{\"price\":\"65\",\"qty\":\"1\"}","Stock out from Sales-s_invoice-9","2021-09-27 00:00:00","2021-09-27 17:05:51");



DROP TABLE IF EXISTS product_list;

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `category_id` int(30) NOT NULL,
  `hsn_code` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `name` varchar(150) NOT NULL,
  `gst` int(30) NOT NULL,
  `unit` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

INSERT INTO product_list VALUES("1","1","123","450","Led Havells10w ","5","8"),
("2","3","456","45","Nail1","18","1"),
("3","4","458","50","Pvc","12","2"),
("4","2","258","65","Screw","12","1"),
("5","6","741","1200","Tank","28","8"),
("6","5","639","5000","Onfnbb","12","10"),
("7","8","153790","75","Tupperware","12","8");



DROP TABLE IF EXISTS receiving_list;

CREATE TABLE `receiving_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `date_created` datetime NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO receiving_list VALUES("3","p_invoice-2","1","11505","2021-09-02 00:00:00","2021-09-23 11:29:26");



DROP TABLE IF EXISTS sales_list;

CREATE TABLE `sales_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(30) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `net_amount` double NOT NULL,
  `gst_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `amount_tendered` double NOT NULL,
  `amount_change` double NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO sales_list VALUES("2","s_invoice-1","0","0","0","1948.5","0","0","2021-09-01 00:00:00","2021-09-24 15:48:13"),
("4","s_invoice-2","0","0","0","1576.8","0","0","2021-09-02 00:00:00","2021-09-24 15:29:37"),
("5","s_invoice-3","0","0","0","1104.3","0","0","2021-09-01 00:00:00","2021-09-24 15:48:05"),
("6","s_invoice-4","0","0","0","472.5","0","0","2021-09-16 00:00:00","2021-09-24 19:37:21"),
("8","s_invoice-5","0","450","22.5","472.5","0","0","2021-09-03 00:00:00","2021-09-27 14:25:12"),
("9","s_invoice-6","0","540","38.7","578.7","0","0","2021-09-03 00:00:00","2021-09-27 14:40:57"),
("10","s_invoice-7","1","495","30.6","525.6","0","0","2021-09-27 00:00:00","2021-09-27 17:01:12"),
("11","s_invoice-8","1","540","38.7","578.7","0","0","2021-09-27 00:00:00","2021-09-27 17:02:11"),
("12","s_invoice-9","0","5655","652.5","6307.5","0","0","2021-09-27 00:00:00","2021-09-27 17:08:14");



DROP TABLE IF EXISTS supplier_list;

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `contactno` varchar(30) NOT NULL,
  `address1` text NOT NULL,
  `shopname` varchar(200) NOT NULL,
  `address2` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(50) NOT NULL,
  `gstin` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO supplier_list VALUES("1","Suresh","61881112333","564","Iconx Hardwares","ghhhhtn","tirunelveli","tamilnadu","33fgguhgunb"),
("3","Nnnn","8461651518241","ngnnn","Nnhh","nnhmtrthngbg","nagercoil","tn","335448541211"),
("4","Jgnk","8946521353","67","Abc Traders","mk nagar","tirunelveli","tamilnadu","215439215312");



DROP TABLE IF EXISTS system_settings;

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO system_settings VALUES("1","Sample","info@sample.com","8124399880","1600654680_photo-1504674900247-0877df9cc836.jpg","&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;ABOUT US&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#x2019;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;h2 style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;Where does it come from?&lt;/h2&gt;&lt;p style=&quot;text-align: center; margin-bottom: 15px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400;&quot;&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;");



DROP TABLE IF EXISTS unit_list;

CREATE TABLE `unit_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO unit_list VALUES("1","kgs"),
("2","meter"),
("3","gms"),
("4","dozen"),
("5","cm"),
("6","mm"),
("7","ltr"),
("8","pcs"),
("9","pack"),
("10","no\'s");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = cashier',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("1","Administrator","admin","123","1"),
("3","Suresh","suresh","1234","2");



