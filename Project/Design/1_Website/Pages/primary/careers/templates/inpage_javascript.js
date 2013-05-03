$(document).ready(function() {
	Cufon.replace('h1', { fontFamily: 'HoeflerTitlingRoman' });	
	Cufon.replace('h2', { fontFamily: 'Arvil Sans' });	
	
	$('input[type="file"]').change(function(){
		var filename = $(this).val();
		$('.fileName').empty().append(filename);
	});
	
	//SEND APPLICATION
	$('.applicationForm').submit(function(e){
		e.preventDefault();
		var contactClass = $('.applicationForm').attr('class');
		
		if(validateForm()) {
			$.php('/ajax/careers/submitApplicationAjax', $(this).serialize());
			php.error = function(xmlEr, typeEr, except) {}
			
			php.complete = function(XMLHttpRequest, textStatus) {
				resetForm(contactClass);
				alert('Thank you for your inquiry');
			}			
		}
	});
});
function resetForm(contactClass) {
	$('.'+contactClass).each(function(){
		this.reset();
	});
}
function validateForm() {
	
	return $('.applicationForm').validate({
		rules: {
			name:{
				required:true
			},
			mobile:{
				required:true,
				number:true
			},
			email:{
				required:true,
				email:true
			},
			message:{
				required:true
			}
		},
		messages: {
			name:{
				required:'Name field is required'
			},
			mobile:{
				required:'Mobile number is required',
				number:'Only integer are accepted'
			},
			email:{
				required:'Email address is required',
				email:'Please enter a valid email address'
			},
			message:{
				required:'Message field required'
			} 
		}
	}).form();
}
