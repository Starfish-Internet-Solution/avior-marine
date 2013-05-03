$(document).ready(function() {
	// Rotating Image
	rotateImage();
});

function rotateImage(){
	
	setInterval(function() {
		
      	var curPhoto = $('#slider .active');
		var nxtPhoto = curPhoto.next();
		
			if(nxtPhoto.length == 0)
				nxtPhoto = $('#slider li:first');
			
			
			curPhoto.removeClass("active").addClass("previous");
			nxtPhoto.css({opacity:0.0}).addClass("active").animate({opacity:1.0},1000,	function(){
				curPhoto.removeClass("previous");
			});
			
		}, 5000);
}