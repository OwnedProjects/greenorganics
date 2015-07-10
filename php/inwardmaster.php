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
		
		$selProd="SELECT MAX(`prod_id`) FROM `inward_product_master`";
		$resProd=mysql_query($selProd);
		$rowProd = mysql_fetch_array($resProd,MYSQL_BOTH);
		
		$insStock="INSERT INTO `stock_master`(`product_type`, `prod_id`) VALUES ('Inward',".$rowProd['MAX(`prod_id`)'].")";
		mysql_query($insStock);
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
			$insProd="INSERT INTO `purchase_master`(`lorry_id`, `supplier_id`, `prod_id`, `weight`, `rate`, `lorryfreight`, `finalAmt`, `purchase_date`) VALUES (".$data[$i]->lorryid.",".$data[$i]->supplierid.",".$data[$i]->productid.",".$data[$i]->weightinkg.",'".$data[$i]->rate."','".$data[$i]->lorryfreight."','".$data[$i]->finalAmt."','".$data[$i]->purchaseTm."')";
			$resinsProd=mysql_query($insProd);
			$milliseconds = round(microtime(true) * 1000);
			$selProd="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data[$i]->productid;
			$resProd=mysql_query($selProd);
			$rowProd = mysql_fetch_array($resProd,MYSQL_BOTH);
			$newstk=intval($rowProd['stock_avail'])+intval($data[$i]->weightinkg);
			$updtStock="UPDATE `stock_master` SET `stock_avail`=".$newstk.",`stock_date`='".$milliseconds."' where `prod_id`=".$data[$i]->productid;
			$resupdtStock=mysql_query($updtStock);
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
	
	/* Supplier Details */
	if($action=='AllSuppliers'){
		$selSupplier="SELECT * FROM `supplier_master`,`inward_product_master` WHERE supplier_master.prod_id=inward_product_master.prod_id and supplier_master.supplier_status='active'";
		$resSupplier=mysql_query($selSupplier);
		$count = mysql_num_rows($resSupplier);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resSupplier )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_nm=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->supplier_contact_person=$row['supplier_contact_person'];
				$tmpRes[$cnt]->supplier_address=$row['supplier_address'];
				$tmpRes[$cnt]->supplier_vatno=$row['vat_no'];
				$tmpRes[$cnt]->supplier_city=$row['supplier_city'];
				$tmpRes[$cnt]->prod_id=$row['prod_id'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->Suppliers=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	
	if($action=='AddSupplierToDB'){
		$data = json_decode(file_get_contents("php://input"));
		$addSupplier="INSERT INTO `supplier_master`( `prod_id`, `supplier_name`, `supplier_contact`, `supplier_contact_person`, `supplier_address`, `supplier_city`, `vat_no`, `supplier_status`) VALUES (".$data->prodid.",'".$data->suppliernm."','".$data->suppliercontact."','".$data->contactperson."','".$data->address."','".$data->suppliercity."','".$data->vatno."','active')";
		$resSupplier=mysql_query($addSupplier);
		if($resSupplier){
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='fetchSpecificSupplierDetails'){
		$data = json_decode(file_get_contents("php://input"));
		$selSupplier="SELECT * FROM `supplier_master` WHERE supplier_id=".$data;
		$resSupplier=mysql_query($selSupplier);
		$row = mysql_fetch_array($resSupplier,MYSQL_BOTH);
		$count = mysql_num_rows($resSupplier);
		if($count>0){
			$tmpRes->supplier_id=$row['supplier_id'];
			$tmpRes->supplier_nm=$row['supplier_name'];
			$tmpRes->supplier_contact=$row['supplier_contact'];
			$tmpRes->supplier_contact_person=$row['supplier_contact_person'];
			$tmpRes->supplier_address=$row['supplier_address'];
			$tmpRes->supplier_vatno=$row['vat_no'];
			$tmpRes->supplier_city=$row['supplier_city'];
			$tmpRes->prod_id=$row['prod_id'];
			$obj->status=true;
			$obj->Suppliers=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='deactivatesupplier'){
		$data = json_decode(file_get_contents("php://input"));
		$selSupplier="UPDATE `supplier_master` SET `supplier_status`='deactive' WHERE `supplier_id`=".$data;
		$resSupplier=mysql_query($selSupplier);		
		if($resSupplier){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='activatesuppliers'){
		$data = json_decode(file_get_contents("php://input"));
		$selSupplier="UPDATE `supplier_master` SET `supplier_status`='active' WHERE `supplier_id`=".$data;
		$resSupplier=mysql_query($selSupplier);		
		if($resSupplier){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
		
	if($action=='AllDeactiveSuppliers'){
		$selSupplier="SELECT * FROM `supplier_master`,`inward_product_master` WHERE supplier_master.prod_id=inward_product_master.prod_id and supplier_master.supplier_status='deactive'";
		$resSupplier=mysql_query($selSupplier);
		$count = mysql_num_rows($resSupplier);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resSupplier )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_nm=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->supplier_contact_person=$row['supplier_contact_person'];
				$tmpRes[$cnt]->supplier_address=$row['supplier_address'];
				$tmpRes[$cnt]->supplier_vatno=$row['vat_no'];
				$tmpRes[$cnt]->supplier_city=$row['supplier_city'];
				$tmpRes[$cnt]->prod_id=$row['prod_id'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->Suppliers=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
?>