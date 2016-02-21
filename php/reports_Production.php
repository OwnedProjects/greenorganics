<?php
ini_set('error_reporting', E_STRICT);
include ("conn.php");

$action=$_GET['action'];	
/* Reports Purchases */
	if($action=='fromtoProdMonthlyReports'){
		$data = json_decode(file_get_contents("php://input"));
		//$selAccClients="SELECT * FROM `production_batch_register` where (production_month>=".$data->frmMnt." and production_month<=".$data->toMnt.") and  (production_year>=".$data->frmYr." and production_year<=".$data->toYr.") order by `production_date` desc";
		$selAccClients="SELECT * FROM `production_batch_register` where (production_date>=".$data->frmDt." and production_date<=".$data->toDt.") order by `production_date` desc";
		
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->batch_no=$row['batch_no'];
				$tmpRes[$cnt]->product_produced=$row['product_produced'];
				$tmpRes[$cnt]->product_remained=$row['product_remained'];
				$tmpRes[$cnt]->filler_powder=$row['filler_powder'];
				$tmpRes[$cnt]->organic_manure=$row['organic_manure'];
				$tmpRes[$cnt]->shw=$row['shw'];
				$tmpRes[$cnt]->awf=$row['awf'];
				$tmpRes[$cnt]->bags_used=$row['bags_used'];
				$tmpRes[$cnt]->production_date=$row['production_date'];
				$tmpRes[$cnt]->production_month=$row['production_month'];
				$tmpRes[$cnt]->production_year=$row['production_year'];
				$tmpRes[$cnt]->batch_status=$row['batch_status'];
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
