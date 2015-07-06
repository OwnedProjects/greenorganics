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
	
	if($action=='allproductdetails'){
		$selProds="SELECT * FROM `inward_product_master`";
		$resProds=mysql_query($selProds);
		$count = mysql_num_rows($resProds);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resProds )) {
				$tmpRes[$cnt]->prod_id=$row['prod_id'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->Products=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='saveEdittedProductDetails'){
		$data = json_decode(file_get_contents("php://input"));
		$updtUser="UPDATE `inward_product_master` SET `prod_name`='".$data->prodnm."' WHERE `prod_id`=".$data->prodid;
		$resupdtUser=mysql_query($updtUser);
		if($resupdtUser){
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}

	if($action=='deleteproduct'){
		$data = json_decode(file_get_contents("php://input"));
		$delProd="DELETE FROM `inward_product_master` WHERE `prod_id`=".$data->prodid;
		$resdelProd=mysql_query($delProd);
		if($resdelProd){
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}	
	
	if($action=='AddPurchaseDetailsToDB'){
		$data = json_decode(file_get_contents("php://input"));
		$flag=false;
		for($i=0;$i<count($data);$i++){
			$insProd="INSERT INTO `purchase_master`(`lorry_id`, `supplier_id`, `prod_id`, `weight`, `rate`, `discount`, `finalAmt`, `purchase_date`) VALUES (".$data[$i]->lorryid.",".$data[$i]->supplierid.",".$data[$i]->productid.",'".$data[$i]->weightinkg."','".$data[$i]->rate."','".$data[$i]->discount."','".$data[$i]->finalAmt."','".$data[$i]->purchaseTm."')";
			$resinsProd=mysql_query($insProd);
			if($resinsProd){
				$flag=true;
			}
		}
		if($flag==true){			
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
?>