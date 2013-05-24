$(window).load(function(){

		stickyFooter();
	
	$(this).resize(function(){
		stickyFooter();
	});	
	
});	
$(document).ready(function(){
	Cufon.replace('.HoeflerTitlingRoman, h1.pageHeading', { fontFamily: 'HoeflerTitlingRoman' });
	Cufon.replace('.ArvilSans', { fontFamily: 'Arvil Sans' });
	
});
function stickyFooter()
{
	var container = $('#wrapper > div[id*="_container"]');
	var bannerHeight = $('#wrapper .topInnerBanner');
	var contentWrapper = $('#wrapper div[id*="_content_wrapper"]');
	var windowHeight = $(window).outerHeight();
	var footerHeight = 27;
	var headerHeight = $('header').outerHeight();
	
	var containerHeight = 0;
	
	if((bannerHeight.outerHeight()) != undefined){
		containerHeight = contentWrapper.outerHeight() + bannerHeight.outerHeight();
	}
	else{
		containerHeight = contentWrapper.outerHeight();
	}
	
	var totalPageHeight = footerHeight + headerHeight + containerHeight ;
//	alert(totalPageHeight);
//	alert(windowHeight);
//	if(totalPageHeight < windowHeight){
		$('footer').css({'position':'relative'});
		var adjustedContainerHeight = totalPageHeight - (headerHeight + footerHeight);
		container.css({'height':adjustedContainerHeight});
//	}
//	else if(totalPageHeight > windowHeight){
//		$('footer').css({'position':'relative'});
//		var adjustedContainerHeight = totalPageHeight - (headerHeight + footerHeight);
//		container.css({'height':adjustedContainerHeight});
//	}
}