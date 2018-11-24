<?php 
$servername = "localhost";
$username = "root";
$password = "1st";
$dbname = "dmcpharmacy";

echo $ip= ($_SERVER['SERVER_ADDR']);
if($ip!='192.168.1.54'){
$servername = "localhost";
$username = "";
$password = "S#t6";
$dbname = "";
}
 echo "<br>";


// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(true){
echo "<pre>";

   echo "<pre>";
	//die;
 	$sql2="SELECT *  FROM  `unit`";
	$result = $conn->query($sql2);
	
	while($row = $result->fetch_array()){
		 $ot_s_array[$row['unitid']] = array($row['unitvalue'],$row['unitname'],$row['unitid']);
		 
	}
	$sql2="SELECT *  FROM  `product`";
	$result = $conn->query($sql2);
	while($row = $result->fetch_array()){
		 $prod_array[$row['productid']] = array($row['productname'],$row['product_typeid'],$row['composition_id']);
		 
	}
	
	echo $sql2="SELECT *  FROM  `zz_import_date`  limit 10000";
	$result = $conn->query($sql2);
	//print_r($result);
	$tot_f=array();
	while($row = $result->fetch_array()){
		
		$df= $row['Name'];
		if($df!=""){
			$df_1=explode(" ",$df);
		echo 	$type_1=$df_1[sizeof($df_1) - 1];
	//	if(key_exists()){
			$tot_f[$type_1]=$type_1;
		//}
			//echo "<br>";
		}
		
		$pid=$row['Name']; 
		if(key_exists($pid, $ot_s_array)){
			 
			$type_type=$ot_s_array[$pid][1]; 
			if($row["type"]==$type_type){
				//$qty=$ot_s_array[$pid][3]+$row["ff"]; 
				$qty=$row["Qty"]; 
				$sql2="UPDATE  `invoice_stock_master` SET  `item_qty` =  '".$qty."' ,`marked_imp`=1 WHERE  `master_id` =".$ot_s_array[$pid][0].";";
				
				 $f=$row["Qty"]."+".$ot_s_array[$pid][3]."=".$sql2;
			}else{
				$sql2="INSERT INTO `invoice_stock_master` ( `branch_id`, `item_id`, `item_type`, `item_qty`, `created_at`,`marked_imp`) 
			VALUES ( '37', '".$row["type_id"]."', '".$row["type"]."', '".$row["Qty"]."', CURRENT_TIMESTAMP,'1');";
			 $f="IN_ins".$row["type"]."==".$type_type;
			}
		}else{
		 	 //$sql2="INSERT INTO `invoice_stock_master` ( `branch_id`, `item_id`, `item_type`, `item_qty`, `created_at`,`marked_imp`) 
			//VALUES ( '37', '".$row["type_id"]."', '".$row["type"]."', '".$row["Qty"]."', CURRENT_TIMESTAMP,'1');";
			 //$f="INSTALL".$row["type"]."==".$type_type.'='.$sql2;
		}
		//echo $f."<br>";
		//$result_4 = $conn->query($sql2);
		//die;
	}	
	print_r($tot_f);
		echo "Finished";
		
	
}else if(false){
	
} 
		

?>

