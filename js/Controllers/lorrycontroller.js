greenorganics.controller("AddLorryController", function($scope, $http, $route){
	$('.waitspinner').hide();
	
	$scope.addlorry = function(){
		$('.waitspinner').show();
		var tmpString=$scope.lorrystate+ " "+$("#lorrystatecode").val()+"/"+ $scope.lorrycode+" "+$('#lorryno').val();		
		var lorryObj={
			"lorry":tmpString.toUpperCase()
		};
		$http({
			method: 'POST',
			url: 'php/master.php?action=addlorry',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data: lorryObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$(".displayMsg").prepend('<strong class="text-success">Lorry Added Successfully</strong>');
				setTimeout(function(){
					$(".displayMsg strong").remove();
					$('.waitspinner').hide();
					$route.reload();
				},2000);
			}
			else{
				alert('Error!!! Please contact your system Administrator.');
			}
		});
	};
});

greenorganics.controller("LorryListController", function($scope, $http, $route){
	$scope.loadLorries = function(){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/master.php?action=AllLorries',
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
				$scope.lorryData=result.data.lorries;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}
		});
	};
	$scope.loadLorries();
	
	$scope.setlorryDetails = function(lorryid,lorryno){		
		$scope.lorryid=lorryid;
		$scope.lorryno=lorryno;
	};
	
	$scope.deletelorry = function(){		
		$http({
			method: 'POST',
			url: 'php/master.php?action=DelLorry',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:$scope.lorryid
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.modal-footer').prepend('<strong class="text-success">Lorry Deleted Successfully</strong>');
				setTimeout(function(){
					$route.reload();
				},1000);
			}
			else{
				alert('Error!!! Please contact your system Administrator.');
			}
		});
	};
});