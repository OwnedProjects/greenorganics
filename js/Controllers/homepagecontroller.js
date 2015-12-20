greenorganics.controller("DashboardController", function($scope, $http, $route){
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
		
		$(".loadDataOrder").show();
		$(".noDataOrder").hide();
		$(".fullDataOrder").hide();
		$http({
			method: 'GET',
			url: 'php/master.php?action=allPendingOrders',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$(".loadDataOrder").hide();
				$(".noDataOrder").hide();
				$(".fullDataOrder").show();
				$scope.salesData=result.data.salesData;				
			}
			else{
				$(".loadDataOrder").hide();
				$(".noDataOrder").show();
				$(".fullDataOrder").hide();
			}			
		});
	};
	$scope.fetchStockDetails();
	
	$scope.reload = function(){
		$route.reload();
	};
});