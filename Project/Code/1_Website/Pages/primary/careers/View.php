<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	private $array_of_jobs 	= array();
	private $array_of_images = array();
	private $jobs;
	
	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};	else return NULL;
	}
	
	public function _set($field, $value) 
	{
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
	
	//------------------------------------------------------------------------------------------------------------------------------	

	public function displayCareersListing() 
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/careers/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		$this->displayJsCss();
	}
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displayAppForm()
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/careers/templates/application_form.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		$this->displayJsCss();
	}
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displayJsCss() 
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/careers/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('CSS JS FOR CAREERS'=>$content));
	}	
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displayQuickApplyForm()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/quick_apply.phtml");
		response::getInstance()->addContentToTree(array('QUICK_APPLY'=>$content));
	}
	
}
?>