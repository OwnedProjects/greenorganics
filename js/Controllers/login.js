var login = angular.module('login', [
'ngResource'
]);

login.run(function($location) {	
	if(localStorage.user){
		window.location.assign('dashboard.html');
	}
});

login.directive('myCurrentTime', ['$interval', 'dateFilter',
	function($interval, dateFilter) {
	// return the directive link function. (compile function not needed)
	return function(scope, element, attrs) {
		var stopTime; // so that we can cancel the time updates

		// used to update the UI
		function updateTime() {
			element.text(dateFilter(new Date(), 'dd/MM/yyyy, hh:mm:ss a'));
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

login.controller("LoginController", function($scope, $http){
	$scope.checkLogin = function(){
		var userObj={
			"usernm":$scope.usernm,
			"passwd":$scope.passwd
		};
		$http({
			method: 'POST',
			url: 'php/master.php?action=login',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:userObj
		}).
			success(function(data, status, headers, config) {
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){	
			if(result.data.status==true){
				localStorage.setItem("user",$scope.usernm);
				window.location.assign('dashboard.html');
			}
			else{
				$('form').append("<span class='text-danger'><br/><strong>Invalid Credentials. Please login again.</strong></span>");
				setTimeout(function(){
					$('form span').remove();
				},2500);
			}		
		});
	};
});