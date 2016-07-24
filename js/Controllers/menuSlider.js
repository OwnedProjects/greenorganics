$(document).ready(function(){
	//setTimeout(function(){
		//menuSlider.init();
		//console.log("menuinit");
	//},100);
});

var menuSlider = {};

menuSlider.init = function(){	
	$(".menu").click(function(){
		var flag=false;
		if($(this).parent().children(".carets").hasClass('fa-caret-down')){
			flag=true
		}
		
		$(".list-group .list-group").slideUp();
		$(".carets").removeClass('fa-caret-down');
		$(".carets").addClass('fa-caret-right');
		if(!flag){
			if($(this).parent().children(".carets").hasClass('fa-caret-right')){
				$(this).parent().children("ul.list-group").slideDown();
				$(this).parent().children(".carets").removeClass('fa-caret-right');
				$(this).parent().children(".carets").addClass('fa-caret-down');
			}else{
				$(this).parent().children("ul.list-group").slideUp();
				$(this).parent().children(".carets").removeClass('fa-caret-down');
				$(this).parent().children(".carets").addClass('fa-caret-right');
			}		
		}
		else{
			$(this).parent().children("ul.list-group").slideUp();
			$(this).parent().children(".carets").removeClass('fa-caret-down');
			$(this).parent().children(".carets").addClass('fa-caret-right');
		}
	});
	
	$("#hideMenu").click(function(){
		if($(this).hasClass("open")){
			$(this).removeClass("open");
			$(this).addClass("closed");
			$(this).children().removeClass("fa-angle-double-left");
			$(this).children().addClass("fa-angle-double-right");
			$('.menuWrapper').animate({
				width:'8%'
			},800, function(){
				$('.menuWrapper').fadeOut();
				$(".menuWrapper").next().removeClass("col-md-9");
				$(".menuWrapper").next().addClass("col-md-12");
			});
			$(this).animate({
				left:'0%'
			},1000);
		}
		else{
			$('.menuWrapper').fadeIn();
			$(this).addClass("open");
			$(this).removeClass("closed");
			$(this).children().addClass("fa-angle-double-left");
			$(this).children().removeClass("fa-angle-double-right");
			$(".menuWrapper").next().addClass("col-md-9");
			$(".menuWrapper").next().removeClass("col-md-12");
			$('.menuWrapper').animate({
				width:'25%'
			},800);
			$(this).animate({
				left:'23%'
			},1500);
		}
	});
	
	$(".singleMenu").click(function(){
		$(".list-group .list-group").slideUp();
		$(".carets").removeClass('fa-caret-down');
		$(".carets").addClass('fa-caret-right');
	});
	
	$('.mobileMenuclick').on('click', function(){
		$(".btn-navbar").click(); //bootstrap 2.x
		$(".navbar-toggle").click() //bootstrap 3.x by Richard
	});
};