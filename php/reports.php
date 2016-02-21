<?php
ini_set('error_reporting', E_STRICT);
include ("conn.php");

$action=$_GET['action'];	
/* Reports Purchases */
	if($action=='reportsMonthlyPurchases'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE purchase_register.purchase_month='".$data->mnth."' and purchase_register.purchase_year=".$data->year." and purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->monthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='reportsMonthlyPurchasesWithSuppliers'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE purchase_register.purchase_month='".$data->mnth."' and purchase_register.purchase_year=".$data->year." and purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id and purchase_register.supplier_id=".$data->supplierid." order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->monthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='reportsMonthlyPurchasesWithProducts'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE purchase_register.purchase_month='".$data->mnth."' and purchase_register.purchase_year=".$data->year." and purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id and purchase_register.prod_id=".$data->productid." order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->monthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='reportsYearlyPurchases'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE purchase_register.purchase_year=".$data->year." and purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->yearlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='reportsYearlyPurchasesWithSuppliers'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE purchase_register.purchase_year=".$data->year." and purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id and purchase_register.supplier_id=".$data->supplierid." order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->yearlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='reportsYearlyPurchasesWithProduct'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE purchase_register.purchase_year=".$data->year." and purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id and purchase_register.prod_id=".$data->productid." order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->yearlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='fromToMonthlyPurchases'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE (purchase_register.purchase_month>=".$data->frmMnt." and purchase_register.purchase_month<=".$data->toMnt.") and  (purchase_register.purchase_year>=".$data->frmYr." and purchase_register.purchase_year<=".$data->toYr.") and  purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->fromtoMonthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='fromToMonthlyPurchasesWithSuppliers'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE (purchase_register.purchase_month>='".$data->frmMnt."' and purchase_register.purchase_month<='".$data->toMnt."') and  (purchase_register.purchase_year>='".$data->frmYr."' and purchase_register.purchase_year<='".$data->toYr."') and  purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id and purchase_register.supplier_id=".$data->supplierid." order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->fromtoMonthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='fromToMonthlyPurchasesWithProducts'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE (purchase_register.purchase_month>='".$data->frmMnt."' and purchase_register.purchase_month<='".$data->toMnt."') and  (purchase_register.purchase_year>='".$data->frmYr."' and purchase_register.purchase_year<='".$data->toYr."') and  purchase_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_register.prod_id and purchase_register.prod_id=".$data->productid." order by purchase_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->fromtoMonthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='purchaseSupplierReports'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccSupplier="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE (purchase_register.supplier_id=".$data." and purchase_register.supplier_id=supplier_master.supplier_id and  inward_product_master.prod_id=purchase_register.prod_id) order by purchase_register.purchase_date desc";
		$resAccSupplier=mysql_query($selAccSupplier);
		$count = mysql_num_rows($resAccSupplier);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccSupplier )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->purchaseSupplierReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='purchaseProductReports'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccSupplier="SELECT * FROM `purchase_register`, `supplier_master`, `inward_product_master` WHERE (purchase_register.prod_id=".$data." and purchase_register.supplier_id=supplier_master.supplier_id and  inward_product_master.prod_id=purchase_register.prod_id) order by purchase_register.purchase_date desc";
		$resAccSupplier=mysql_query($selAccSupplier);
		$count = mysql_num_rows($resAccSupplier);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccSupplier )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->purchaseProductReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}

