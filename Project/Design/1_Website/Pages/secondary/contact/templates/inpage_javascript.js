$(document).ready(function() {
	Cufon.replace('h2', { fontFamily: 'Arvil Sans' });
	
	$(".contactForm").submit(function(e) {
		e.preventDefault();
		var contactClass = $('.contactForm').attr('class');
		
		if(validateForm()) {
			$.php('/ajax/contact/submitApplicationAjax', $(this).serialize());
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
	
	return $('.contactForm').validate({
		rules: {
			name:{
				required:true
			},
			company:{
				required:true,
			},
			telephone:{
				required:true,
			},
			email:{
				required:true,
				email:true
			},
			inquiry: {
				required:true
			}
		},
		messages: {
			name:{
				required:'Name field is required'
			},
			company:{
				required:'Company number is required',
			},
			telephone:{
				required:'Telephone number is required'
			},
			email:{
				required:'Email address is required',
				email:'Please enter a valid email address'
			},
			inquiry: {
				required:'Inquiry field is required'
			}
		}
	}).form();
}