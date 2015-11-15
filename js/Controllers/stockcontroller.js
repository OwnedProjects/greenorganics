greenorganics.controller("StockListController", function($scope, $http, $route){
	$scope.fetchStockDetails = function(){
		$(".loadData").show();
		$(".noData").hide();
		$(".fullData").hide();
		$http({
			method: 'POST',
			url: 'php/master.php?action=fetchStockDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$(".loadData").hide();
				$(".noData").hide();
				$(".fullData").show();
				$scope.stockdata=result.data.Stocks;				
				$scope.outstockdata=result.data.OStocks;				
			}
			else{
				$(".loadData").hide();
				$(".noData").show();
				$(".fullData").hide();
			}			
		});
	};
	$scope.fetchStockDetails();
	
	$scope.reload = function(){
		$route.reload();
	};
	
});

greenorganics.controller("OpeningStockController", function($scope, $http, $route){
	$scope.prodpresent=true;
	$scope.checkStock = function(){
		$http({
			method: 'POST',
			url: 'php/master.php?action=fetchStockDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.loadSpinner').hide();
				$scope.prodpresent=true;
			}
			else{
				$('.loadSpinner').hide();
				$scope.prodpresent=false;
			}			
		});
	};
	
	$scope.checkStock();
	$scope.openStock = function(){
		if($scope.prod_bags != null && $scope.prod_bags != undefined && $scope.prod_bags != '' && $scope.prod_awf != null && $scope.prod_awf != undefined && $scope.prod_awf != '' && $scope.prod_fp != null && $scope.prod_fp != undefined && $scope.prod_fp != '' && $scope.prod_shw != null && $scope.prod_shw != undefined && $scope.prod_shw != '' && $scope.prod_rom != null && $scope.prod_rom != undefined && $scope.prod_rom != '' && $scope.prod_echomeal != null && $scope.prod_echomeal != undefined && $scope.prod_echomeal != '' && $('#stockDate').val() != null && $('#stockDate').val() != undefined && $('#stockDate').val() != '' ){
			
		var dt=new Date();
		dt.setDate(parseInt($("#stockDate").val().split('/')[0]));
		dt.setMonth(parseInt($("#stockDate").val().split('/')[1])-1);
		dt.setYear(parseInt($("#stockDate").val().split('/')[2]));
		var stkObj={
			"stkDt":dt.getTime(),
			"prod_rom":$scope.prod_rom,
			"prod_shw":$scope.prod_shw,
			"prod_fp":$scope.prod_fp,
			"prod_awf":$scope.prod_awf,
			"prod_bags":$scope.prod_bags,
			"prod_echomeal":$scope.prod_echomeal
		};
		$http({
			method: 'POST',
			url: 'php/master.php?action=openNewStock',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:stkObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				alert('Opened New Stock');
				$route.reload();
			}
			else{
				alert('Error in Opening Stock, Please try again..');
				$('.loadSpinner').hide();
				$scope.prodpresent=false;
			}			
		});
			
		}
		else{
			alert('Please fill all the fields..');
		}
	};
});