/* End Reports */

	if($action=='openNewStock'){
		$data = json_decode(file_get_contents("php://input"));
		$openStk1="INSERT INTO `stock_master`(`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES (1,'Inward','12','".$data->prod_fp."','".$data->stkDt."')";
		$openStk2="INSERT INTO `stock_master`(`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES (2,'Inward','13','".$data->prod_rom."','".$data->stkDt."')";
		$openStk3="INSERT INTO `stock_master`(`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES (3,'Inward','14','".$data->prod_shw."','".$data->stkDt."')";
		$openStk4="INSERT INTO `stock_master`(`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES (4,'Inward','15','".$data->prod_awf."','".$data->stkDt."')";
		$openStk5="INSERT INTO `stock_master`(`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES (5,'Inward','17','".$data->prod_bags."','".$data->stkDt."')";
		$openStk6="INSERT INTO `stock_master`(`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES (6,'Outward','1','".$data->prod_echomeal."','".$data->stkDt."')";
		$resopenStk1 = mysql_query($openStk1);
		$resopenStk2 = mysql_query($openStk2);
		$resopenStk3 = mysql_query($openStk3);
		$resopenStk4 = mysql_query($openStk4);
		$resopenStk5 = mysql_query($openStk5);
		$resopenStk6 = mysql_query($openStk6);
		if($resopenStk1 && $resopenStk2 && $resopenStk3 && $resopenStk4 && $resopenStk5 && $resopenStk6 ){
			$obj->status=true;			
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='allOrderNumbers'){
		$selAccClients="SELECT * FROM `sales_register`, `client_master` WHERE sales_register.client_id=client_master.client_id and sales_register.sale_status='open'";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->sales_id=$row['sales_id'];
				$tmpRes[$cnt]->order_no=$row['order_no'];
				$tmpRes[$cnt]->dc_no=$row['dc_no'];
				$tmpRes[$cnt]->order_date=$row['order_date'];
				$tmpRes[$cnt]->dispatch_date=$row['dispatch_date'];
				$tmpRes[$cnt]->quantity=$row['quantity'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->bill_date=$row['bill_date'];
				$tmpRes[$cnt]->bill_amount=$row['bill_amount'];
				$tmpRes[$cnt]->discount=$row['discount'];
				$tmpRes[$cnt]->net_amount=$row['net_amount'];
				$tmpRes[$cnt]->vat_amount=$row['vat_amount'];
				$tmpRes[$cnt]->sale_date=$row['sale_date'];
				$tmpRes[$cnt]->client_name=$row['client_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->orderObj=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='completeOrder'){
		$data = json_decode(file_get_contents("php://input"));
		
		$batchObj=$data->batches_obj;		
		$updLorry ="UPDATE `sales_register` SET `lorry_id`='".$data->lorry_id."',`order_completion_date`='".$data->order_comp_time."',`order_completion_month`='".$data->order_comp_month."',`order_completion_year`='".$data->order_comp_time."',`sale_status`='closed' WHERE `sales_id`=".$data->sales_id;
		mysql_query($updLorry);
		
		for($i=0;$i<count($batchObj);$i++) {
			$selbatch="SELECT `product_remained` FROM `production_batch_register` WHERE `batch_no`=".$batchObj[$i]->batchno;
			$resbatch=mysql_query($selbatch);
			$rowbatch = mysql_fetch_array($resbatch,MYSQL_BOTH);
			$newprodRem=floatval($rowbatch['product_remained'])-floatval($batchObj[$i]->volume);
			
			$updBatch="UPDATE `production_batch_register` SET `product_remained`='".$newprodRem."' WHERE `batch_no`=".$batchObj[$i]->batchno;
			mysql_query($updBatch);
			
			$insbatchOrder="INSERT INTO `sales_batch_register`(`sales_id`, `batch_no`, `volume`) VALUES (".$data->sales_id.",'".$batchObj[$i]->batchno."','".$batchObj[$i]->volume."')";
			$resBatchOrder=mysql_query($insbatchOrder);
			
			if($batchObj[$i]->volume_remained==0){
				$updBatchNew="UPDATE `production_batch_register` SET `batch_status`='closed' WHERE `batch_no`=".$batchObj[$i]->batchno;
				mysql_query($updBatchNew);
			}
			//INSERT INTO `sales_batch_register`(`sales_id`, `batch_no`, `volume`) VALUES ([value-1],[value-2],[value-3])
		}
		
		if(updLorry){
			$obj->status=true;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	/* Reports Bags Purchases */
	if($action=='reportsBagsMonthlyPurchases'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_bag_register`, `supplier_master`, `inward_product_master` WHERE purchase_bag_register.purchase_month='".$data->mnth."' and purchase_bag_register.purchase_year=".$data->year." and purchase_bag_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_bag_register.prod_id order by purchase_bag_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->monthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	
	
	if($action=='reportsBagsYearlyPurchases'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_bag_register`, `supplier_master`, `inward_product_master` WHERE purchase_bag_register.purchase_year=".$data->year." and purchase_bag_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_bag_register.prod_id order by purchase_bag_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->yearlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	//fromtoBagMonthlyReports
	if($action=='fromtoBagMonthlyReports'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `purchase_bag_register`, `supplier_master`, `inward_product_master` WHERE (purchase_bag_register.purchase_month>='".$data->frmMnt."' and purchase_bag_register.purchase_month<='".$data->toMnt."') and  (purchase_bag_register.purchase_year>='".$data->frmYr."' and purchase_bag_register.purchase_year<='".$data->toYr."') and  purchase_bag_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_bag_register.prod_id order by purchase_bag_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->fromtoMonthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	if($action=='purchaseBagsSupplierReports'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccSupplier="SELECT * FROM `purchase_bag_register`, `supplier_master`, `inward_product_master` WHERE (purchase_bag_register.supplier_id=".$data." and purchase_bag_register.supplier_id=supplier_master.supplier_id and  inward_product_master.prod_id=purchase_bag_register.prod_id) order by purchase_bag_register.purchase_date desc";
		$resAccSupplier=mysql_query($selAccSupplier);
		$count = mysql_num_rows($resAccSupplier);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccSupplier )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->purchaseSupplierReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
	
	
	if($action=='fromToMonthlyPurchasesBagsSuppliers'){
		$data = json_decode(file_get_contents("php://input"));
		//$selAccClients="SELECT * FROM `purchase_bag_register`, `supplier_master`, `inward_product_master` WHERE (purchase_bag_register.purchase_month>='".$data->frmMnt."' and purchase_bag_register.purchase_month<='".$data->toMnt."') and  (purchase_bag_register.purchase_year>='".$data->frmYr."' and purchase_bag_register.purchase_year<='".$data->toYr."') and  purchase_bag_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_bag_register.prod_id and  purchase_register.supplier_id=".$data->supplierid." order by purchase_bag_register.purchase_date desc";
		$selAccClients="SELECT * FROM `purchase_bag_register`, `supplier_master`, `inward_product_master` WHERE (purchase_bag_register.purchase_month>=".$data->frmMnt." and purchase_bag_register.purchase_month<=".$data->toMnt.") and  (purchase_bag_register.purchase_year>=".$data->frmYr." and purchase_bag_register.purchase_year<=".$data->toYr.") and  purchase_bag_register.supplier_id=supplier_master.supplier_id and inward_product_master.prod_id=purchase_bag_register.prod_id and  purchase_bag_register.supplier_id=".$data->supplierid." order by purchase_bag_register.purchase_date desc";
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_name=$row['supplier_name'];
				$tmpRes[$cnt]->supplier_contact=$row['supplier_contact'];
				$tmpRes[$cnt]->vat_no=$row['vat_no'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->rate=$row['rate'];
				$tmpRes[$cnt]->lorryfreight=$row['lorryfreight'];
				$tmpRes[$cnt]->finalAmt=$row['finalAmt'];
				$tmpRes[$cnt]->weight=$row['weight'];
				$tmpRes[$cnt]->purchase_date=$row['purchase_date'];
				$tmpRes[$cnt]->prod_name=$row['prod_name'];
				$cnt++;
			}
			$obj->status=true;
			$obj->fromtoMonthlyReport=$tmpRes;
		}
		else{
			$obj->status=false;
		}
		echo json_encode($obj);
	}
?>