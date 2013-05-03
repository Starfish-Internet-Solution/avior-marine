$(document).ready(function() {
	Cufon.replace('.albumTitle', { fontFamily: 'HoeflerTitlingRoman' });			
	Cufon.replace('h2', { fontFamily: 'Arvil Sans' });	
	
	var topicDetailHeight = $('.topicDetailsWrap').outerHeight();
	var sideNavHeight = $('.topicListWrap').outerHeight();
	
	if(sideNavHeight < topicDetailHeight)
		$('.topicListWrap').css({'height':topicDetailHeight+3});
	else
		$('.topicListWrap').css({'height':sideNavHeight+3});
	   	
});
