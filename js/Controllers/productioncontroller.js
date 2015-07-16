greenorganics.controller("AddProductionBatchController", function($scope, $http, $route){
	$scope.profileFlag=false;
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
	
	$scope.setprofileDetails = function(fillerpowder,organicmanure,slaughterhouse,gypsum,awf){
		$scope.fillerpowder=fillerpowder;
		$scope.organicmanure=organicmanure;
		$scope.slaughterhouse=slaughterhouse;
		$scope.gypsum=gypsum;
		$scope.awf=awf;
		$('#setprofile').modal('hide');
		$scope.profileFlag=true;
	};
});

greenorganics.controller("AddProductionProfileController", function($scope, $http, $route){
	$('.waitspinner').hide();
	$scope.addProfile = function(){
		var prodObj={
			"fillerpowder":$scope.fillerpowder,
			"organicmanure":$scope.organicmanure,
			"slaughterhouse":$scope.slaughterhouse,
			"gypsum":$scope.gypsum,
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