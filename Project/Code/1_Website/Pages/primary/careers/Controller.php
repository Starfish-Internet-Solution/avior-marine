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
		
		$view->renderAll();
	}
}
?>