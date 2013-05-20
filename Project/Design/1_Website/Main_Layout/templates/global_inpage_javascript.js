$(window).load(function(){

		stickyFooter();
	
	$(this).resize(function(){
		stickyFooter();
	});	
	
});	
$(document).ready(function(){
	Cufon.replace('.HoeflerTitlingRoman,#footer ul li span a, h1.pageHeading', { fontFamily: 'HoeflerTitlingRoman' });
	Cufon.replace('.ArvilSans,#primary_nav li span a', { fontFamily: 'Arvil Sans' });
	
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
	if(totalPageHeight < windowHeight){
		$('footer').css({'position':'relative'});
		var adjustedContainerHeight = windowHeight - (headerHeight + footerHeight);
		container.css({'height':adjustedContainerHeight});
	}
}