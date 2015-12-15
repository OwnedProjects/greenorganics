greenorganics.controller("NewOrderController", function($scope, $http, $route, $location){	
	$scope.showBatches=false;
	$scope.confirmBatch=false;
	$('.waitspinner').hide();
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
	
	
	$scope.addtoList = function(){
		//console.log('test');
	};
		
	$scope.$watch('billamt-discount', function() {
		$scope.netamt = parseFloat($scope.billamt) - parseFloat($scope.discount);		
	});
	
	$scope.placeOrder = function(){
		
		if($scope.orderNo==null || $scope.orderNo==undefined || $scope.orderNo=="" || $('#orderDate').val()==null || $('#orderDate').val()==undefined || $('#orderDate').val()=="" || $scope.clientnm==null || $scope.clientnm==undefined || $scope.clientnm=="" || $scope.destination==null || $scope.destination==undefined || $scope.destination=="" || $scope.quantity==null || $scope.quantity==undefined || $scope.quantity==""){
				alert("Empty Fields!!! Please fill all the fields.");
				throw "Empty Fields";
		}
		
		var orderdt=new Date();
		orderdt.setDate(parseInt($("#orderDate").val().split('/')[0]));
		orderdt.setMonth(parseInt($("#orderDate").val().split('/')[1])-1);
		orderdt.setYear(parseInt($("#orderDate").val().split('/')[2]));
		
		var dt= new Date();
		var orderObj = {
			"sale_date":orderdt.getTime(),
			"sale_month":orderdt.getMonth(),
			"sale_year":orderdt.getFullYear(),
			"order_no":$scope.orderNo,
			"order_date":orderdt.getTime(),					//Order Date and Sales Date can be different
			"client_id":$scope.clientid,
			"quantity":parseFloat($scope.quantity)
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
				//console.log(result.data.status);
			if(result.data.status==true){
				$('form').prepend('<strong class="text-success">Order Placed Successfully</strong>');
				setTimeout(function(){
					$route.reload();
				},1000);
			}
			else{
				alert('Error!!! Please Contact your System Administrator.');
			}
		});
	};
	
});

greenorganics.controller("OrderPaymentController", function($scope, $http, $route, $location){
	if(!localStorage.orderObj){
		$location.path('/new_order');
	}
	$scope.orderObj=JSON.parse(localStorage.orderObj);
	//console.log($scope.orderObj);
	$('.loadSpinner').hide();
	$scope.payAmt='';
	$scope.$watch('payAmt', function() {
		if(parseInt($scope.payAmt)<=parseInt($scope.orderObj.net_amount)){
			$scope.remPay=parseInt($scope.orderObj.net_amount)-parseInt($scope.payAmt);
		}
		else{
			$scope.remPay=0;
		}
	});
	
	$scope.makePayment = function(){
		if($scope.payAmt==undefined || $scope.particulars==undefined || $scope.payAmt=="" || $scope.particulars==""){
			alert('Fields cannot be Empty');
			throw 'Please check Amount';
		}
		
		if(parseFloat($scope.payAmt)>parseFloat($scope.orderObj.net_amount)){
			alert('Payment amount is more than Final amount');
			$scope.payAmt=0;
			throw 'Please check Amount';
		}
		
		if($scope.payAmt==0){
			$scope.orderObj.payFlag=true;
		}
		else{
			$scope.orderObj.payFlag=false;
		}
		
		$scope.orderObj.payAmount=$scope.payAmt;
		$scope.orderObj.pendingPayment=$scope.remPay;
		$scope.orderObj.payParticulars=$scope.particulars;
		
		//console.log($scope.orderObj);
		$http({
			method: 'POST',
			url: 'php/master.php?action=makeorderObj',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data:$scope.orderObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				localStorage.removeItem('orderObj');
				$location.path('/new_order');
			}
			else{
				alert('Service Error, Please contact your Administrator.');
				throw 'fail';
			}
		});
	};
});

