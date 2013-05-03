<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('mainModel.php');
require_once('mainView.php');

class mainController extends controllerSuperClass_Core
{
	
	public function getMainLayout()
	{
		require_once 'Project/Code/System/Settings/settings.php';
		$analytics = new settings();
		$analytics->selectGoogleAnalytics();
		
		$this->getHeader();
		$this->getFooter();
		
		$mainView = new mainView();  
		$mainView->setGoogleAnalytics($analytics->getGoogleAnalytics());
		$mainView->getMainLayout();
	}
	
	private function getHeader()
	{
		require_once 'Project/Code/'.DOMAIN.'/Panels/header/headerController.php';
		$headerView = new headerController();
		$headerView->getHeader();
	}
	
	private function getFooter()
	{
		require_once 'Project/Code/'.DOMAIN.'/Panels/footer/footerController.php';
		$footerController = new footerController();
		$footerController->getFooter();
	
	}
}

?>