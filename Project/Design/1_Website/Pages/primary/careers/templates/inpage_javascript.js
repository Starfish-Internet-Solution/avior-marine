$(document).ready(function() {
	Cufon.replace('h1', { fontFamily: 'HoeflerTitlingRoman' });	
	Cufon.replace('.topPointer', { fontFamily: 'Arvil Sans' });
	
	//cloning of service container div
	$('#add_service').click(function(){
		$('#clone').children().clone().appendTo('#clone_container');
	
		service_count = parseInt($('input[name="service_count"]').val()) + 1;
		$('input[name="service_count"]').val(service_count);
	});
	
	//ajax sending email
	$("input[name='mail']").click(function(e){
		e.preventDefault();
		
		full_name	 	 = $('input[name="full_name"]').val();
		rank			 = $('input[name="rank"]').val();
		date_of_birth    = $('input[name="date_of_birth"]').val(); 
		phone 			 = $('input[name="phone"]').val();
		email 			 = $('input[name="email"]').val();
		vessel_type 			 = $('input[name="vessel_type"]').val();
		comment 		 = $('textarea[name="comment"]').val();

		$.ajax('/ajax/careers/sendmail?full_name='+full_name+'&rank='+rank+'&date_of_birth='+date_of_birth+'&phone='+phone+'&email='+email+'&vessel_type='+vessel_type+'&comment='+comment+'', {});
	});
	
	//finishing application
	$("input[name='finish_apply']").live("click", (function(e){
		e.preventDefault();
		
		$.php('/ajax/careers/saveAjaxSession', $('#fourth_phase').serialize());
	
		php.complete = function(){
			$('.confirmation').fadeIn();
		};
		
	}));
	
	$('#cancel').click(function(){
		$('.confirmation').fadeOut();
	});
	
	$('#confirm').click(function(){
		$.php('/ajax/careers/insertApplication', {});
	});
	
	
});
