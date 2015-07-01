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
        templateUrl: 'views/dashboard.html'
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
			element.text(dateFilter(new Date(), 'dd/MM/yyyy, HH:mm:ss'));
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