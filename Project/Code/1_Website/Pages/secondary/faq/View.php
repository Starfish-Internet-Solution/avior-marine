<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	private $array_of_articles;
	private $article_details;
	
	public function _get($field) {
		if(property_exists($this, $field)) return $this->{$field};
		else return NULL;
	}
	
	public function _set($field, $value) {
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
	
	public function displayMainTemplate() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/secondary/faq/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	
		$this->displayNavigation();
		$this->displayJsCss();
	}
	
	public function displayNavigation() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/secondary/faq/templates/faq_topic_navigation.phtml');
		response::getInstance()->addContentToTree(array('TOPIC_LIST'=>$content));
	}
	
	public function displayJsCss() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/secondary/faq/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('CSS FAQ'=>$content));
	}	
}
?>