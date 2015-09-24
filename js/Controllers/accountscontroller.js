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

greenorganics.controller("OtherExpensesController", function($scope, $http, $route){
	$scope.tmpDisable=true;
	$(".loadSpinner").show();
	$http({
			method: 'GET',
			url: 'php/master.php?action=otherExpenseNames',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){	
				$scope.expenseDetailObj=result.data.expenseObj;
				$scope.tmpDisable=false;
				$(".loadSpinner").hide();				
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
		
	$scope.makeExpensePayment = function(){
		$(".loadSpinner").show();
		if($scope.payAmt<=0){
			alert("Amount cannot be zero/less than zero");
			throw "Amount cannot be zero/less than zero"
		}
		var dt=new Date();
		var day=dt.setDate(parseInt($("#enterdate").val().split('/')[0]));
		var mnt=dt.setMonth(parseInt($("#enterdate").val().split('/')[1])-1);
		var Yr=dt.setYear(parseInt($("#enterdate").val().split('/')[2]));
		
		var tmpObj={
			"expTime":dt.getTime(),
			"empMnt":(parseInt($("#enterdate").val().split('/')[1])-1),
			"expYr":(parseInt($("#enterdate").val().split('/')[2])),
			"expenseDetails":$scope.expenseDetails,
			"payAmt":$scope.payAmt,
			"particulars":$scope.particulars,
		};
		$http({
			method: 'POST',
			url: 'php/master.php?action=otherExpensePayment',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:tmpObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){	
				//$scope.payDetailObj=result.data.expenseObj;
				$(".loadSpinner").hide();
				$route.reload();				
			}
			else{
				$(".loadSpinner").hide();
				alert('Error!!! Please contact system Administrator.');
			}			
		});
	};
});