greenorganics.controller("OrderCompletionController", function($scope, $http, $route, $location){
	$scope.orderDets=false;
	$('.waitspinner').hide();
	$scope.setOrderBatches=new Array();
	$scope.loadProductionBatches = function(){
		$('.loadSpinner').show();
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
				$('.loadSpinner').hide();
				$scope.batchData=result.data.Production;
			}
			else{
				alert('Sorry, No Batches found. Please create a batch first.');
				$location.path('add_production_batch');
			}
		});
	};
	$scope.loadProductionBatches();
	
	$scope.searchOrderDetails = function(){
		$(".loadData").show();
		$(".noData").hide();
		$(".fullData").hide();
		$http({
				method: 'POST',
				url: 'php/master.php?action=allOrderNumbers',
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).
			error(function(data, status, headers, config) {
				alert('Service Error');
			}).
			then(function(result){
				if(result.data.status==true){
					$(".loadData").hide();
					$(".noData").hide();
					$(".fullData").show();
					$scope.orderData = result.data.orderObj;
				}
				else{
					$(".loadData").hide();
					$(".noData").show();
					$(".fullData").hide();
				}
		});
	};
	
	$scope.setOrderDetails = function(order_no, sales_id, order_date, quantity, client_name){
		$scope.orderDetails={
			"order_no": order_no,
			"sales_id": sales_id,
			"order_date": order_date, 
			"quantity": quantity,
			"client_name": client_name
		};
		$scope.orderDets=true;
		$scope.orderNo=order_no;
		$('#OrderModal').modal('hide');
	};
	
	
	$scope.addlorry = function(){
		$('.waitspinner').show();
		var tmpString=$scope.lorrystate+ " "+$("#lorrystatecode").val()+"/"+ $scope.lorrycode+" "+$('#popuplorryno').val();		
		var lorryObj={
			"lorry":tmpString.toUpperCase()
		};
		$http({
			method: 'POST',
			url: 'php/master.php?action=addlorry',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data: lorryObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$(".waitspinner").parent().append('<strong class="text-success">Lorry Added Successfully</strong>');
				setTimeout(function(){
					$(".waitspinner").parent().children("strong").remove();
					$('.waitspinner').hide();
					$route.reload();
				},2000);
			}
			else{
				alert('Error!!! Please contact your system Administrator.');
			}
		});
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
	
	$scope.addBatchToOrder = function(){
		if($scope.productionid == undefined){
			alert('Select a Batch to Add');
			throw 'Select a Batch to Add';
		}		
		$scope.showBatches=true;
		var tmpIndex=null;
		for(var i=0;i<$scope.batchData.length;i++){
			//console.log($scope.productionid + " --*-- " + $scope.batchData[i].production_id)
			if($('#productionid').val()==$scope.batchData[i].production_id){
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
		$scope.confirmBatch=true;
		var emptyFlag = false;
		var exceedprodval = false;
		$('.batches').find('input[type=text]').each(function(){
			if(this.value == "") {
				emptyFlag=true;
			} 
		});
		
		
		if(emptyFlag==true){
			// Check if any Batch Textbox is empty 
			$('.batches').append("<tr class='errorbox'><td colspan='3'><span class='text-danger'>Please fill all Batch Boxes first.</span></td></tr>");				
			setTimeout(function(){
					$('.batches .errorbox').remove();
					$scope.confirmBatch=false;
			},2500);
		}
		else{
			// Check if Entered Batch Volume > Product Remained 
			for(var i=0;i<$scope.setOrderBatches.length;i++){
				if(parseFloat($('.batchinput[data-batchno='+$scope.setOrderBatches[i].batch_no+']').val())>parseFloat($scope.setOrderBatches[i].prod_remained)){
					exceedprodval=true;
					break;
				}
			}
			if(exceedprodval==true){
				$('.batches').append("<tr class='errorbox'><td colspan='3'><span class='text-danger'>Quantity cannot exceed from production in Batch Available.</span></td></tr>");setTimeout(function(){
					$('.batches .errorbox').remove();
					$scope.confirmBatch=false;
				},2500);
			}
			else{
				// Check for Total Selected Batches volume > Quantity mentioned
				if($scope.orderDetails==undefined || $scope.orderDetails==null){
					$('.batches').append("<tr class='errorbox'><td colspan='3'><span class='text-danger'>Order is not Selected.</span></td></tr>");
					setTimeout(function(){
						$('.batches .errorbox').remove();
						$scope.confirmBatch=false;
					},2500);
				}
				else{
					var tmpCalc=0;
					for(var i=0;i<$scope.setOrderBatches.length;i++){
						tmpCalc=tmpCalc+parseFloat($('.batchinput[data-batchno='+$scope.setOrderBatches[i].batch_no+']').val());
					}
					if(tmpCalc>parseFloat($scope.orderDetails.quantity) || tmpCalc<parseFloat($scope.orderDetails.quantity))
					{
						$('.batches').append("<tr class='errorbox'><td colspan='3'><span class='text-danger'>Batch Quantity is More/Less than Mentioned Quantity.</span></td></tr>");
						setTimeout(function(){
							$('.batches .errorbox').remove();
							$scope.confirmBatch=false;
						},2500);
					}
					else{
						$scope.newEnteredBatchArray = new Array();
						$('.batches').find('input[type=text]').each(function(){
							var tmpArr={
								"batchno":$(this).attr('data-batchno'),
								"volume":parseFloat($(this).val()),
								"volume_remained":parseFloat($(this).attr('data-prod_remained'))-(parseFloat($(this).val()))
							};
							$scope.newEnteredBatchArray.push(tmpArr); 
						});
						$scope.confirmBatch=true;
						//console.log($scope.newEnteredBatchArray);
					}
				}
			}
		}
	};
	
	$scope.removeBatches = function(batch_no, prod_produced, prod_remained, production_id){
		//console.log(batch_no + " -*- " + prod_produced + " -*- " + prod_remained + " -*- " + production_id);
		var tmpIndex;
		for(var i=0;i<$scope.setOrderBatches.length; i++){
			if($scope.setOrderBatches[i].batch_no==batch_no){
				tmpIndex=i;
				break;
			}
		}
		
		$scope.setOrderBatches.splice(tmpIndex,1);
		tmpIndex=null;
		var tmpObj={
			"production_id": production_id,
			"batch_no":batch_no,
			"prod_produced": prod_produced,
			"prod_remained": prod_remained 
		};
		$scope.batchData.push(tmpObj);
		$scope.confirmBatch=false;
		tmpObj=null;
	};
	
	$scope.completeOrder = function(){
		if($scope.orderNo==undefined || $scope.orderNo==null || $scope.orderNo=='' || $scope.lorryno==undefined || $scope.lorryno==null || $scope.lorryno=='' || $('#orderDate').val()==undefined || $('#orderDate').val()==null || $('#orderDate').val()=="" || $scope.dcno==undefined || $scope.dcno==null || $scope.dcno=='' || $('#dispatchDate').val()==undefined || $('#dispatchDate').val()==null || $('#dispatchDate').val()=="")
		{
			alert('All fields are compulsary...');
			throw 'All fields are compulsary...';
		}
		
		var orderdt=new Date();
		orderdt.setDate(parseInt($("#orderDate").val().split('/')[0]));
		orderdt.setMonth(parseInt($("#orderDate").val().split('/')[1])-1);
		orderdt.setYear(parseInt($("#orderDate").val().split('/')[2]));
		
		var dispatchdt=new Date();
		dispatchdt.setDate(parseInt($("#dispatchDate").val().split('/')[0]));
		dispatchdt.setMonth(parseInt($("#dispatchDate").val().split('/')[1])-1);
		dispatchdt.setYear(parseInt($("#dispatchDate").val().split('/')[2]));
		
		var tmpObj={
			"sales_id":$scope.orderDetails.sales_id,
			"lorry_id":$scope.lorryid,
			"dcno":$scope.dcno,
			"dispatch_date": dispatchdt.getTime(),
			"order_comp_time": orderdt.getTime(),
			"order_comp_month": parseInt(orderdt.getMonth())+1,
			"order_comp_year": orderdt.getFullYear(),
			"batches_obj":$scope.newEnteredBatchArray
		};
		
		$http({
			method: 'POST',
			url: 'php/master.php?action=completeOrder',
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			data: tmpObj
		}).
		error(function(data, status, headers, config) {
			alert('Service Error');
		}).
		then(function(result){
			if(result.data.status==true){
				$('.messageDisp').prepend('<strong class="text-success">Order completed Successfully</strong>');
				setTimeout(function(){
					$route.reload();
				},1000);
			}
			else{
				$('.messageDisp').prepend('<strong class="text-danger">Order completion Failed</strong>');
				setTimeout(function(){
					$route.reload();
				},1000);
			}
		});
	};
});