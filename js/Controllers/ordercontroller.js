greenorganics.controller("NewOrderController", function($scope, $http, $route){	
	$scope.showBatches=false;
	$scope.confirmBatch=false;
	$scope.setOrderBatches=new Array();
	
	$scope.loadProductionBatches = function(){
		$('.waitspinner').show();
		$scope.loadOrder=true;
		$http({
			method: 'POST',
			url: 'php/master.php?action=AllProductionBatches',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$scope.loadOrder=false;
				$('.waitspinner').hide();
				$scope.batchData=result.data.Production;
			}
			else{
				alert('Error!!! Please contact system Administrator');
			}
		});
	};
	$scope.loadProductionBatches();
	
	$scope.searchClientDetails = function(){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/master.php?action=fetchAllClients',
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
				$scope.clients=result.data.clients;
			}
			else{
				$('.fullData').hide();
				$('.noData').show();
				$('.loadData').hide();
			}
		});
	};
	
	$scope.setclientDetails = function(clntid, clntnm, clntcity){
		$scope.clientid=clntid;
		$scope.clientnm=clntnm;
		$scope.destination=clntcity;
		$('#setClientmodal').modal('hide');
	};
	
	$scope.setLorryDetails = function(lorryid, lorryno){
		$scope.lorryid=lorryid;
		$scope.lorryno=lorryno;
		$('#setLorrymodal').modal('hide');
	};
	
	$scope.searchLorryDetails = function(){
		$('.fullData').hide();
		$('.noData').hide();
		$('.loadData').show();
		$http({
			method: 'POST',
			url: 'php/master.php?action=AllLorries',
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
	
	$scope.addtoList = function(){
		console.log('test');
	};
	
	$scope.addBatchToOrder = function(){
		if($scope.productionid == undefined){
			alert('Select a Batch to Add');
			throw 'Select a Batch to Add';
		}		
		$scope.showBatches=true;
		var tmpIndex=null;
		for(var i=0;i<$scope.batchData.length;i++){
			//console.log($scope.productionid + " --*-- " + $scope.batchData[i].production_id)
			if($scope.productionid==$scope.batchData[i].production_id){
				tmpIndex=i;
				break;
			}
		}
		
		if(tmpIndex!=null){
			//setOrderBatches -- Order Batches Which create dynamically
			var tmpObj=$scope.batchData[tmpIndex];
			$scope.setOrderBatches.push(tmpObj);
			$scope.batchData.splice(tmpIndex,1);
			tmpObj=null;
		}
	};
	
	$scope.confirmBatches = function(){
		var emptyFlag = false;
		var exceedprodval = false;
		$('.batches').find('input[type=text]').each(function(){
			if(this.value == "") {
				emptyFlag=true;
			} 
		});
		
		
		if(emptyFlag==true){
			/* Check if any Batch Textbox is empty */
			$('.batches').append("<tr class='errorbox'><td colspan='3'><span class='text-danger'>Please fill all Batch Boxes first.</span></td></tr>");				
			setTimeout(function(){
					$('.batches .errorbox').remove();
			},1500);
		}
		else{
			/* Check if Entered Batch Volume > Product Remained */
			for(var i=0;i<$scope.setOrderBatches.length;i++){
				if(parseFloat($('.batchinput[data-batchno='+$scope.setOrderBatches[i].batch_no+']').val())>parseFloat($scope.setOrderBatches[i].prod_remained)/1000){
					exceedprodval=true;
					break;
				}
			}
			if(exceedprodval==true){
				$('.batches').append("<tr class='errorbox'><td colspan='3'><span class='text-danger'>Quantity cannot exceed from production in Batch Available.</span></td></tr>");setTimeout(function(){
					$('.batches .errorbox').remove();
				},1500);
			}
			else{
				/* Check for Total Selected Batches volume > Quantity mentioned  */
				var tmpCalc=0;
				for(var i=0;i<$scope.setOrderBatches.length;i++){
					tmpCalc=tmpCalc+parseFloat($('.batchinput[data-batchno='+$scope.setOrderBatches[i].batch_no+']').val());
				}
				if(tmpCalc>parseFloat($scope.quantity) || tmpCalc<parseFloat($scope.quantity))
				{
					$('.batches').append("<tr class='errorbox'><td colspan='3'><span class='text-danger'>Batch Quantity is More/Less than Mentioned Quantity.</span></td></tr>");
					setTimeout(function(){
						$('.batches .errorbox').remove();
					},1500);
				}
				else{
					$scope.newEnteredBatchArray = new Array();
					$('.batches').find('input[type=text]').each(function(){
						var tmpArr={
							"batchno":$(this).attr('data-batchno'),
							"volume":parseFloat($(this).val())*1000
						};
						$scope.newEnteredBatchArray.push(tmpArr); 
					});
					$scope.confirmBatch=true;
					console.log($scope.newEnteredBatchArray);
				}
			}
		}
	};
	
	$scope.placeOrder = function(){
		
		var orderdt=new Date();
		orderdt.setDate(parseInt($("#orderDate").val().split('/')[0]));
		orderdt.setMonth(parseInt($("#orderDate").val().split('/')[1])-1);
		orderdt.setYear(parseInt($("#orderDate").val().split('/')[2]));
		
		var dispdt=new Date();
		dispdt.setDate(parseInt($("#dispatchDate").val().split('/')[0]));
		dispdt.setMonth(parseInt($("#dispatchDate").val().split('/')[1])-1);
		dispdt.setYear(parseInt($("#dispatchDate").val().split('/')[2]));
		
		var billdt=new Date();
		billdt.setDate(parseInt($("#billDate").val().split('/')[0]));
		billdt.setMonth(parseInt($("#billDate").val().split('/')[1])-1);
		billdt.setYear(parseInt($("#billDate").val().split('/')[2]));
		
		var dt= new Date();
		var orderObj = {
			"sale_date":dt.getTime(),
			"sale_month":dt.getMonth(),
			"sale_year":dt.getFullYear(),
			"dc_no":$scope.dcno,
			"order_date":orderdt.getTime(),					//Order Date and Sales Date can be different
			"disp_date":dispdt.getTime(),
			"client_id":$scope.clientid,
			"lorry_id":$scope.lorryid,
			"quantity":parseFloat($scope.quantity)*1000,
			"billno":$scope.billno,
			"bill_date":billdt.getTime(),
			"bill_amount":$scope.billamt,
			"batches_obj":$scope.newEnteredBatchArray
		};
		
		$http({
			method: 'POST',
			url: 'php/master.php?action=NewOrder',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:orderObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
				console.log(result.data.status);
			if(result.data.status==true){
				$('form').prepend('<strong class="text-success">Order Placed Successfully</strong>');
				$route.reload();
			}
			else{
				alert('Error!!! Please Contact your System Administrator.');
			}
		});
	};
});