$(document).ready(function(){
	Cufon.replace('.HoeflerTitlingRoman,#footer ul li span a, h1.pageHeading', { fontFamily: 'HoeflerTitlingRoman' });
	Cufon.replace('.ArvilSans,#primary_nav li span a', { fontFamily: 'Arvil Sans' });
	
	window.setTimeout(function(){
		stickyFooter();
	}, 500);
	
	$(this).resize(function(){
		stickyFooter();
	});	
	
});

function stickyFooter()
{
	var container = $('#wrapper > div[id*="_container"]');
	var contentWrapper = $('#wrapper div[id*="_content_wrapper"]');
	var windowHeight = $(window).height();
	var footerHeight = $('footer').height();
	var headerHeight = $('header').height();
	var containerHeight = contentWrapper.height();
	
	$('footer').css({'position':'relative'});
	var totalPageHeight = footerHeight + headerHeight + containerHeight ;
	if(totalPageHeight < windowHeight){
		var adjustedContainerHeight = windowHeight - (headerHeight + footerHeight);
		container.css({'height':adjustedContainerHeight});
	}
}