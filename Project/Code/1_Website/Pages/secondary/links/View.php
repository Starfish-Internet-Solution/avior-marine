<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	private $link_nav_listing;
	private $article_details;
	private $array_of_downloadables;
	
	public function _get($field) {
		if(property_exists($this, $field)) return $this->{$field};
		else return NULL;
	}
	
	public function _set($field, $value) {
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
	
	public function displayMainTemplate() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/secondary/links/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	
		$this->displayNavigation();
		$this->displayJsCss();
	}
	
	public function displayNavigation() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/secondary/links/templates/links_navigation.phtml');
		response::getInstance()->addContentToTree(array('LINKS_LIST'=>$content));
	}
	
	public function displayJsCss() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/secondary/links/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('CSS LINKS'=>$content));
	}	
}
?>