$(window).load(function(){
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
	var bannerHeight = $('#wrapper .topInnerBanner');
	var contentWrapper = $('#wrapper div[id*="_content_wrapper"]');
	var windowHeight = $(window).outerHeight();
	var footerHeight = 27;
	var headerHeight = $('header').outerHeight();
	
	var containerHeight = contentWrapper.outerHeight() + bannerHeight.outerHeight();
	
	var totalPageHeight = footerHeight + headerHeight + containerHeight ;
	if(totalPageHeight < windowHeight){
		$('footer').css({'position':'relative'});
		var adjustedContainerHeight = windowHeight - (headerHeight + footerHeight);
		container.css({'height':adjustedContainerHeight});
	}
}