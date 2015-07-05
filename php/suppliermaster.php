<?php
ini_set('error_reporting', E_STRICT);
include ("conn.php");
$action=$_GET['action'];

	if($action=='AllSuppliers'){
		$selSupplier="SELECT * FROM `supplier_master`,`inward_product_master` WHERE supplier_master.prod_id=inward_product_master.prod_id";
		$resSupplier=mysql_query($selSupplier);
		$count = mysql_num_rows($resSupplier);
		if($count>0){
			$cnt=0;
			while($row = mysql_fetch_array( $resSupplier )) {
				$tmpRes[$cnt]->supplier_id=$row['supplier_id'];
				$tmpRes[$cnt]->supplier_nm=$row['supplier_name'];
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