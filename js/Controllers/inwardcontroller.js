greenorganics.controller("addinwardcontroller", function($scope, $http, $route){
	$scope.initfunction = function(){
		$(".waitspinner").show();
		$http({
			method: 'POST',
			url: 'php/inwardmaster.php?action=checkinwardproductdetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				if(result.data.prodcount == null){
					$scope.prodid=1;
				}
				else{
					$scope.prodid=parseInt(result.data.prodcount)+1;
				}
			}
			else{
				alert('Error!!! Please contact system Administrator.');
			}
			$(".waitspinner").hide();
		});
	};
	$scope.initfunction();
	
	$scope.addProduct = function(){
		var prodObj={
			"prodnm":$scope.prodname
		};
		$(".waitspinner").show();
		$http({
			method: 'POST',
			url: 'php/inwardmaster.php?action=insertinwardproductdetails',
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
				$("form").append("<span class='text-success'>Product Added Successfully</span>");
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