greenorganics.controller("ReportsPurchaseController", function($scope, $http, $route){
	$('.loadSpinner').hide();
	$('.contentWrapper').hide();
	$scope.monthlyReports = function(){
		if($("#purchaseDate").val()=="" || $("#purchaseDate").val()==null || $("#purchaseDate").val()==undefined){
			alert('Select a Date');
			$("#purchaseDate").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"mnth":parseInt($("#purchaseDate").val().split('/')[0])-1,
				"year":$("#purchaseDate").val().split('/')[1]
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsMonthlyPurchases',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.monthlyReport);
					$scope.tableData=result.data.monthlyReport;
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
	};
	
	$scope.monthlySupplierReports = function(){
		if($scope.suppliernm=="" || $scope.suppliernm==null || $scope.suppliernm==undefined){
			alert('Select a Supplier');
			throw 'Supplier Absent';
		}
		
		if($("#fromDateSupplier").val()=="" || $("#fromDateSupplier").val()==null || $("#fromDateSupplier").val()==undefined){
			alert('Select a Date');
			$("#fromDateSupplier").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"mnth":parseInt($("#fromDateSupplier").val().split('/')[0])-1,
				"year":$("#fromDateSupplier").val().split('/')[1],
				"supplierid": $scope.supplierid
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsMonthlyPurchasesWithSuppliers',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.monthlyReport);
					$scope.tableData=result.data.monthlyReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	$scope.monthlyProductReports = function(){
		if($scope.productnm=="" || $scope.productnm==null || $scope.productnm==undefined){
			alert('Select a Product');
			throw 'Product Absent';
		}
		
		if($("#fromDateProduct").val()=="" || $("#fromDateProduct").val()==null || $("#fromDateProduct").val()==undefined){
			alert('Select a Date');
			$("#fromDateProduct").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"mnth":parseInt($("#fromDateProduct").val().split('/')[0])-1,
				"year":$("#fromDateProduct").val().split('/')[1],
				"productid": $scope.productid
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsMonthlyPurchasesWithProducts',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.monthlyReport);
					$scope.tableData=result.data.monthlyReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	$scope.yearlyReports = function(){
		if($("#purchaseDate").val()=="" || $("#purchaseDate").val()==null || $("#purchaseDate").val()==undefined){
			alert('Select a Date');
			$("#purchaseDate").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"year":$("#purchaseDate").val().split('/')[1]
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsYearlyPurchases',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.yearlyReport);
					$scope.tableData=result.data.yearlyReport;
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
	};
	
	$scope.yearlySupplierReports = function(){
		if($scope.suppliernm=="" || $scope.suppliernm==null || $scope.suppliernm==undefined){
			alert('Select a Supplier');
			throw 'Supplier Absent';
		}
		
		if($("#fromDateSupplier").val()=="" || $("#fromDateSupplier").val()==null || $("#fromDateSupplier").val()==undefined){
			alert('Select a Date');
			$("#fromDateSupplier").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"year":$("#fromDateSupplier").val().split('/')[1],
				"supplierid": $scope.supplierid
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsYearlyPurchasesWithSuppliers',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.yearlyReport);
					$scope.tableData=result.data.yearlyReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	$scope.yearlyProductReports = function(){
		if($scope.productnm=="" || $scope.productnm==null || $scope.productnm==undefined){
			alert('Select a Product');
			throw 'Product Absent';
		}
		
		if($("#fromDateProduct").val()=="" || $("#fromDateProduct").val()==null || $("#fromDateProduct").val()==undefined){
			alert('Select a Date');
			$("#fromDateProduct").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"year":$("#fromDateProduct").val().split('/')[1],
				"productid": $scope.productid
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsYearlyPurchasesWithProduct',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.yearlyReport);
					$scope.tableData=result.data.yearlyReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	$scope.fromtoMonthlyReports = function(){
		$('.contentWrapper').hide();
		if($("#fromDate").val()=="" || $("#fromDate").val()==null || $("#fromDate").val()==undefined || $("#toDate").val()=="" || $("#toDate").val()==null || $("#toDate").val()==undefined){
			alert('Select a Date');
			$("#fromDate").focus();
		}
		else{
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
				url: 'php/reports.php?action=fromToMonthlyPurchases',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$scope.tableData=result.data.fromtoMonthlyReport;
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
	};
	
	$scope.fromtoMonthlyReportsWithSuppliers = function(){
		if($scope.suppliernm=="" || $scope.suppliernm==null || $scope.suppliernm==undefined){
			alert('Select a Supplier');
			throw 'Supplier Absent';
		}
		$('.contentWrapper').hide();
		if($("#fromSupplierDate").val()=="" || $("#fromSupplierDate").val()==null || $("#fromSupplierDate").val()==undefined || $("#toSupplierDate").val()=="" || $("#toSupplierDate").val()==null || $("#toSupplierDate").val()==undefined){
			alert('Select a Date');
			$("#fromSupplierDate").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"frmMnt":parseInt($("#fromSupplierDate").val().split('/')[0])-1,
				"frmYr":$("#fromSupplierDate").val().split('/')[1],
				"toMnt":parseInt($("#toSupplierDate").val().split('/')[0])-1,
				"toYr":$("#toSupplierDate").val().split('/')[1],
				"supplierid": $scope.supplierid
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=fromToMonthlyPurchasesWithSuppliers',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$scope.tableData=result.data.fromtoMonthlyReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	$scope.fromtoMonthlyReportsWithProducts = function(){
		if($scope.productnm=="" || $scope.productnm==null || $scope.productnm==undefined){
			alert('Select a Product');
			throw 'Product Absent';
		}
		$('.contentWrapper').hide();
		if($("#fromProductDate").val()=="" || $("#fromProductDate").val()==null || $("#fromProductDate").val()==undefined || $("#toProductDate").val()=="" || $("#toProductDate").val()==null || $("#toProductDate").val()==undefined){
			alert('Select a Date');
			$("#fromProductDate").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"frmMnt":parseInt($("#fromProductDate").val().split('/')[0])-1,
				"frmYr":$("#fromProductDate").val().split('/')[1],
				"toMnt":parseInt($("#toProductDate").val().split('/')[0])-1,
				"toYr":$("#toProductDate").val().split('/')[1],
				"productid": $scope.productid
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=fromToMonthlyPurchasesWithProducts',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$scope.tableData=result.data.fromtoMonthlyReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	$scope.reload = function(){
		$route.reload();
	};
	
	$scope.searchSupplier = function(){
		$('#supplierModal').modal('show');
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/master.php?action=AllSuppliersNonBags',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.fullData').show();
				$('.noData').hide();
				$('.loadData').hide();
				$scope.supplierData = result.data.Suppliers;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}
		});
	};
	
	$scope.searchProduct = function(){
		$('#productModal').modal('show');
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/reports.php?action=AllProductNonBags',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.fullData').show();
				$('.noData').hide();
				$('.loadData').hide();
				$scope.productData = result.data.Products;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}
		});
	};
	
	$scope.setSupplierDetails = function(id, nm){
		$scope.supplierid = id;
		$scope.suppliernm = nm;
		$('#supplierModal').modal('hide');
	};
	
	$scope.setProductsDetails = function(id, nm){
		$scope.productid = id;
		$scope.productnm = nm;
		$('#productModal').modal('hide');
	};
	
	$scope.supplierReports = function(){
		$('.contentWrapper').hide();
		if($scope.suppliernm=="" || $scope.suppliernm==null || $scope.suppliernm==undefined){
			alert('Select a Supplier');
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			$http({
				method: 'POST',
				url: 'php/reports.php?action=purchaseSupplierReports',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: $scope.supplierid
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$scope.tableData=result.data.purchaseSupplierReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	$scope.productReports = function(){
		$('.contentWrapper').hide();
		if($scope.productnm=="" || $scope.productnm==null || $scope.productnm==undefined){
			alert('Select a Product');
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			$http({
				method: 'POST',
				url: 'php/reports.php?action=purchaseProductReports',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: $scope.productid
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$scope.tableData=result.data.purchaseProductReport;
					var weightCnt=0;
					for(var i=0;i<$scope.tableData.length;i++){
						weightCnt=weightCnt+parseFloat($scope.tableData[i].weight);
					}
					$('.contentWrapper table').prepend("<caption><strong class='text-success'>Total Weight: <span>"+weightCnt+" M.T</span></strong></caption>");
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
	};
	
	/* Bags Reports Methods */
	$scope.monthlyBagsReports = function(){
		if($("#purchaseDate").val()=="" || $("#purchaseDate").val()==null || $("#purchaseDate").val()==undefined){
			alert('Select a Date');
			$("#purchaseDate").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"mnth":parseInt($("#purchaseDate").val().split('/')[0])-1,
				"year":$("#purchaseDate").val().split('/')[1]
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsBagsMonthlyPurchases',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.monthlyReport);
					$scope.tableData=result.data.monthlyReport;
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
	};
	
	$scope.yearlyBagsReports = function(){
		if($("#purchaseDate").val()=="" || $("#purchaseDate").val()==null || $("#purchaseDate").val()==undefined){
			alert('Select a Date');
			$("#purchaseDate").focus();
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			var dateObj={
				"year":$("#purchaseDate").val().split('/')[1]
			}
			$http({
				method: 'POST',
				url: 'php/reports.php?action=reportsBagsYearlyPurchases',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					console.log(result.data.yearlyReport);
					$scope.tableData=result.data.yearlyReport;
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
	};
	
	$scope.fromtoBagMonthlyReports = function(){
		$('.contentWrapper').hide();
		if($("#fromDate").val()=="" || $("#fromDate").val()==null || $("#fromDate").val()==undefined || $("#toDate").val()=="" || $("#toDate").val()==null || $("#toDate").val()==undefined){
			alert('Select a Date');
			$("#fromDate").focus();
		}
		else{
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
				url: 'php/reports.php?action=fromToBagsMonthlyPurchases',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: dateObj
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$scope.tableData=result.data.fromtoMonthlyReport;
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
	};
	
	$scope.searchBagSupplier = function(){
		$('#supplierModal').modal('show');
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/master.php?action=AllSuppliersOnlyBags',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.fullData').show();
				$('.noData').hide();
				$('.loadData').hide();
				$scope.supplierData = result.data.Suppliers;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}
		});
	};
	
	$scope.supplierBagsReports = function(){
		$('.contentWrapper').hide();
		if($scope.suppliernm=="" || $scope.suppliernm==null || $scope.suppliernm==undefined){
			alert('Select a Supplier');
		}
		else{
			$('.buttonsWrapper').hide();
			$('.loadSpinner').show();
			$http({
				method: 'POST',
				url: 'php/reports.php?action=purchaseBagsSupplierReports',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: $scope.supplierid
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$scope.tableData=result.data.purchaseSupplierReport;
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
	};
});