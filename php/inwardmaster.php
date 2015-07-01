<?php
//ini_set('error_reporting', E_STRICT);
include ("conn.php");
$action=$_GET['action'];

	if($action=='checkinwardproductdetails'){		
		$selUser="SELECT MAX(`prod_id`) FROM `inward_product_master`";
		$resUser=mysql_query($selUser);
		$rowuser = mysql_fetch_array($resUser,MYSQL_BOTH);
		$count = mysql_num_rows($resUser);
		if($resUser && $count>0){
			$obj->prodcount=$rowuser['MAX(`prod_id`)'];
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='insertinwardproductdetails'){
		$data = json_decode(file_get_contents("php://input"));
		$insUser="INSERT INTO `inward_product_master`(`prod_name`) VALUES ('".$data->prodnm."')";
		$resinsUser=mysql_query($insUser);				
		if($resinsUser){			
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
?>