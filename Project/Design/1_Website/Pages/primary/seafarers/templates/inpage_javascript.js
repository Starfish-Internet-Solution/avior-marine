$(document).ready(function() {
	Cufon.replace('.albumTitle', { fontFamily: 'HoeflerTitlingRoman' });			
	Cufon.replace('h2', { fontFamily: 'Arvil Sans' });	
	
	var topicDetailHeight = $('.topicDetailsWrap').outerHeight(true);
	$('.topicListWrap').css({'height':topicDetailHeight + 3})
});
