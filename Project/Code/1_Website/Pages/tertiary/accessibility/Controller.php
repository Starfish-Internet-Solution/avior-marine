<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core 
{
	public function postDispatch()
	{
		require_once('Project/Code/1_Website/Main_Layout/mainController.php');
		$mainController = new mainController();
		$mainController->getMainLayout();

		$accesskeys = hyperlink::getInstance()->getAccessKeys();
		$view = new view();
		$view->getAccessKeysPartTwo($accesskeys);
		
	}
}
?>