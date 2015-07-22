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
			}
			else{
				$(".loadData").hide();
				$(".noData").show();
				$(".fullData").hide();
			}			
		});
	};
	$scope.fetchStockDetails();
});