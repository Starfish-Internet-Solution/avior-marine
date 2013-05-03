$(document).ready(function() {
	Cufon.replace('.albumTitle', { fontFamily: 'HoeflerTitlingRoman' });			
	Cufon.replace('h2', { fontFamily: 'Arvil Sans' });
	
	var totalWidthList = 0;
	$('#pagination ul li').each(function(){
		totalWidthList += $(this).outerWidth(true);
	});
	$('#pagination ul').css({'width':totalWidthList});
	
	$(".fancybox-button").fancybox({
		prevEffect		: 'elastic',
		nextEffect		: 'elastic',
		closeBtn		: true,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
});

