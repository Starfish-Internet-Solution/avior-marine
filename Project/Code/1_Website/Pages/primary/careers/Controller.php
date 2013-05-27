<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core 
{
	public function indexAction()
	{
		$model = new model();
		$view = new view();
		
		$XML = $model->loadDataSimpleXML('data');
		$view->_XMLObj = $XML;
		
		$view->_set('array_of_jobs', $model->getPositions());
		$view->_set('array_of_images', $model->getImages());
		
		$view->displayQuickApplyForm();
		$view->renderAll();
	}
	
	public function sendmailAction()
	{
		require_once 'Project/Code/1_Website/Applications/User_Account/Modules/mail/email.php';
		
		$subject 	= "New Inquiry";
		$from_email = $_GET['email'];
		$body 		= "
						Full Name {$_GET['full_name']} <br />
						Rank {$_GET['rank']} <br />
						Date of Birth {$_GET['date_of_birth']} <br />
						Phone {$_GET['phone']} <br />
						Email {$_GET['email']} <br />
						Vessel Type {$_GET['vessel_type']} 
						<br />
						<br />
						<br />
						
						Comment:<br />
						{$_GET['comment']}
		
					";
		
		email::send_email('', '', $from_email, '', $subject, $body);
		jQuery::getResponse();
	}
}
?>