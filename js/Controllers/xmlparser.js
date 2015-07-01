$(document).ready(function(){
	$.ajax({
    url: 'menu_structure.xml',
    dataType: 'xml',
		success: function(xml_node){
			// Extract relevant data from XML				
		},
		error: function(data){
			console.log('Error loading XML data');
		}
	}).done(function(xml_node){
		var desktopstr='';
		var mobilestr='';
		$(xml_node).find('menu').each(function(){
			if($(this).find('hasSubmenus').text()=='NO'){
				/* desktopstr is just for side menu */
				desktopstr=desktopstr+'<li class="list-group-item"><a href="'+$(this).find('link').text()+'" class="singleMenu"><i class="fa '+$(this).find('icon').text()+' text-primary"></i> '+$(this).find('name').text()+'</a></li>';
				
				/* mobilestr is for mobile menus */
				mobilestr=mobilestr+'<li><a href="'+$(this).find('link').text()+'" class="mobileMenuclick"><i class="fa '+$(this).find('icon').text()+' text-primary"></i> '+$(this).find('name').text()+'</a></li>';
			}
			else if($(this).find('hasSubmenus').text()=='YES'){
				var tmpdesktopstrstr='<li class="list-group-item"><i class="fa fa-caret-right carets"></i>  <span class="menu">'+$(this).children('name').text()+'</span> <ul class="list-group">';				
				var tmpdesktopstrstr1='';
				
				var tmpmobilestr='<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'+$(this).children('name').text()+' <span class="caret"></span></a><ul class="dropdown-menu" role="menu">';
				var tmpmobilestr1='';
				
				$(this).find('submenu').each(function(){
					tmpdesktopstrstr1=tmpdesktopstrstr1+ '<li class="list-group-item"><a href="'+$(this).find('link').text()+'"><i class="fa '+$(this).find('icon').text()+' text-primary"></i> '+ $(this).find('name').text()+'</a></li>';
					
					tmpmobilestr1=tmpmobilestr1+ '<li><a href="'+$(this).find('link').text()+'" class="mobileMenuclick"><i class="fa '+$(this).find('icon').text()+' text-primary"></i> '+ $(this).find('name').text()+'</a></li>';
				});
								
				tmpdesktopstrstr1=tmpdesktopstrstr1 + '</ul></li>';
				tmpmobilestr1=tmpmobilestr1 + '</ul></li>';
				
				tmpdesktopstrstr=tmpdesktopstrstr+tmpdesktopstrstr1;
				tmpmobilestr=tmpmobilestr+tmpmobilestr1;
				
				desktopstr=desktopstr+tmpdesktopstrstr;					
				mobilestr=mobilestr+tmpmobilestr;					
			}
		});
		$(".menuSpinner").remove();
		$('.menuWrapperParser').append(desktopstr);
		$('.navbarMenus').append(mobilestr);
		menuSlider.init();					
	});
});