<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	private $array_of_jobs 	= array();
	private $array_of_images = array();
	private $array_of_certificates;
	private $array_of_skills;
	
	private $jobs;
	private $has_job_id;
	
	private $service_count;
	
	private $first_phase_array;
	private $second_phase_array;
	private $third_phase_array;
	private $fourth_phase_array;
	
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
	
	public function displayJsCss2() 
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/careers/templates/js_and_css_links2.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('CSS JS FOR CAREERS'=>$content));
	}	
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displayQuickApplyForm()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/quick_apply.phtml");
		response::getInstance()->addContentToTree(array('QUICK_APPLY'=>$content));
	}
	
	//------------------------------------------------------------------------------------------------------------------------------	
	
	public function displayFirstPhaseApplication()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/first_phase_application.phtml");
		response::getInstance()->addContentToTree(array('PHASE'=>$content));
	}
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displaySecondPhaseApplication()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/second_phase_application.phtml");
		response::getInstance()->addContentToTree(array('PHASE'=>$content));
	}

	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displayThirdPhaseApplication()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/third_phase_application.phtml");
		response::getInstance()->addContentToTree(array('PHASE'=>$content));
	}
	
	public function displayFourthPhaseApplication()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/fourth_phase_application.phtml");
		response::getInstance()->addContentToTree(array('PHASE'=>$content));
	}
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displayApplicationMainContent()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/online_application.phtml");
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		
		$this->displayJsCss2();
	}
	
	//------------------------------------------------------------------------------------------------------------------------------
	
	public function displayJobDescription()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/job_description.phtml");
		response::getInstance()->addContentToTree(array('JOB_DESCRIPTION'=>$content));
	}
	
	//------------------------------------------------------------------------------------------------------------------------------

	public function displayPopup()
	{
		$content = $this->renderTemplate("Project/Design/1_Website/Pages/primary/careers/templates/popup.phtml");
		response::getInstance()->addContentToTree(array('POPUP'=>$content));
	}
	
}
?>