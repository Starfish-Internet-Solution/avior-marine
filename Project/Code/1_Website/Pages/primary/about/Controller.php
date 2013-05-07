<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core 
{
	public function indexAction()
	{
		$url_parameters = routes::getInstance()->getCurrentPageID();
		
		$view = new view();
		$model = new model();
		
		if($url_parameters != 'about')
			$XML = $model->loadDataSimpleXML($url_parameters);
		else
			$XML = $model->loadDataSimpleXML('data');
		
		$view->_XMLObj = $XML;
		$view->dipslayBanner();
		$view->renderAll();
	}
}
?>