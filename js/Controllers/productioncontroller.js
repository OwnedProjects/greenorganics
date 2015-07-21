greenorganics.controller("AddProductionBatchController", function($scope, $http, $route){
	$scope.profileFlag=false;
	$scope.stocks=null;
	$('.waitspinner').hide();
	$scope.getProfiles = function(){		
		$(".fullData").hide();
		$(".noData").hide();
		$(".loadData").show();
		$http({
			method: 'POST',
			url: 'php/productionmaster.php?action=GetProfiles',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$(".fullData").show();
				$(".noData").hide();
				$(".loadData").hide();
				$scope.profileData=result.data.Profiles;
			}
			else{
				$(".fullData").hide();
				$(".noData").show();
				$(".loadData").hide();
			}			
		});
	};
	
	$scope.setprofileDetails = function(fillerpowder,organicmanure,slaughterhouse,awf){
		$scope.fillerpowder=fillerpowder;
		$scope.organicmanure=organicmanure;
		$scope.slaughterhouse=slaughterhouse;
		$scope.awf=awf;
		$('#setprofile').modal('hide');
		$scope.profileFlag=true;
	};
	
	$scope.FetchDetailedStock = function(){
		$http({
			method: 'POST',
			url: 'php/stockmaster.php?action=FetchDetailedStockForProduction',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){				
				$scope.stkfillerpowder=result.data.Stocks[0].stock_avail/1000;
				$scope.stkorganicmanure=result.data.Stocks[1].stock_avail/1000;
				$scope.stkslaughterhouse=result.data.Stocks[2].stock_avail/1000;
				$scope.stkawf=result.data.Stocks[3].stock_avail/1000;
				$scope.stkbags=result.data.Stocks[4].stock_avail;
				
				$scope.stkfillerpowderid=result.data.Stocks[0].prod_id;
				$scope.stkorganicmanureid=result.data.Stocks[1].prod_id;
				$scope.stkslaughterhouseid=result.data.Stocks[2].prod_id;
				$scope.stkawfid=result.data.Stocks[3].prod_id;
				$scope.stkbagsid=result.data.Stocks[4].prod_id;
			}
		});
	};
	$scope.FetchDetailedStock();
	
	$scope.$watch('fillerpowder + awf+ slaughterhouse+ organicmanure', function() {
		$scope.totValProd = parseFloat($scope.fillerpowder) + parseFloat($scope.awf)+ parseFloat($scope.slaughterhouse) + parseFloat($scope.organicmanure);
		console.log($scope.totValProd);
	});
	
	$scope.addBatch = function(){
		if($scope.fillerpowder>$scope.stkfillerpowder || $scope.organicmanure>$scope.stkorganicmanure || $scope.slaughterhouse>$scope.stkslaughterhouse || $scope.awf > $scope.stkawf  || parseInt($scope.bags) > parseInt($scope.stkbags)){
			alert('Please check you entries, Production values cannot be more than stock available.');
			throw 'Please check you entries, Production values cannot be more than stock available.';
		}
		var dt=new Date();
		dt.setDate(parseInt($("#prodDate").val().split('/')[0]));
		dt.setMonth(parseInt($("#prodDate").val().split('/')[1])-1);
		dt.setYear(parseInt($("#prodDate").val().split('/')[2]));
		console.log(dt.getTime());
		var prodObj={
			"batchno":$scope.batchNo,
			"fillerpowder":$scope.fillerpowder,
			"organicmanure":$scope.organicmanure,
			"slaughterhouse":$scope.slaughterhouse,
			"awf":$scope.awf,
			"bags":$scope.bags,
			"idfillerpowder":$scope.stkfillerpowderid,
			"idorganicmanure":$scope.stkorganicmanureid,
			"idslaughterhouse":$scope.stkslaughterhouseid,
			"idawf":$scope.stkawfid,
			"idbags":$scope.stkbagsid,
			"production_date":dt.getTime(),
			"production_mnt":parseInt($("#prodDate").val().split('/')[1])-1,
			"production_yr":parseInt($("#prodDate").val().split('/')[2])
		};
		$(".waitspinner").show();
		$http({
			method: 'POST',
			url: 'php/productionmaster.php?action=AddProductionBatch',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:prodObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('input').attr("disabled","disabled");
				$(".waitspinner").hide();
				$("form").prepend("<strong class='text-success'>Production Batch Added Successfully</strong>");
				prodObj=null;
				setTimeout(function(){
					$('input').removeAttr("disabled");
					$route.reload();					
				},1500);
			}
			else{
				$(".waitspinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
});

greenorganics.controller("AddProductionProfileController", function($scope, $http, $route){
	$('.waitspinner').hide();
	$scope.addProfile = function(){
		var prodObj={
			"fillerpowder":$scope.fillerpowder,
			"organicmanure":$scope.organicmanure,
			"slaughterhouse":$scope.slaughterhouse,
			"awf":$scope.awf
		};
		$(".waitspinner").show();
		$http({
			method: 'POST',
			url: 'php/productionmaster.php?action=AddProductionProfile',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:prodObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('button').attr("disabled","disabled");
				$(".waitspinner").hide();
				$("form").append("<span class='text-success'>Profile Added Successfully</span>");
				prodObj=null;
				setTimeout(function(){
					$('button').removeAttr("disabled");
					$route.reload();					
				},1500);
			}
			else{
				$(".waitspinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
	
	$scope.getProfiles = function(){		
		$(".fullData").hide();
		$(".noData").hide();
		$(".loadData").show();
		$http({
			method: 'POST',
			url: 'php/productionmaster.php?action=GetProfiles',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$(".fullData").show();
				$(".noData").hide();
				$(".loadData").hide();
				$scope.profileData=result.data.Profiles;
			}
			else{
				$(".fullData").hide();
				$(".noData").show();
				$(".loadData").hide();
			}			
		});
	};
		
	$scope.deleteProfile = function(profid){
		$('.waitspinner').hide();
		var prodObj={
			"profid":profid
		};
		$(".waitspinner").show();
		$http({
			method: 'POST',
			url: 'php/productionmaster.php?action=DeleteProfile',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:prodObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('button').attr("disabled","disabled");
				$(".waitspinner").hide();
				$("table strong").remove();
				$("table").append("<strong class='text-success'>Profile Deleted Successfully</strong>");
				prodObj=null;
				setTimeout(function(){
					$('button').removeAttr("disabled");
					$route.reload();					
				},1500);
			}
			else{
				$(".waitspinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
});