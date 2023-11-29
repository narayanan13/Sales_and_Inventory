<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}

	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	// function login2(){
	// 	extract($_POST);
	// 	$qry = $this->db->query("SELECT * FROM user_info where email = '".$email."' and password = '".md5($password)."' ");
	// 	if($qry->num_rows > 0){
	// 		foreach ($qry->fetch_array() as $key => $value) {
	// 			if($key != 'passwors' && !is_numeric($key))
	// 				$_SESSION['login_'.$key] = $value;
	// 		}
	// 		$ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	// 		$this->db->query("UPDATE cart set user_id = '".$_SESSION['login_user_id']."' where client_ip ='$ip' ");
	// 			return 1;
	// 	}else{
	// 		return 3;
	// 	}
	// }
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
			if($save)
			return 2;
		}
	}
	function signup(){
		extract($_POST);
		$data = " first_name = '$first_name' ";
		$data .= ", last_name = '$last_name' ";
		$data .= ", mobile = '$mobile' ";
		$data .= ", address = '$address' ";
		$data .= ", email = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM user_info where email = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO user_info set ".$data);
		if($save){
			$login = $this->login2();
			return 1;
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'../assets/img/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data." where id =".$chk->fetch_array()['id']);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}

			return 1;
				}
	}

	function save_category(){
		extract($_POST);
		$lowercase = "";
			$arr = array();
			$pattern = '/([;:,-.\/ ])/';
			$array = preg_split($pattern, $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			foreach($array as $k => $v)
				$lowercase .= ucwords(strtolower($v));
		$data = " name = '$lowercase' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO category_list set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE category_list set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}
	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM category_list where id = ".$id);
		if($delete)
			return 1;
	}
	function save_supplier(){
		extract($_POST);
		$lowercase_name = "";
			$arr = array();
			$pattern = '/([;:,-.\/ ])/';
			$array = preg_split($pattern, $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			foreach($array as $k => $v)
				$lowercase_name .= ucwords(strtolower($v));
		$lowercase_shopname = "";
			$arr = array();
			$pattern = '/([;:,-.\/ ])/';
			$array = preg_split($pattern, $shopname, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			foreach($array as $k => $v)
				$lowercase_shopname .= ucwords(strtolower($v));
		$data = " name = '$lowercase_name' ";
		$data .= ", shopname = '$lowercase_shopname' ";
		$data .= ", address1 = '$address1' ";
		$data .= ", address2 = '$address2' ";
		$data .= ", city = '$city' ";
		$data .= ", state = '$state' ";
		$data .= ", gstin = '$gstin' ";
		$data .= ", contactno = '$contactno' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO supplier_list set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE supplier_list set ".$data." where id=".$id);
			if($save)
			return 2;
		}
		// return $data;
	}
	function delete_supplier(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM supplier_list where id = ".$id);
		if($delete)
			return 1;
	}
	function save_product(){
		extract($_POST);
		$lowercase = "";
			$arr = array();
			$pattern = '/([;:,-.\/ ])/';
			$array = preg_split($pattern, $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			foreach($array as $k => $v)
				$lowercase .= ucwords(strtolower($v));
		$data = " name = '$lowercase' ";
		$data .= ", hsn_code = '$hsn_code' ";
		$data .= ", category_id = '$category_id' ";
		$data .= ", gst = '$gst' ";
		$data .= ", unit = '$unit' ";
		$data .= ", price = '$price' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO product_list set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE product_list set ".$data." where id=".$id);
			if($save)
			return 2;
		}
		return $data;
	}

	function delete_product(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM product_list where id = ".$id);
		if($delete)
			return 1;
	}

	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}

	function save_receiving(){
		extract($_POST);
		$data = " supplier_id = '$supplier_id' ";
		$data .= ", total_amount = '$tamount' ";
		
		if(empty($id)){
			// $ref_no = sprintf("%'.08d\n", $ref_no);
			$ref_no = "p_invoice-1";
			$i = 1;

			while($i == 1){
				$chk = $this->db->query("SELECT * FROM receiving_list where ref_no ='$ref_no'")->num_rows;
				if($chk > 0){
					$temp = explode("-",$ref_no);
					$temp[1] = $temp[1] + 1;
					$ref_no = $temp[0].'-'.$temp[1];
					// $ref_no = $ref_no + 1;
					// $ref_no = mt_rand(1,99999999);
					// $ref_no = sprintf("%'.08d\n", $ref_no);
				}else{
					$i=0;
				}
			}
			$data .= ", ref_no = '$ref_no' ";
			$data .= ", date_created = '$bill_date' ";
			$save = $this->db->query("INSERT INTO receiving_list set ".$data);
			$id =$this->db->insert_id;
			foreach($product_id as $k => $v){
				$data = " form_id = '$id' ";
				$data .= ", product_id = '$product_id[$k]' ";
				$data .= ", qty = '$qty[$k]' ";
				$data .= ", type = '1' ";
				$data .= ", stock_from = 'receiving' ";
				$details = json_encode(array('price'=>$price[$k],'qty'=>$qty[$k]));
				$data .= ", other_details = '$details' ";
				$data .= ", date_created = '$bill_date' ";
				$data .= ", remarks = 'Stock from Receiving-".$ref_no."' ";

				$save2[]= $this->db->query("INSERT INTO inventory set ".$data);
			}
			if(isset($save2)){
				return 1;
			}
		}else{
			$save = $this->db->query("UPDATE receiving_list set ".$data." where id =".$id);
			$ids = implode(",",$inv_id);
			$this->db->query("DELETE FROM inventory where type = 1 and form_id ='$id' and id NOT IN (".$ids.") ");
			foreach($product_id as $k => $v){
				$data = " form_id = '$id' ";
				$data .= ", product_id = '$product_id[$k]' ";
				$data .= ", qty = '$qty[$k]' ";
				$data .= ", type = '1' ";
				$data .= ", stock_from = 'receiving' ";
				$details = json_encode(array('price'=>$price[$k],'qty'=>$qty[$k]));
				$data .= ", other_details = '$details' ";
				$data .= ", remarks = 'Stock from Receiving-".$ref_no."' ";
				if(!empty($inv_id[$k])){
									$save2[]= $this->db->query("UPDATE inventory set ".$data." where id=".$inv_id[$k]);
				}else{
					$save2[]= $this->db->query("INSERT INTO inventory set ".$data);
				}
			}
			if(isset($save2)){
				return 1;
			}

		}
	}

	function delete_receiving(){
		extract($_POST);
		$del1 = $this->db->query("DELETE FROM receiving_list where id = $id ");
		$del2 = $this->db->query("DELETE FROM inventory where type = 1 and form_id = $id ");
		if($del1 && $del2)
			return 1;
	}
	function save_customer(){
		extract($_POST);
		$lowercase = "";
			$arr = array();
			$pattern = '/([;:,-.\/ ])/';
			$array = preg_split($pattern, $name, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
			foreach($array as $k => $v)
				$lowercase .= ucwords(strtolower($v));
		$data = " name = '$lowercase' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO customer_list set ".$data);
			if($save)
			return 1;
		}else{
			$save = $this->db->query("UPDATE customer_list set ".$data." where id=".$id);
			if($save)
			return 2;
		}
	}

	function delete_customer(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM customer_list where id = ".$id);
		if($delete)
			return 1;
	}

	function chk_prod_availability(){
		extract($_POST);
		$price = $this->db->query("SELECT * FROM product_list where id = ".$id)->fetch_assoc()['price'];
		$gst = $this->db->query("SELECT * FROM product_list where id = ".$id)->fetch_assoc()['gst'];
		$inn = $this->db->query("SELECT sum(qty) as inn FROM inventory where type = 1 and product_id = ".$id);
		$inn = $inn && $inn->num_rows > 0 ? $inn->fetch_array()['inn'] : 0;
		$out = $this->db->query("SELECT sum(qty) as `out` FROM inventory where type = 2 and product_id = ".$id);
		$out = $out && $out->num_rows > 0 ? $out->fetch_array()['out'] : 0;
		$available = $inn - $out;
		return json_encode(array('available'=>$available,'price'=>$price,'gst'=>$gst));
	}

	function get_gst(){
		extract($_POST);
		$gst = $this->db->query("SELECT * FROM product_list where id = ".$id)->fetch_assoc()['gst'];
		return json_encode(array('gst'=>$gst));
	}

	function backup_data() {
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'sales_inventory_db';
		$tables = '*';
		$link = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname);
	
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;
		}
	
		mysqli_query($link, "SET NAMES 'utf8'");
	
		//get all of the tables
		if($tables == '*')
		{
			$tables = array();
			$result = mysqli_query($link, 'SHOW TABLES');
			while($row = mysqli_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
	
		$return = '';
		//cycle through
		foreach($tables as $table)
		{
			$result = mysqli_query($link, 'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);
			$num_rows = mysqli_num_rows($result);
	
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			$counter = 1;
	
			//Over tables
			for ($i = 0; $i < $num_fields; $i++) 
			{   //Over rows
				while($row = mysqli_fetch_row($result))
				{   
					if($counter == 1){
						$return.= 'INSERT INTO '.$table.' VALUES(';
					} else{
						$return.= '(';
					}
	
					//Over fields
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
	
					if($num_rows == $counter){
						$return.= ");\n";
					} else{
						$return.= "),\n";
					}
					++$counter;
				}
			}
			$return.="\n\n\n";
		}
	
		//save file
		// $fileName = 'TT-db'.time().'-'.(md5(implode(',',$tables))).'.sql';
		$fileName = 'ZTT-db-'.time().'.sql';
		$handle = fopen($fileName,'w+');
		fwrite($handle,$return);
		if(fclose($handle)){ 
			return json_encode(array('filename'=>$fileName));
			exit; 
		}
	}


	function save_sales(){
		extract($_POST);
		$data = " customer_id = '$customer_id' ";
		$data .= ", net_amount = '$netamount' ";
		$data .= ", gst_amount = '$gstamount' ";
		$data .= ", total_amount = '$tamount' ";
		// $data .= ", amount_tendered = '$amount_tendered' ";
		// $data .= ", amount_change = '$change' ";
		
		if(empty($id)){
			// $ref_no = sprintf("%'.08d\n", $ref_no);
			$ref_no = "s_invoice-1";
			$i = 1;

			while($i == 1){
				$chk = $this->db->query("SELECT * FROM sales_list where ref_no ='$ref_no'")->num_rows;
				if($chk > 0){
					$temp = explode("-",$ref_no);
					$temp[1] = $temp[1] + 1;
					$ref_no = $temp[0].'-'.$temp[1];
					// $ref_no = $ref_no + 1;
					// $ref_no = mt_rand(1,99999999);
					// $ref_no = sprintf("%'.08d\n", $ref_no);
				}else{
					$i=0;
				}
			}
			$data .= ", date_created = '$bill_date' ";
			$data .= ", ref_no = '$ref_no' ";
			$save = $this->db->query("INSERT INTO sales_list set ".$data);
			$id =$this->db->insert_id;
			foreach($product_id as $k => $v){
				$data = " form_id = '$id' ";
				$data .= ", product_id = '$product_id[$k]' ";
				$data .= ", qty = '$qty[$k]' ";
				$data .= ", type = '2' ";
				$data .= ", stock_from = 'Sales' ";
				$details = json_encode(array('price'=>$price[$k],'qty'=>$qty[$k]));
				$data .= ", other_details = '$details' ";
				$data .= ", date_created = '$bill_date' ";
				$data .= ", remarks = 'Stock out from Sales-".$ref_no."' ";

				$save2[]= $this->db->query("INSERT INTO inventory set ".$data);
			}
			if(isset($save2)){
				return $id;
			}
		}else{
			
			$save = $this->db->query("UPDATE sales_list set ".$data." where id=".$id);
			$ids = implode(",",$inv_id);
			$this->db->query("DELETE FROM inventory where type = 2 and form_id ='$id' and id NOT IN (".$ids.") ");
			foreach($product_id as $k => $v){
				$data = " form_id = '$id' ";
				$data .= ", product_id = '$product_id[$k]' ";
				$data .= ", qty = '$qty[$k]' ";
				$data .= ", type = '2' ";
				$data .= ", stock_from = 'Sales' ";
				$details = json_encode(array('price'=>$price[$k],'qty'=>$qty[$k]));
				$data .= ", other_details = '$details' ";
				$data .= ", date_created = '$bill_date' ";
				$data .= ", remarks = 'Stock out from Sales-".$ref_no."' ";

				if(!empty($inv_id[$k])){
					$save2[]= $this->db->query("UPDATE inventory set ".$data." where id=".$inv_id[$k]);
				}else{
					$save2[]= $this->db->query("INSERT INTO inventory set ".$data);
				}
			}
			if(isset($save2)){
				return $id;
			}
		}
	}
	function delete_sales(){
		extract($_POST);
		$del1 = $this->db->query("DELETE FROM sales_list where id = $id ");
		$del2 = $this->db->query("DELETE FROM inventory where type = 2 and form_id = $id ");
		if($del1 && $del2)
			return 1;
	}

	function sales_report(){
		extract($_POST);
		$temp = array();
		if($fromdate != '' && $todate != '')
		{
			$sales_query = $this->db->query("SELECT * FROM sales_list INNER JOIN customer_list ON sales_list.customer_id = customer_list.id WHERE sales_list.date_created BETWEEN '$fromdate' AND '$todate'");
			if(mysqli_num_rows($sales_query)>0)
			{
				foreach($sales_query as $row){
				   $temp[]= $row;
				}
			}
			else{
				return json_encode(array('data'=>"",'status'=>false,'message'=>"Data Not Available"));
			}
			return json_encode(array('data'=>$temp,'status'=>true));
		}
		else{
			return json_encode(array('data'=>"",'status'=>false,'message'=>"Date is Missing"));
		}
	}

}
