<?php
ini_set('error_reporting', E_STRICT);
include ("conn.php");
$action=$_GET['action'];

	if($action=='login'){
		$data = json_decode(file_get_contents("php://input"));
		//echo "Usernm: ".$data->usernm." -*- passwd: ".$data->passwd;
		$selUser="SELECT * FROM `user_master` where `username`='".$data->usernm."' and `password`='".$data->passwd."'";
		$resUser=mysql_query($selUser);		
		$count = mysql_num_rows($resUser);
		if($resUser && $count>0){
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
/* INWARD MASTER */
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
		
		$insStock="INSERT INTO `stock_master`(`product_type`, `prod_id`, `stock_avail`) VALUES ('Inward',".$rowProd['MAX(`prod_id`)'].",'0')";
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
			$insProd="INSERT INTO `purchase_register`(`lorry_id`, `supplier_id`, `prod_id`, `billno`, `weight`, `rate`, `lorryfreight`, `finalAmt`, `purchase_date`, `purchase_month`, `purchase_year`) VALUES (".$data[$i]->lorryid.",".$data[$i]->supplierid.",".$data[$i]->productid.",'".$data[$i]->billno."',".$data[$i]->weightinkg.",'".$data[$i]->rate."','".$data[$i]->lorryfreight."','".$data[$i]->finalAmt."','".$data[$i]->purchaseTm."','".$data[$i]->purchaseMnt."','".$data[$i]->purchaseYr."')";
			$resinsProd=mysql_query($insProd);
			#$milliseconds = round(microtime(true) * 1000); - Returns System get time in PHP
			$selProd="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data[$i]->productid;
			$resProd=mysql_query($selProd);
			$rowProd = mysql_fetch_array($resProd,MYSQL_BOTH);
			$newstk=floatval($rowProd['stock_avail'])+floatval($data[$i]->weightinkg);
			$updtStock="UPDATE `stock_master` SET `stock_avail`=".$newstk.",`stock_date`='".$data[$i]->purchaseTm."' where `prod_id`=".$data[$i]->productid;
			$resupdtStock=mysql_query($updtStock);
			$tmpCnt[$i]->resinsProd=$resinsProd;
			if($resupdtStock){
				$flag=true;
			}
		}
		$obj->resinsProd=$tmpCnt;
		 if($flag==true){
			$obj->status=true;
		 }
		 else{
			 $obj->status=false;
		 }
		echo json_encode($obj);
	}
	
	if($action=='AddPurchaseBagsToDB'){
		$data = json_decode(file_get_contents("php://input"));
		$flag=false;
		for($i=0;$i<count($data);$i++){
			$insProd="INSERT INTO `purchase_bag_register`(`lorry_id`, `supplier_id`, `prod_id`, `billno`, `totalbags`, `purchase_date`, `purchase_month`, `purchase_year`) VALUES (".$data[$i]->lorryid.",".$data[$i]->supplierid.",".$data[$i]->productid.",'".$data[$i]->billno."','".$data[$i]->totalbags."','".$data[$i]->purchaseTm."','".$data[$i]->purchaseMnt."','".$data[$i]->purchaseYr."')";
			$resinsProd=mysql_query($insProd);
			#$milliseconds = round(microtime(true) * 1000); - Returns System get time in PHP
			$selProd="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data[$i]->productid;
			$resProd=mysql_query($selProd);
			$rowProd = mysql_fetch_array($resProd,MYSQL_BOTH);
			$newstk=floatval($rowProd['stock_avail'])+floatval($data[$i]->totalbags);
			$updtStock="UPDATE `stock_master` SET `stock_avail`=".$newstk.",`stock_date`='".$data[$i]->purchaseTm."' where `prod_id`=".$data[$i]->productid;
			$resupdtStock=mysql_query($updtStock);
			$tmpCnt[$i]->resinsProd=$resinsProd;
			if($resupdtStock){
				$flag=true;
			}
		}
		$obj->resinsProd=$tmpCnt;
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
	
	if($action=='AllSuppliersNonBags'){
		$selSupplier="SELECT * FROM `supplier_master`,`inward_product_master` WHERE supplier_master.prod_id=inward_product_master.prod_id and supplier_master.supplier_status='active' and NOT inward_product_master.prod_name='HDPE Bags'";
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
	
	if($action=='AllSuppliersOnlyBags'){
		$selSupplier="SELECT * FROM `supplier_master`,`inward_product_master` WHERE supplier_master.prod_id=inward_product_master.prod_id and supplier_master.supplier_status='active' and inward_product_master.prod_name='HDPE Bags'";
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

/* STOCK MASTER */
	if($action=='fetchStockDetails'){
		$selStock="SELECT * FROM `stock_master`, `inward_product_master` WHERE stock_master.prod_id=inward_product_master.prod_id ";
		$resStock=mysql_query($selStock);
		$count = mysql_num_rows($resStock);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resStock )) {
				$tmpRes[$cnt]->prod_id=$row['prod_id'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$tmpRes[$cnt]->prod_type=$row['product_type'];
				$tmpRes[$cnt]->stock_date=$row['stock_date'];
				$tmpRes[$cnt]->stock_avail=$row['stock_avail'];
				$cnt++;
			}
			$obj->status=true;
			$obj->Stocks=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}

	if($action=='FetchDetailedStockForProduction'){
		$selStock="SELECT * FROM `stock_master`, `inward_product_master` WHERE stock_master.prod_id=inward_product_master.prod_id";
		$resStock=mysql_query($selStock);
		$count = mysql_num_rows($resStock);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resStock )) {
				$tmpRes[$cnt]->prod_id=$row['prod_id'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$tmpRes[$cnt]->stock_avail=$row['stock_avail'];
				$cnt++;
			}
			$obj->status=true;
			$obj->Stocks=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}

/* PRODUCTION MASTER */
	if($action=='AddProductionProfile'){
		$data = json_decode(file_get_contents("php://input"));
		$addProf="INSERT INTO `production_profile_master`(`filler_powder`, `organic_manure`, `shw`, `awf`) VALUES ('".$data->fillerpowder."','".$data->organicmanure."','".$data->slaughterhouse."','".$data->awf."')";
		$resProf=mysql_query($addProf);		
		if($resProf){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='AddProductionBatch'){
		$data = json_decode(file_get_contents("php://input"));
		$addProd="INSERT INTO `production_batch_register`( `batch_no`, `product_produced`, `product_remained`, `filler_powder`, `organic_manure`, `shw`, `awf`, `bags_used`, `production_date`, `production_month`, `production_year`) VALUES ('".$data->batchno."','10000','10000','".$data->fillerpowder."','".$data->organicmanure."','".$data->slaughterhouse."','".$data->awf."','".$data->bags."','".$data->production_date."','".$data->production_mnt."','".$data->production_yr."')";
		$resProd=mysql_query($addProd);	
			
			/* Update Stock for filler_powder */
			$selfillerpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idfillerpowder;
			$resfillerpow=mysql_query($selfillerpow);
			$rowfillerpow = mysql_fetch_array($resfillerpow,MYSQL_BOTH);
			$newfstk=floatval($rowfillerpow['stock_avail'])-(floatval($data->fillerpowder)*1000);
			$updfStock="UPDATE `stock_master` SET `stock_avail`=".$newfstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idfillerpowder;
			mysql_query($updfStock);
			
			/* Update Stock for organic_manure */
			$selorgpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idorganicmanure;
			$resorgpow=mysql_query($selorgpow);
			$roworgpow = mysql_fetch_array($resorgpow,MYSQL_BOTH);
			$neworgstk=floatval($roworgpow['stock_avail'])-(floatval($data->organicmanure)*1000);
			$updorgStock="UPDATE `stock_master` SET `stock_avail`=".$neworgstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idorganicmanure;
			mysql_query($updorgStock);
			
			/* Update Stock for slaughter_house_waste */
			$selshwpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idslaughterhouse;
			$resshwpow=mysql_query($selshwpow);
			$rowshwpow = mysql_fetch_array($resshwpow,MYSQL_BOTH);
			$newshwstk=floatval($rowshwpow['stock_avail'])-(floatval($data->slaughterhouse)*1000);
			$updshwStock="UPDATE `stock_master` SET `stock_avail`=".$newshwstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idslaughterhouse;
			mysql_query($updshwStock);
			
			/* Update Stock for awf */
			$selawfpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idawf;
			$resawfpow=mysql_query($selawfpow);
			$rowawfpow = mysql_fetch_array($resawfpow,MYSQL_BOTH);
			$newawfstk=floatval($rowawfpow['stock_avail'])-(floatval($data->awf)*1000);
			$updawfStock="UPDATE `stock_master` SET `stock_avail`=".$newawfstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idawf;
			mysql_query($updawfStock);
			
			/* Update Stock for Bags */
			$selbagpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idbags;
			$resbagpow=mysql_query($selbagpow);
			$rowbagpow = mysql_fetch_array($resbagpow,MYSQL_BOTH);
			$newbagstk=floatval($rowbagpow['stock_avail'])-floatval($data->bags);
			$updbagStock="UPDATE `stock_master` SET `stock_avail`=".$newbagstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idbags;
			mysql_query($updbagStock);

		if($resProd){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}

	if($action=='DeleteProfile'){
		$data = json_decode(file_get_contents("php://input"));
		$delProf="DELETE FROM `production_profile_master` WHERE `profile_id`=".$data->profid;
		$resProf=mysql_query($delProf);		
		if($resProf){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='GetProfiles'){
		$selProfiles="SELECT * FROM `production_profile_master`";
		$resProfiles=mysql_query($selProfiles);
		$count = mysql_num_rows($resProfiles);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resProfiles )) {
				$tmpRes[$cnt]->profile_id=$row['profile_id'];
				$tmpRes[$cnt]->fillerpowder=$row['filler_powder'];
				$tmpRes[$cnt]->organicmanure=$row['organic_manure'];
				$tmpRes[$cnt]->slaughterhouse=$row['shw'];
				$tmpRes[$cnt]->awf=$row['awf'];
				$cnt++;
			}
			$obj->status=true;
			$obj->Profiles=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}

/* LORRY MASTER */
	if($action=='AllLorries'){
		$selLorries="SELECT * FROM `lorry_register`";
		$resLorry=mysql_query($selLorries);
		$count = mysql_num_rows($resLorry);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resLorry )) {
				$tmpRes[$cnt]->lorry_id=$row['lorry_id'];
				$tmpRes[$cnt]->lorry_no=$row['lorry_number'];
				$cnt++;
			}
			$obj->status=true;
			$obj->lorries=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='addlorry'){
		$data = json_decode(file_get_contents("php://input"));
		$selLorries="INSERT INTO `lorry_register`(`lorry_number`) SELECT * FROM (SELECT '".$data->lorry."') AS tmp WHERE NOT EXISTS (SELECT lorry_number from `lorry_register` where `lorry_number`='".$data->lorry."')";
		$resLorry=mysql_query($selLorries);		
		if($resLorry){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='DelLorry'){
		$data = json_decode(file_get_contents("php://input"));
		$selLorries="DELETE FROM `lorry_register` WHERE `lorry_id`=".$data;
		$resLorry=mysql_query($selLorries);		
		if($resLorry){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
?>