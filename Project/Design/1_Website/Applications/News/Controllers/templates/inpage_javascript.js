$(document).ready(function() {
	Cufon.replace('h2', { fontFamily: 'Arvil Sans' });	
	
	var topicDetailHeight = $('.newsContentWrap').outerHeight(true);
	var topicListHeight = $('.topicListWrap').outerHeight(true);
	
	if(topicListHeight > topicDetailHeight)
		$('.topicListWrap,.newsContentWrap').css({'height':topicListHeight});
	else
		$('.topicListWrap,.newsContentWrap').css({'height':topicDetailHeight});
});