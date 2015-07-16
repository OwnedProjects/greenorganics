<?php
//ini_set('error_reporting', E_STRICT);
include ("conn.php");
$action=$_GET['action'];

	if($action=='AddProductionProfile'){
		$data = json_decode(file_get_contents("php://input"));
		$addProf="INSERT INTO `production_profile_master`(`filler_powder`, `organic_manure`, `shw`, `gypsum`, `awf`) VALUES ('".$data->fillerpowder."','".$data->organicmanure."','".$data->slaughterhouse."','".$data->gypsum."','".$data->awf."')";
		$resProf=mysql_query($addProf);		
		if($resProf){
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
				$tmpRes[$cnt]->gypsum=$row['gypsum'];
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
?>