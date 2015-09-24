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
		
			$insProd="INSERT INTO `purchase_register`(`lorry_id`, `supplier_id`, `prod_id`, `billno`, `weight`, `rate`, `lorryfreight`, `finalAmt`, `purchase_date`, `purchase_month`, `purchase_year`) VALUES (".$data->lorryid.",".$data->supplierid.",".$data->productid.",'".$data->billno."',".$data->weight.",'".$data->rate."','".$data->lorryfreight."','".$data->finalAmt."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."')";
			$resinsProd=mysql_query($insProd);
			
			#$milliseconds = round(microtime(true) * 1000); - Returns System get time in PHP
			
			$selProd="SELECT `stock_avail` FROM `stock_master` where `product_type`='Inward' and `prod_id`=".$data->productid;
			$resProd=mysql_query($selProd);
			$rowProd = mysql_fetch_array($resProd,MYSQL_BOTH);
			
			$newstk=floatval($rowProd['stock_avail'])+floatval($data->weight);
			$updtStock="UPDATE `stock_master` SET `stock_avail`=".$newstk.",`stock_date`='".$data->purchaseTm."' where  `product_type`='Inward' and `prod_id`=".$data->productid;
			$resupdtStock = mysql_query($updtStock);			
			
		if($resupdtStock){
			$flag=true;
		}
		$obj->resinsProd=$resinsProd;
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
			$insProd="INSERT INTO `purchase_bag_register`(`lorry_id`, `supplier_id`, `prod_id`, `number_bags`, `billno`, `bill_amount`, `discount`, `net_amount`, `purchase_date`, `purchase_month`, `purchase_year`) VALUES (".$data->lorryid.",".$data->supplierid.",".$data->productid.",'".$data->totalbags."','".$data->billno."','".$data->billamt."','".$data->discount."','".$data->netamt."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."')";			
			$resinsProd=mysql_query($insProd);
			#$milliseconds = round(microtime(true) * 1000); - Returns System get time in PHP
			$selProd="SELECT `stock_avail` FROM `stock_master` where `product_type`='Inward' and `prod_id`=".$data->productid;
			$resProd=mysql_query($selProd);
			$rowProd = mysql_fetch_array($resProd,MYSQL_BOTH);
			$newstk=floatval($rowProd['stock_avail'])+floatval($data->totalbags);
			$updtStock="UPDATE `stock_master` SET `stock_avail`=".$newstk.",`stock_date`='".$data->purchaseTm."' where  `product_type`='Inward' and `prod_id`=".$data->productid;
			$resupdtStock=mysql_query($updtStock);
			$tmpCnt->resinsProd=$resinsProd;
			if($resupdtStock){
				$flag=true;
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
	
	if($action=='updtSupplierDetails'){
		$data = json_decode(file_get_contents("php://input"));
		$addSupplier="UPDATE `supplier_master` SET `supplier_name`='".$data->suppliernm."',`supplier_contact`='".$data->suppliercontact."',`supplier_contact_person`='".$data->contactperson."',`supplier_address`='".$data->address."',`supplier_city`='".$data->suppliercity."',`vat_no`='".$data->vatno."' WHERE `supplier_id`=".$data->suppid;
		
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
		$selStock="SELECT * FROM `stock_master`, `inward_product_master` WHERE stock_master.prod_id=inward_product_master.prod_id";
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
			$selOStock="SELECT * FROM `stock_master`, `outward_product_master` WHERE stock_master.prod_id=outward_product_master.prod_id";
			$resoutward=mysql_query($selOStock);
			$rowoutward = mysql_fetch_array($resoutward,MYSQL_BOTH);
			$tmpNewRes->prod_id=$rowoutward['prod_id'];
			$tmpNewRes->prod_name=$rowoutward['prod_name'];
			$tmpNewRes->prod_type=$rowoutward['product_type'];
			$tmpNewRes->stock_date=$rowoutward['stock_date'];
			$tmpNewRes->stock_avail=$rowoutward['stock_avail'];
			$obj->status=true;
			$obj->Stocks=$tmpRes;
			$obj->OStocks=$tmpNewRes;
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
	
	if($action=='AllProductionBatches'){		
		$selProd="SELECT * FROM `production_batch_register` where `batch_status`='open'";
		$resProd=mysql_query($selProd);
		$count = mysql_num_rows($resProd);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resProd )) {
				$tmpRes[$cnt]->production_id=$row['production_id'];
				$tmpRes[$cnt]->batch_no=$row['batch_no'];
				$tmpRes[$cnt]->prod_produced=$row['product_produced'];
				$tmpRes[$cnt]->prod_remained=$row['product_remained'];
				$cnt++;
			}
			$obj->status=true;
			$obj->Production=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='AddProductionBatch'){
		$data = json_decode(file_get_contents("php://input"));
		$addProd="INSERT INTO `production_batch_register`( `batch_no`, `product_produced`, `product_remained`, `filler_powder`, `organic_manure`, `shw`, `awf`, `bags_used`, `production_date`, `production_month`, `production_year`, `batch_status`) VALUES ('".$data->batchno."','10','10','".$data->fillerpowder."','".$data->organicmanure."','".$data->slaughterhouse."','".$data->awf."','".$data->bags."','".$data->production_date."','".$data->production_mnt."','".$data->production_yr."','open')";
		$resProd=mysql_query($addProd);	
			
			/* Check Stock if ECHO-MEAL is present? */
			$seloutward="SELECT `stock_avail` FROM `stock_master` where `product_type`='Outward' and `prod_id`=1";
			$resoutward=mysql_query($seloutward);
			$rowoutward = mysql_fetch_array($resoutward,MYSQL_BOTH);
			$count = mysql_num_rows($resoutward);
			if($count>0){
				$newOstk=floatval($rowoutward['stock_avail'])+10;
				$updOStock="UPDATE `stock_master` SET `stock_avail`=".$newOstk.",`stock_date`='".$data->production_date."' where  `product_type`='Outward' and `prod_id`=1";
				mysql_query($updOStock);
			}
			else{
				$updOStock="INSERT INTO `stock_master`(`product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES ('Outward','1','10','".$data->production_date."')";
				mysql_query($updOStock);
			}
						
			/* Update Stock for filler_powder */
			$selfillerpow="SELECT `stock_avail` FROM `stock_master` where `product_type`='Inward' and `prod_id`=".$data->idfillerpowder;
			$resfillerpow=mysql_query($selfillerpow);
			$rowfillerpow = mysql_fetch_array($resfillerpow,MYSQL_BOTH);
			$newfstk=floatval($rowfillerpow['stock_avail'])-(floatval($data->fillerpowder));
			$updfStock="UPDATE `stock_master` SET `stock_avail`=".$newfstk.",`stock_date`='".$data->production_date."' where  `product_type`='Inward' and `prod_id`=".$data->idfillerpowder;
			mysql_query($updfStock);
			
			/* Update Stock for organic_manure */
			$selorgpow="SELECT `stock_avail` FROM `stock_master` where `product_type`='Inward' and `prod_id`=".$data->idorganicmanure;
			$resorgpow=mysql_query($selorgpow);
			$roworgpow = mysql_fetch_array($resorgpow,MYSQL_BOTH);
			$neworgstk=floatval($roworgpow['stock_avail'])-(floatval($data->organicmanure));
			$updorgStock="UPDATE `stock_master` SET `stock_avail`=".$neworgstk.",`stock_date`='".$data->production_date."' where `product_type`='Inward' and `prod_id`=".$data->idorganicmanure;
			mysql_query($updorgStock);
			
			/* Update Stock for slaughter_house_waste */
			$selshwpow="SELECT `stock_avail` FROM `stock_master` where `product_type`='Inward' and `prod_id`=".$data->idslaughterhouse;
			$resshwpow=mysql_query($selshwpow);
			$rowshwpow = mysql_fetch_array($resshwpow,MYSQL_BOTH);
			$newshwstk=floatval($rowshwpow['stock_avail'])-(floatval($data->slaughterhouse));
			$updshwStock="UPDATE `stock_master` SET `stock_avail`=".$newshwstk.",`stock_date`='".$data->production_date."' where `product_type`='Inward' and `prod_id`=".$data->idslaughterhouse;
			mysql_query($updshwStock);
			
			/* Update Stock for awf */
			$selawfpow="SELECT `stock_avail` FROM `stock_master` where `product_type`='Inward' and `prod_id`=".$data->idawf;
			$resawfpow=mysql_query($selawfpow);
			$rowawfpow = mysql_fetch_array($resawfpow,MYSQL_BOTH);
			$newawfstk=floatval($rowawfpow['stock_avail'])-(floatval($data->awf));
			$updawfStock="UPDATE `stock_master` SET `stock_avail`=".$newawfstk.",`stock_date`='".$data->production_date."' where `product_type`='Inward' and `prod_id`=".$data->idawf;
			mysql_query($updawfStock);
			
			/* Update Stock for Bags */
			$selbagpow="SELECT `stock_avail` FROM `stock_master` where `product_type`='Inward' and `prod_id`=".$data->idbags;
			$resbagpow=mysql_query($selbagpow);
			$rowbagpow = mysql_fetch_array($resbagpow,MYSQL_BOTH);
			$newbagstk=floatval($rowbagpow['stock_avail'])-floatval($data->bags);
			$updbagStock="UPDATE `stock_master` SET `stock_avail`=".$newbagstk.",`stock_date`='".$data->production_date."' where `product_type`='Inward' and `prod_id`=".$data->idbags;
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

/* Client Details */	
	if($action=='insertclientdetails'){
		$data = json_decode(file_get_contents("php://input"));
		$insClients="INSERT INTO `client_master`(`client_name`, `address`, `city`, `district`, `contact_no`, `contact_person`, `vat_no`, `client_status`) VALUES ('".$data->clientnm."','".$data->address."','".$data->clientcity."','".$data->clientdist."','".$data->clientcontact."','".$data->clientcPerson."','".$data->clientvatno."','active')";
		$resClients=mysql_query($insClients);		
		if($resClients){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='updateClientDetails'){
		$data = json_decode(file_get_contents("php://input"));
		$insClients="UPDATE `client_master` SET `client_name`='".$data->clientnm."',`address`='".$data->address."',`city`='".$data->clientcity."',`district`='".$data->clientdist."',`contact_no`='".$data->clientcontact."',`contact_person`='".$data->clientcontactperson."',`vat_no`='".$data->clientvatno."' WHERE `client_id`=".$data->clientid;		
		$resClients=mysql_query($insClients);		
		if($resClients){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='deactivateclient'){
		$data = json_decode(file_get_contents("php://input"));
		$insClients="UPDATE `client_master` SET `client_status`='deactive' WHERE `client_id`=".$data;		
		$resClients=mysql_query($insClients);		
		if($resClients){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='activateClient'){
		$data = json_decode(file_get_contents("php://input"));
		$insClients="UPDATE `client_master` SET `client_status`='active' WHERE `client_id`=".$data;		
		$resClients=mysql_query($insClients);		
		if($resClients){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='fetchAllClients'){
		$selClients="SELECT * FROM `client_master` WHERE `client_status`='active'";
		$resClients=mysql_query($selClients);
		$count = mysql_num_rows($resClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resClients )) {
				$tmpRes[$cnt]->client_id=$row['client_id'];				
				$tmpRes[$cnt]->client_nm=$row['client_name'];				
				$tmpRes[$cnt]->client_contact=$row['contact_no'];				
				$tmpRes[$cnt]->client_address=$row['address'];				
				$tmpRes[$cnt]->client_city=$row['city'];				
				$tmpRes[$cnt]->client_dist=$row['district'];				
				$tmpRes[$cnt]->client_cperson=$row['contact_person'];				
				$tmpRes[$cnt]->client_vatno=$row['vat_no'];				
				$cnt++;
			}
			$obj->status=true;
			$obj->clients=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='fetchSpecificClientDetails'){
		$data = json_decode(file_get_contents("php://input"));
		$selClients="SELECT * FROM `client_master` WHERE `client_status`='active' and client_id=".$data;
		$resClients=mysql_query($selClients);
		$count = mysql_num_rows($resClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resClients )) {
				$tmpRes[$cnt]->client_id=$row['client_id'];				
				$tmpRes[$cnt]->client_nm=$row['client_name'];				
				$tmpRes[$cnt]->client_contact=$row['contact_no'];				
				$tmpRes[$cnt]->client_address=$row['address'];				
				$tmpRes[$cnt]->client_city=$row['city'];				
				$tmpRes[$cnt]->client_dist=$row['district'];				
				$tmpRes[$cnt]->client_cperson=$row['contact_person'];				
				$tmpRes[$cnt]->client_vatno=$row['vat_no'];					
				$cnt++;
			}
			$obj->status=true;
			$obj->clients=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
		
	if($action=='deactiveclients'){
		$selClients="SELECT * FROM `client_master` WHERE `client_status`='deactive'";
		$resClients=mysql_query($selClients);
		$count = mysql_num_rows($resClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resClients )) {
				$tmpRes[$cnt]->client_id=$row['client_id'];				
				$tmpRes[$cnt]->client_nm=$row['client_name'];				
				$tmpRes[$cnt]->client_contact=$row['contact_no'];				
				$tmpRes[$cnt]->client_address=$row['address'];				
				$tmpRes[$cnt]->client_city=$row['city'];				
				$tmpRes[$cnt]->client_dist=$row['district'];				
				$tmpRes[$cnt]->client_cperson=$row['contact_person'];				
				$tmpRes[$cnt]->client_vatno=$row['vat_no'];					
				$cnt++;
			}
			$obj->status=true;
			$obj->clients=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
/* Order Queries */
	if($action=='NewOrder'){
		
		/* UPDATE Stock ECHO-MEAL */
			$data = json_decode(file_get_contents("php://input"));
			$seloutward="SELECT `stock_avail` FROM `stock_master` where `product_type`='Outward' and `prod_id`=1";
			$resoutward=mysql_query($seloutward);
			$rowoutward = mysql_fetch_array($resoutward,MYSQL_BOTH);
			$count = mysql_num_rows($resoutward);
			if($count>0){
				/* Update Stock_master */
				$newOstk=floatval($rowoutward['stock_avail'])-floatval($data->quantity);
				$updOStock="UPDATE `stock_master` SET `stock_avail`=".$newOstk.",`stock_date`='".$data->sale_date."' where  `product_type`='Outward' and `prod_id`=1";
				mysql_query($updOStock);
				
				/* Insert New Order */
				$insOrder="INSERT INTO `sales_register`(`order_no`, `dc_no`, `order_date`, `dispatch_date`, `client_id`, `lorry_id`, `quantity`, `billno`, `bill_date`, `bill_amount`, `discount`, `net_amount`, `vat_amount`, `sale_date`, `sale_month`, `sale_year`) VALUES ('".$data->order_no."','".$data->dc_no."','".$data->order_date."','".$data->disp_date."',".$data->client_id.",".$data->lorry_id.",'".$data->quantity."','".$data->billno."','".$data->bill_date."','".$data->bill_amount."','".$data->discount."','".$data->net_amount."','".$data->vat_amount."','".$data->sale_date."','".$data->sale_month."','".$data->sale_year."')";
				$resOrder=mysql_query($insOrder);
				if($resOrder){
					$selmaxorder="SELECT MAX(`sales_id`) FROM `sales_register`";
					$resmaxorder=mysql_query($selmaxorder);
					$rowmaxorder = mysql_fetch_array($resmaxorder,MYSQL_BOTH);
					$maxOrder=$rowmaxorder['MAX(`sales_id`)'];
					
					$batchObj=$data->batches_obj;
					for($i=0;$i<count($batchObj);$i++) {
						$selbatch="SELECT `product_remained` FROM `production_batch_register` WHERE `batch_no`=".$batchObj[$i]->batchno;
						$resbatch=mysql_query($selbatch);
						$rowbatch = mysql_fetch_array($resbatch,MYSQL_BOTH);
						$newprodRem=floatval($rowbatch['product_remained'])-floatval($batchObj[$i]->volume);
						
						$updBatch="UPDATE `production_batch_register` SET `product_remained`='".$newprodRem."' WHERE `batch_no`=".$batchObj[$i]->batchno;
						mysql_query($updBatch);
						
						$insbatchOrder="INSERT INTO `sales_batch_register`(`sales_id`, `batch_no`, `volume`) VALUES (".$maxOrder.",'".$batchObj[$i]->batchno."','".$batchObj[$i]->volume."')";
						$resBatchOrder=mysql_query($insbatchOrder);
						
						if($batchObj[$i]->volume_remained==0){
							$updBatchNew="UPDATE `production_batch_register` SET `batch_status`='closed' WHERE `batch_no`=".$batchObj[$i]->batchno;
							mysql_query($updBatchNew);
						}
						//INSERT INTO `sales_batch_register`(`sales_id`, `batch_no`, `volume`) VALUES ([value-1],[value-2],[value-3])
					}
					$obj->status=true;
				}
			}
			else{
				$obj->status=false;
			}
		echo json_encode($obj);
	}

	if($action=='makeInwardPayment'){
		$data = json_decode(file_get_contents("php://input"));
			if($data->payFlag==true){
				$insAccounts1="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`) VALUES (".$data->supplierid.", 'inward', 'credit','".$data->finalAmt."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."')";
				$insAcc1 = mysql_query($insAccounts1);
				if($insAcc1){
					$obj->status=true;			
				}
				else{
					$obj->status=false;
				}
			}
			else{
				$insAccounts1="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`) VALUES (".$data->supplierid.", 'inward', 'credit','".$data->finalAmt."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."')";
				$insAcc1 = mysql_query($insAccounts1);
				
				$insAccounts2="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`, `acc_particulars`) VALUES (".$data->supplierid.", 'inward', 'debit','".$data->payAmount."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."','".$data->payParticulars."')";
				$insAcc2 = mysql_query($insAccounts2);
				if($insAcc1 && $insAcc2){
					$obj->status=true;			
				}
				else{
					$obj->status=false;
				}
			}
		echo json_encode($obj);
	}
	
	
	if($action=='makeinwardPayBags'){
		$data = json_decode(file_get_contents("php://input"));
			if($data->payFlag==true){
				$insAccounts1="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`) VALUES (".$data->supplierid.", 'inward', 'credit','".$data->netamt."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."')";
				$insAcc1 = mysql_query($insAccounts1);
				if($insAcc1){
					$obj->status=true;			
				}
				else{
					$obj->status=false;
				}
			}
			else{
				$insAccounts1="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`) VALUES (".$data->supplierid.", 'inward', 'credit','".$data->netamt."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."')";
				$insAcc1 = mysql_query($insAccounts1);
				
				$insAccounts2="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`, `acc_particulars`) VALUES (".$data->supplierid.", 'inward', 'debit','".$data->payAmount."','".$data->purchaseTm."','".$data->purchaseMnt."','".$data->purchaseYr."','".$data->payParticulars."')";
				$insAcc2 = mysql_query($insAccounts2);
				if($insAcc1 && $insAcc2){
					$obj->status=true;			
				}
				else{
					$obj->status=false;
				}
			}
		echo json_encode($obj);
	}
	
	if($action=='makeorderObj'){
		$data = json_decode(file_get_contents("php://input"));
			if($data->payFlag==true){
				$insAccounts1="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`) VALUES (".$data->client_id.", 'outward', 'debit','".$data->net_amount."','".$data->sale_date."','".$data->sale_month."','".$data->sale_year."')";
				$insAcc1 = mysql_query($insAccounts1);
				if($insAcc1){
					$obj->status=true;			
				}
				else{
					$obj->status=false;
				}
			}
			else{
				$insAccounts1="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`) VALUES (".$data->client_id.", 'outward', 'debit','".$data->net_amount."','".$data->sale_date."','".$data->sale_month."','".$data->sale_year."')";
				$insAcc1 = mysql_query($insAccounts1);
				
				$insAccounts2="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`, `acc_particulars`) VALUES (".$data->client_id.", 'outward', 'credit','".$data->payAmount."','".$data->sale_date."','".$data->sale_month."','".$data->sale_year."','".$data->payParticulars."')";
				$insAcc2 = mysql_query($insAccounts2);
				if($insAcc1 && $insAcc2){
					$obj->status=true;			
				}
				else{
					$obj->status=false;
				}
			}
		echo json_encode($obj);
	}

/* Accounts */
	if($action == 'fetchAllOutwardAccDetails'){
		$selAccClients="SELECT distinct(`acc_client_id`),`client_name`, `acc_type` FROM `account_register`,`client_master` WHERE account_register.acc_client_id=client_master.client_id and account_register.acc_type='outward'";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->acc_client_id=$row['acc_client_id'];
				$tmpRes[$cnt]->client_name=$row['client_name'];
				$tmpRes[$cnt]->acc_type=$row['acc_type'];
				$cnt++;
			}
			$obj->status=true;
			$obj->outaccdetails=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action == 'fetchAllInwardAccDetails'){
		$selAccClients="SELECT distinct(`acc_client_id`),`supplier_name`, `acc_type` FROM `account_register`,`supplier_master` WHERE  account_register.acc_client_id=supplier_master.supplier_id and account_register.acc_type='inward'";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->acc_client_id=$row['acc_client_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->acc_type=$row['acc_type'];
				$cnt++;
			}
			$obj->status=true;
			$obj->inaccdetails=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action == 'fetchAccDetails'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT *  FROM `account_register` WHERE  acc_client_id=".$data->id." and acc_type='".$data->type."'";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->acc_client_id=$row['acc_client_id'];				
				$tmpRes[$cnt]->creditdebit=$row['credit_debit'];				
				$tmpRes[$cnt]->acc_amount=$row['acc_amount'];				
				$tmpRes[$cnt]->acc_date=$row['acc_date'];				
				$tmpRes[$cnt]->acc_particulars=$row['acc_particulars'];				
				$tmpRes[$cnt]->acc_type=$row['acc_type'];
				$cnt++;
			}
			
			$selTotDebitAmt="SELECT SUM(`acc_amount`) FROM `account_register` WHERE acc_client_id=".$data->id." and acc_type='".$data->type."' and `credit_debit`='debit'";
			$resTotDebitAmt=mysql_query($selTotDebitAmt);
			$rowTotDebitAmt = mysql_fetch_array($resTotDebitAmt,MYSQL_BOTH);
			
			$selTotCreditAmt="SELECT SUM(`acc_amount`) FROM `account_register` WHERE acc_client_id=".$data->id." and acc_type='".$data->type."' and `credit_debit`='credit'";
			$resTotCreditAmt=mysql_query($selTotCreditAmt);
			$rowTotCreditAmt = mysql_fetch_array($resTotCreditAmt,MYSQL_BOTH);
			
			$obj->status=true;
			$obj->accdetails=$tmpRes;
			$obj->totDebitAmt=$rowTotDebitAmt['SUM(`acc_amount`)'];
			$obj->totCreditAmt=$rowTotCreditAmt['SUM(`acc_amount`)'];
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
			
	if($action=='remainingPay'){
		$data = json_decode(file_get_contents("php://input"));
		$insAccounts1="INSERT INTO `account_register`(`acc_client_id`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`, `acc_particulars`) VALUES (".$data->id.", '".$data->acctype."', '".$data->debCred."','".$data->payAmt."','".$data->accdate."','".$data->accmonth."','".$data->accyear."','".$data->particulars."')";
		$insAcc1 = mysql_query($insAccounts1);
		if($insAcc1){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='otherExpenseNames'){
		$selAccClients="SELECT distinct(`expense_name`) FROM `otherexpense_master`";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->acc_nonclient=$row['expense_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->expenseObj=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='otherExpensePayment'){
		$data = json_decode(file_get_contents("php://input"));
		
		$insExpense="INSERT INTO `otherexpense_master`(`expense_name`) SELECT * FROM (SELECT '".$data->expenseDetails."') AS tmp WHERE NOT EXISTS (SELECT expense_name from `otherexpense_master` where `expense_name`='".$data->expenseDetails."')";
		$resExpense=mysql_query($insExpense);		
		
		$selExpId="SELECT `expense_id` FROM `otherexpense_master` WHERE `expense_name`='".$data->expenseDetails."'";
		$resExpId=mysql_query($selExpId);
		$rowExpId = mysql_fetch_array($resExpId,MYSQL_BOTH);
		$expid=$rowExpId['expense_id'];
		
		$insAccounts1="INSERT INTO `account_register`(`acc_nonclientid`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`, `acc_particulars`) VALUES (".$expid.", 'debit','".$data->payAmt."','".$data->expTime."','".$data->empMnt."','".$data->expYr."','".$data->particulars."')";
		$insAcc1 = mysql_query($insAccounts1);
		
		if($insAcc1){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		
		echo json_encode($obj);
	}
?>
