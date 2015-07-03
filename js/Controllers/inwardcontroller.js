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

greenorganics.controller("InwardProductListController", function($scope, $http, $route){
	$scope.initfunction = function(){
		$(".loadData").show();
		$(".noData").hide();
		$(".fullData").hide();
		$http({
			method: 'POST',
			url: 'php/inwardmaster.php?action=allproductdetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$scope.ProductData=result.data.Products;
				$(".loadData").hide();
				$(".noData").hide();
				$(".fullData").show();				
			}
			else{
				$(".loadData").hide();
				$(".noData").show();
				$(".fullData").hide();
			}			
		});
	};
	$scope.initfunction();
	
	$scope.setProductDetails = function(prod_id, prod_name){
		$scope.prodid=prod_id;
		$scope.prodname=prod_name;
	};
	
	$scope.saveEdittedProductDetails = function(){
		var prodObj = {
			"prodid":$scope.prodid,
			"prodnm":$scope.prodname
		};
		$http({
			method: 'POST',
			url: 'php/inwardmaster.php?action=saveEdittedProductDetails',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:prodObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.modal-body').append("<span class='text-success'><strong>Product Updated Successfully.</strong></span>");
				setTimeout(function(){
					$('.modal-body span').remove();
					$route.reload();
				},2500);
			}
			else{
				$('.modal-body').append("<span class='text-danger'><strong>Error!!! Please contact system Administrator.</strong></span>");
				setTimeout(function(){
					$('.modal-body span').remove();					
				},2500);
			}			
		});
	};
	
	$scope.deleteproduct = function(){
		var prodObj = {
			"prodid":$scope.prodid
		};
		$http({
			method: 'POST',
			url: 'php/inwardmaster.php?action=deleteproduct',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:prodObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.modal-footer').append("<br/><span class='text-success'><strong>Product Deleted Successfully.</strong></span>");
				setTimeout(function(){
					$('.modal-footer span').remove();
					$('.modal').modal('hide');
					$route.reload();
				},1500);
			}
			else{
				$('.modal-footer').append("<br/><span class='text-danger'><strong>Error!!! Please contact system Administrator.</strong></span>");
				setTimeout(function(){
					$('.modal-footer span').remove();
					$('.modal').modal('hide');
				},3500);
			}
		});
	};
	
	$scope.reload = function(){
		$route.reload();
	};
});


greenorganics.controller("PurchaseProductListController", function($scope, $http, $route){
	$scope.searchLorryNumber = function(){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/lorrymaster.php?action=AllLorries',
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
				$scope.lorryData=result.data.lorries;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}
		});
	};
	
	$scope.searchSupplier = function(){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/suppliermaster.php?action=AllSuppliers',
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
				$scope.supplierData=result.data.Suppliers;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}
		});
	};
	
	$scope.selectLorry = function(lorry_id, lorry_no){
		$scope.lorryid=lorry_id;
		$scope.lorrynumber=lorry_no;
		$('#lorrydetails').modal('hide');
	};
	
	$scope.setSupplier = function(supplier_id, supplier_nm,prod_id, prod_name){
		$scope.supplierid=supplier_id;
		$scope.suppliernm=supplier_nm;
		$scope.prodid=prod_id;
		$scope.prodnm=prod_name;
		$('#supplierdetails').modal('hide');
	};
});