<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	private $array_of_images = array();
	
	public function setArrayofImages($array_of_images)
	{
		$this->array_of_images = $array_of_images;
	}
	
	public function getArrayofImages()
	{
		return $this->array_of_images;
	}
	
	public function dipslayBanner()
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/about/templates/banner.phtml');
		    response::getInstance()->addContentToTree(array('BANNER'=>$content));
	}
}
?>