<?php
//ini_set('error_reporting', E_STRICT);
include ("conn.php");
$action=$_GET['action'];

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
?>