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
	
	if($action=='AddProductionBatch'){
		$data = json_decode(file_get_contents("php://input"));
		//echo "fillerpowder".$data->fillerpowder." organicmanure".$data->organicmanure." slaughterhouse".$data->slaughterhouse." gypsum".$data->gypsum." awf".$data->awf." bags".$data->bags." idfillerpowder".$data->idfillerpowder." idorganicmanure".$data->idorganicmanure." idslaughterhouse".$data->idslaughterhouse." idgypsum".$data->idgypsum." idawf".$data->idawf." idbags".$data->idbags." production_date".$data->production_date." production_mnt".$data->production_mnt." production_yr".$data->production_yr." batchno".$data->batchno;
		//exit;
		$addProd="INSERT INTO `production_batch_register`( `batch_no`, `product_produced`, `product_remained`, `filler_powder`, `organic_manure`, `shw`, `gypsum`, `awf`, `bags_used`, `production_date`, `production_month`, `production_year`) VALUES ('".$data->batchno."','10000','10000','".$data->fillerpowder."','".$data->organicmanure."','".$data->slaughterhouse."','".$data->gypsum."','".$data->awf."','".$data->bags."','".$data->production_date."','".$data->production_mnt."','".$data->production_yr."')";
		$resProd=mysql_query($addProd);	
			
			/* Update Stock for filler_powder */
			$selfillerpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idfillerpowder;
			$resfillerpow=mysql_query($selfillerpow);
			$rowfillerpow = mysql_fetch_array($resfillerpow,MYSQL_BOTH);
			$newfstk=intval($rowfillerpow['stock_avail'])-(intval($data->fillerpowder)*1000);
			$updfStock="UPDATE `stock_master` SET `stock_avail`=".$newfstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idfillerpowder;
			mysql_query($updfStock);
			
			/* Update Stock for organic_manure */
			$selorgpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idorganicmanure;
			$resorgpow=mysql_query($selorgpow);
			$roworgpow = mysql_fetch_array($resorgpow,MYSQL_BOTH);
			$neworgstk=intval($roworgpow['stock_avail'])-(intval($data->organicmanure)*1000);
			$updorgStock="UPDATE `stock_master` SET `stock_avail`=".$neworgstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idorganicmanure;
			mysql_query($updorgStock);
			
			/* Update Stock for slaughter_house_waste */
			$selshwpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idslaughterhouse;
			$resshwpow=mysql_query($selshwpow);
			$rowshwpow = mysql_fetch_array($resshwpow,MYSQL_BOTH);
			$newshwstk=intval($rowshwpow['stock_avail'])-(intval($data->slaughterhouse)*1000);
			$updshwStock="UPDATE `stock_master` SET `stock_avail`=".$newshwstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idslaughterhouse;
			mysql_query($updshwStock);
			
			/* Update Stock for gypsum */
			$selgyppow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idgypsum;
			$resgyppow=mysql_query($selgyppow);
			$rowgyppow = mysql_fetch_array($resgyppow,MYSQL_BOTH);
			$newgypstk=intval($rowgyppow['stock_avail'])-(intval($data->gypsum)*1000);
			$updgypStock="UPDATE `stock_master` SET `stock_avail`=".$newgypstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idgypsum;
			mysql_query($updgypStock);
			
			/* Update Stock for awf */
			$selawfpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idawf;
			$resawfpow=mysql_query($selawfpow);
			$rowawfpow = mysql_fetch_array($resawfpow,MYSQL_BOTH);
			$newawfstk=intval($rowawfpow['stock_avail'])-(intval($data->awf)*1000);
			$updawfStock="UPDATE `stock_master` SET `stock_avail`=".$newawfstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idawf;
			mysql_query($updawfStock);
			
			/* Update Stock for Bags */
			$selbagpow="SELECT `stock_avail` FROM `stock_master` where `prod_id`=".$data->idbags;
			$resbagpow=mysql_query($selbagpow);
			$rowbagpow = mysql_fetch_array($resbagpow,MYSQL_BOTH);
			$newbagstk=intval($rowbagpow['stock_avail'])-intval($data->bags);
			$updbagStock="UPDATE `stock_master` SET `stock_avail`=".$newbagstk.",`stock_date`='".$data->production_date."' where `prod_id`=".$data->idbags;
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