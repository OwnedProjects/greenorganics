greenorganics.controller("NewClientController", function($scope, $http, $route){
	$('.loadSpinner').hide();
	$scope.fetchAllClients = function(){
		$('button').attr("disabled","disabled");
		$scope.clnt=true;
		$http({
			method: 'POST',
			url: 'php/master.php?action=fetchAllClients',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$scope.clients=result.data.clients;
				$scope.clnt=false;
				$('button').removeAttr("disabled");
				$(".loadSpinner").hide();				
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
	//$scope.fetchAllClients();
	
	$scope.addtodb = function(){
		$scope.clnt=true;
		var clientObj={
			"clientnm":$scope.clientnm,
			"address":$scope.address,
			"clientcity":$scope.clientcity,
			"clientdist":$scope.clientdist,
			"clientcontact":$scope.clientcontact,
			"clientcPerson":$scope.clientcontactperson,
			"clientvatno":$scope.clientvatno,
		};
		$(".loadSpinner").show();
		$http({
			method: 'POST',
			url: 'php/master.php?action=insertclientdetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:clientObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('button').attr("disabled","disabled");
				$(".loadSpinner").hide();
				$(".messageDisp").append("<span class='text-success'>Client Added Successfully</span>");
				clientObj=null;
				$scope.clnt=false;
				setTimeout(function(){
					$('button').removeAttr("disabled");
					$route.reload();					
				},1500);
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
	
	$scope.reload = function(){
		$route.reload();
	};
});

greenorganics.controller("ClientListController", function($scope, $http, $route){
	$scope.fetchAllClients = function(){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$scope.clnt=true;
		$http({
			method: 'POST',
			url: 'php/master.php?action=fetchAllClients',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){			
			if(result.data.status==true){
				$('.fullData').show();
				$('.noData').hide();
				$('.loadData').hide();
				$scope.ClientData=result.data.clients;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}			
		});
	};
	$scope.fetchAllClients();
	
	$scope.setEditClientDetails = function(clntid){		
		$(".modal-footer span").remove();
		$scope.clnt=true;
		$http({
			method: 'POST',
			url: 'php/master.php?action=fetchSpecificClientDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:clntid
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){			
			if(result.data.status==true){
				$scope.clntid=clntid;
				$scope.clientnm=result.data.clients[0].client_nm;
				$scope.clientcontact=result.data.clients[0].client_contact;
				$scope.address=result.data.clients[0].client_address;
				$scope.clientcity=result.data.clients[0].client_city;
				$scope.clientdist=result.data.clients[0].client_dist;
				$scope.clientcontactperson=result.data.clients[0].client_cperson;
				$scope.clientvatno=result.data.clients[0].client_vatno;
				
				$scope.clnt=false;
			}
			else{
				alert('Error!!! Please contact System Administrator.');
			}			
		});
	};
	
	$scope.saveEdittedClientDetails = function(){
		var clientObj={
			"clientid":$scope.clntid,
			"clientnm":$scope.clientnm,
			"address":$scope.address,
			"clientcity":$scope.clientcity,
			"clientdist":$scope.clientdist,
			"clientcontact":$scope.clientcontact,
			"clientcontactperson":$scope.clientcontactperson,
			"clientvatno":$scope.clientvatno
		};		
		$http({
			method: 'POST',
			url: 'php/master.php?action=updateClientDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:clientObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('button').attr("disabled","disabled");				
				$(".modal-footer").append("<span class='text-success'>Client Details Modified Successfully</span>");
				clientObj=null;
				$scope.clnt=false;
				setTimeout(function(){
					$('button').removeAttr("disabled");
					$route.reload();					
				},1500);
			}
			else{				
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
	
	$scope.setDeleteClientDetails = function(clntid, clntnm){
		$(".modal-footer span").remove();
		$scope.clientid=clntid;
		$scope.clntnm = clntnm;
	};
	
	$scope.deactivateclient = function(){
		$http({
			method: 'POST',
			url: 'php/master.php?action=deactivateclient',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:$scope.clientid
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){			
			if(result.data.status==true){
				$('button').attr("disabled","disabled");				
				$(".modal-footer").append("<span class='text-success'>Client Deactivated Successfully</span>");
				clientObj=null;
				$scope.clnt=false;
				setTimeout(function(){
					$('button').removeAttr("disabled");
					$route.reload();					
				},1500);
			}
			else{
				alert('Error!!! Please contact System Administrator.');
			}			
		});
	};
});

greenorganics.controller("DeactiveClientListController", function($scope, $http, $route){
	$scope.deactiveclients = function(){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$scope.clnt=true;
		$http({
			method: 'POST',
			url: 'php/master.php?action=deactiveclients',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){			
			if(result.data.status==true){
				$('.fullData').show();
				$('.noData').hide();
				$('.loadData').hide();
				$scope.ClientData=result.data.clients;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}			
		});
	};
	$scope.deactiveclients();
	
	$scope.activateClient = function(clntid){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$scope.clnt=true;
		$http({
			method: 'POST',
			url: 'php/master.php?action=activateClient',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:clntid
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){			
			if(result.data.status==true){
				$('.fullData').show();
				$('.noData').hide();
				$('.loadData').hide();
				$route.reload();
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}			
		});
	};
	
	$scope.reload = function(){
		$route.reload();
	};
});