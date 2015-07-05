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
?>