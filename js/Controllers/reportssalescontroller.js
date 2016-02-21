greenorganics.controller("ReportsSalesController", function($scope, $http, $route){
	$('.loadSpinner').hide();
	$('.contentWrapper').hide();
	
	$scope.fromtoSaleOrdersMonthlyReports = function(){
		if($("#fromDate").val()!="" && $("#fromDate").val()!=null && $("#fromDate").val()!=undefined && $("#toDate").val()!="" && $("#toDate").val()!=null && $("#toDate").val()!=undefined){
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var frmdt=new Date(parseInt($("#fromDate").val().split('/')[0])+'/01/'+$("#fromDate").val().split('/')[1]);
			
			if(parseInt($("#fromDate").val().split('/')[0])==2){			
				if(parseInt($("#toDate").val().split('/')[1])%4==0){
					//Leap Year
					var todt=new Date(parseInt($("#toDate").val().split('/')[0])+'/29/'+$("#toDate").val().split('/')[1]);
				}
				else{
					var todt=new Date(parseInt($("#toDate").val().split('/')[0])+'/28/'+$("#toDate").val().split('/')[1]);
				}
			}
			else if(parseInt($("#fromDate").val().split('/')[0])==1 || parseInt($("#fromDate").val().split('/')[0])==3 || parseInt($("#fromDate").val().split('/')[0])==5 || parseInt($("#fromDate").val().split('/')[0])==7 || parseInt($("#fromDate").val().split('/')[0])==8 || parseInt($("#fromDate").val().split('/')[0])==10 || parseInt($("#fromDate").val().split('/')[0])==12){
				var todt=new Date(parseInt($("#toDate").val().split('/')[0])+'/31/'+$("#toDate").val().split('/')[1]);
			}
			else{
				var todt=new Date(parseInt($("#toDate").val().split('/')[0])+'/30/'+$("#toDate").val().split('/')[1]);
			}
			//console.log(frmdt.getTime() + " -*- "+ todt.getTime());
			var dateObj={
				"frmMnt":parseInt($("#fromDate").val().split('/')[0])-1,
				"frmYr":$("#fromDate").val().split('/')[1],
				"toMnt":parseInt($("#toDate").val().split('/')[0])-1,
				"toYr":$("#toDate").val().split('/')[1],
				"frmDt":frmdt.getTime(),
				"toDt":todt.getTime()
			}
			$http({
				method: 'POST',
				url: 'php/reports_Sales.php?action=fromtoSaleOrdersMonthlyReports',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					//console.log(result.data.fromtoMonthlyReport);
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