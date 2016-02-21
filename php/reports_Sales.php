<?php
ini_set('error_reporting', E_STRICT);
include ("conn.php");

$action=$_GET['action'];	
/* Reports Purchases */
	if($action=='fromtoSaleOrdersMonthlyReports'){
		$data = json_decode(file_get_contents("php://input"));
		$selAccClients="SELECT * FROM `sales_register`,`client_master` where (order_date>=".$data->frmDt." and order_date<=".$data->toDt.") and client_master.client_id=sales_register.client_id order by `order_date` desc";
		
		$resAccClients=mysql_query($selAccClients);
		$count = mysql_num_rows($resAccClients);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resAccClients )) {
				$tmpRes[$cnt]->order_no=$row['order_no'];
				$tmpRes[$cnt]->dc_no=$row['dc_no'];
				$tmpRes[$cnt]->order_date=$row['order_date'];
				$tmpRes[$cnt]->dispatch_date=$row['dispatch_date'];
				$tmpRes[$cnt]->client_id=$row['client_id'];
				$tmpRes[$cnt]->client_name=$row['client_name'];
				$tmpRes[$cnt]->client_city=$row['city'];
				$tmpRes[$cnt]->quantity=$row['quantity'];
				$tmpRes[$cnt]->billno=$row['billno'];
				$tmpRes[$cnt]->bill_date=$row['bill_date'];
				$tmpRes[$cnt]->bill_amount=$row['bill_amount'];
				$tmpRes[$cnt]->discount=$row['discount'];
				$tmpRes[$cnt]->net_amount=$row['net_amount'];
				$tmpRes[$cnt]->vat_amount=$row['vat_amount'];
				$tmpRes[$cnt]->sale_date=$row['sale_date'];
				$tmpRes[$cnt]->sale_status=$row['sale_status'];
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
