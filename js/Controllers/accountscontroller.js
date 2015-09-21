greenorganics.controller("FetchAccountDetails", function($scope, $http, $route){
	$("#accDetailsTab").hide();
	$scope.fetchAllOutwardAccDetails = function(){
		$('.loadSpinner').show();
		$('button').attr("disabled","disabled");
		$scope.clnt=true;
		$http({
			method: 'GET',
			url: 'php/master.php?action=fetchAllOutwardAccDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$scope.outaccdetails=result.data.outaccdetails;				
				$('button').removeAttr("disabled");
				$(".loadSpinner").hide();				
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
	$scope.fetchAllInwardAccDetails = function(){
		$('.loadSpinner').show();
		$('button').attr("disabled","disabled");
		$scope.clnt=true;
		$http({
			method: 'GET',
			url: 'php/master.php?action=fetchAllInwardAccDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$scope.inaccdetails=result.data.inaccdetails;				
				$('button').removeAttr("disabled");
				$(".loadSpinner").hide();				
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
	
	$scope.fetchAllInwardAccDetails();
	$scope.fetchAllOutwardAccDetails();
	
	$scope.showAccDetails = function(accid,accname,acctype){
		$('.mainWrapper').hide();
		$("#accDetailsTab").show();		
		$(".dataloadSpinner").show();
		$scope.accid=accid;
		$scope.accname=accname;
		$scope.acctype=acctype;
		$scope.accdetails=null;
		$scope.totDebitAmt=0;
		$scope.totCreditAmt=0;
		var tmpObj={
			"id":accid,
			"name":accname,
			"type":acctype
		}
		$http({
			method: 'POST',
			url: 'php/master.php?action=fetchAccDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:tmpObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$(".dataloadSpinner").hide();
				$scope.accdetails=result.data.accdetails;
				if(result.data.totDebitAmt!=null){
					$scope.totDebitAmt=result.data.totDebitAmt;
				}
				else{
					$scope.totDebitAmt=0;
				}
				
				if(result.data.totCreditAmt!=null){
					$scope.totCreditAmt=result.data.totCreditAmt;
				}
				else{
					$scope.totCreditAmt=0;
				}				
				$('button').removeAttr("disabled");
				$(".loadSpinner").hide();				
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
	
	$scope.backBtnClick = function(){
		$('.mainWrapper').show();
		$("#accDetailsTab").hide();
	};
	
	$scope.makePayment = function(){
		if($scope.payAmt==undefined || $scope.payAmt==null || $scope.particulars==undefined || $scope.particulars==null){
			alert('Fields cannot be empty');
			throw 'Fields cannot be empty';
		}
		
		if($scope.payAmt<=0){
			alert("Amount must be greater than 0");
			throw "Amount must be greater than 0";
		}
		
		if($scope.acctype=='inward'){
			$scope.debCred='debit';
		}
		else{
			$scope.debCred='credit';
		}
		var dt=new Date();
		var tmpObj={
			"id":$scope.accid,
			"acctype":$scope.acctype,
			"debCred":$scope.debCred,
			"payAmt":$scope.payAmt,
			"particulars":$scope.particulars,
			"accdate":dt.getTime(),
			"accmonth":dt.getMonth(),
			"accyear":dt.getFullYear(),
		};
		$http({
			method: 'POST',
			url: 'php/master.php?action=remainingPay',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data: tmpObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){	
				$('button').removeAttr("disabled");
				$("#balancePayModal").modal('hide');
				$route.reload();
				$(".loadSpinner").hide();				
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
});