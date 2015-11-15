var greenorganics = angular.module('greenorganics', [
'ngRoute',
'ngResource'
]);

greenorganics.run(function($location) {	
	if(localStorage.user==undefined){
		window.location.assign('index.html');
	}
});

greenorganics.config(['$routeProvider','$resourceProvider',
  function($routeProvider,$resourceProvider) {
    $routeProvider.
      when('/dashboard', {
        templateUrl: 'views/homepage.html'
      }).
      when('/add_inward_product', {
        templateUrl: 'views/add_inward_product.html'
      }).
      when('/inward_product_list', {
        templateUrl: 'views/inward_product_list.html'
      }).
      when('/purchase_inward_product', {
        templateUrl: 'views/purchase_inward_product.html'
      }).
      when('/purchase_inward_bags', {
        templateUrl: 'views/purchase_inward_bags.html'
      }).
      when('/stock_list', {
        templateUrl: 'views/stock_list.html'
      }).
      when('/add_supplier', {
        templateUrl: 'views/add_supplier.html'
      }).
      when('/supplier_list', {
        templateUrl: 'views/supplier_list.html'
      }).
      when('/deactivated_supplier_list', {
        templateUrl: 'views/deactivated_supplier_list.html'
      }).
      when('/add_lorry', {
        templateUrl: 'views/add_lorry.html'
      }).
      when('/lorry_list', {
        templateUrl: 'views/lorry_list.html'
      }).
      when('/add_production_batch', {
        templateUrl: 'views/add_production_batch.html'
      }).
      when('/add_production_profile', {
        templateUrl: 'views/add_production_profile.html'
      }).
      when('/new_order', {
        templateUrl: 'views/new_order.html'
      }).
      when('/new_client', {
        templateUrl: 'views/new_client.html'
      }).
      when('/client_list', {
        templateUrl: 'views/client_list.html'
      }).
      when('/deactive_client_list', {
        templateUrl: 'views/deactive_client_list.html'
      }).
      when('/inwardPayment', {
        templateUrl: 'views/inwardPayment.html'
      }).
      when('/inwardPaymentBags', {
        templateUrl: 'views/inwardPaymentBags.html'
      }).
      when('/orderPayment', {
        templateUrl: 'views/orderPayment.html'
      }).
      when('/acc_details', {
        templateUrl: 'views/acc_details.html'
      }).
      when('/other_expenses', {
        templateUrl: 'views/other_expenses.html'
      }).
      when('/opening_stock', {
        templateUrl: 'views/opening_stock.html'
      }).
      when('/order_completion', {
        templateUrl: 'views/order_completion.html'
      }).
      when('/reports_purchase', {
        templateUrl: 'views/reports_purchase.html'
      }).
      when('/reports_bags_purchase', {
        templateUrl: 'views/reports_bags_purchase.html'
      }).
      otherwise({
        redirectTo: '/dashboard'
      });
	  
}]);

greenorganics.directive('myCurrentTime', ['$interval', 'dateFilter',
	function($interval, dateFilter) {
	// return the directive link function. (compile function not needed)
	return function(scope, element, attrs) {
		var stopTime; // so that we can cancel the time updates

		// used to update the UI
		function updateTime() {
			element.text(dateFilter(new Date(), 'dd-MM-yyyy, hh:mm:ss a'));
		}

		// watch the expression, and update the UI on change.
		scope.$watch(attrs.myCurrentTime, function() {		  
		  updateTime();
		});

		stopTime = $interval(updateTime, 1000);

		// listen on DOM destroy (removal) event, and cancel the next UI update
		// to prevent updating time after the DOM element was removed.
		element.on('$destroy', function() {
		  $interval.cancel(stopTime);
		});
	}
}]);

greenorganics.controller("mastercontroller", function($scope, $http){
	$scope.logout = function(){
		localStorage.removeItem("user");
		window.location.assign('index.html');
	};
});