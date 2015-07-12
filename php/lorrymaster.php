<?php
ini_set('error_reporting', E_STRICT);
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