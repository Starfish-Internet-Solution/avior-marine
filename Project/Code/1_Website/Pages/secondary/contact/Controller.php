<?php
require_once 'Project/Code/ApplicationsFramework/FrontController/applicationsFrontController.php';
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';

require_once 'Project/Code/1_Website/Applications/User_Account/Modules/Mail/email.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core
{
	public function	submitApplicationAjaxAction() {
		$name = $_REQUEST['name'];
		$company = $_REQUEST['company'];
		$telephone = $_REQUEST['telephone'];
		$email = $_REQUEST['email'];
		//$address = $_REQUEST['address'];
		$typeInquiry = $_REQUEST['typeInquiry'];
		$inquiry = $_REQUEST['inquiry'];
		//info@aviormarine.com
		$sendTo = 'joseph.reyes@starfi.sh';
		
		if($typeInquiry == 'Appication') 
			$sendTo = 'jobs@aviormarine.com';
		
		$body = "
					Name: $name
					
					Company: $company
		
					Contact Number: $telephone
					
					Email Address: $email
					
					Address: $address
					
					Type of inquiry: $typeInquiry
					
					Inquiry:$inquiry
				";
		
		//mail('jephjeph02@gmail.com', 'New inquiry received', $body, 'New inquiry received');
		mail($sendTo, 'New inquiry received', $body, 'New inquiry received');
		jQuery::getResponse();		
	}
}
?>