greenorganics.controller("ReportsProductionController", function($scope, $http, $route){
	$('.loadSpinner').hide();
	$('.contentWrapper').hide();
	$scope.fromtoProdMonthlyReports = function(){
		if($("#fromDate").val()!="" && $("#fromDate").val()!=null && $("#fromDate").val()!=undefined && $("#toDate").val()!="" && $("#toDate").val()!=null && $("#toDate").val()!=undefined){
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"frmMnt":parseInt($("#fromDate").val().split('/')[0])-1,
				"frmYr":$("#fromDate").val().split('/')[1],
				"toMnt":parseInt($("#toDate").val().split('/')[0])-1,
				"toYr":$("#toDate").val().split('/')[1]
			}
			$http({
				method: 'POST',
				url: 'php/reports_Production.php?action=fromtoProdMonthlyReports',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.fromtoMonthlyReport);
					$scope.tableData=result.data.fromtoMonthlyReport;
					//$('.contentWrapper').text('Check Console');
					$('.contentWrapper').show();
					$(".loadSpinner").hide();
				}
				else{
					$(".loadSpinner").hide();
					$('.contentWrapper').hide();
					$('.buttonsWrapper').show();
					alert('No Data Found...');
				}			
			});
		}
		else{
			alert('Select a Date');
			$("#fromDate").focus();
		}
	};
	
	
	$scope.reload = function(){
		$route.reload();
	};
});