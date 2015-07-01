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