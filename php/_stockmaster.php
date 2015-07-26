<?php
ini_set('error_reporting', E_STRICT);
include ("conn.php");
$action=$_GET['action'];

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
?>