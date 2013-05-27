$(document).ready(function() {
	Cufon.replace('h1', { fontFamily: 'HoeflerTitlingRoman' });	
	Cufon.replace('.topPointer', { fontFamily: 'Arvil Sans' });
	   	
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
		
//		$.ajax('/ajax/careers/sendmail', {
//			full_name:full_name,
//			rank:rank, 
//			date_of_birth:date_of_birth,
//			phone:phone,
//			email:email,
//			vessel:vessel,
//			comment:comment
//		});
	});
	
	
});
