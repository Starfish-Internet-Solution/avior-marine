<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class job_managerView extends applicationsSuperView
{
	
	private $array_of_jobs;
	
	public function __construct()
	{
		$this->templates_location = 'Project/Design/2_Enterprise/Applications/Job_Manager/Controllers/templates/job_manager/';
	}
	
//-------------------------------------------------------------------------------------------------	

	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function _set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	

	public function displayApplicationContent()
	{
		$content = $content = $this->renderTemplate($this->templates_location.'job_editor.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_CONTENT'=>$content));
	}

}
?>