<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class view extends viewSuperClass_Core 
{
	private $array_of_albums = array();
	private $array_of_images = array();
	private $album_title;
	
	public function _get($field) {
		if(property_exists($this, $field)) return $this->{$field};
		else return NULL;
	}
	
	public function _set($field, $value) {
		if(property_exists($this, $field)) $this->{$field} = $value;
	}	

	public function displayGalleryListing() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/gallery/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		$this->displayJsCss();
	}
	
	public function displayGalleryImages($total_pages, $current_page) {
		$this->displayPagination($total_pages, $current_page);
		
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/gallery/templates/gallery_details.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		
		$this->displayJsCss();
	}
		
	public function displayJsCss() {
		$content = $this->renderTemplate('Project/Design/1_Website/Pages/primary/gallery/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('CSS JS FOR GALLERY'=>$content));
		
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JEasing/templates/jeasing_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JQUERY EASING' => $content));
		
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JMouseWheel/templates/JMouseWheel_script_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JQUERY MOUSE WHEEL' => $content));
		
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/FancyBox/templates/fancyBox_css_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JQUERY FANCYBOX CSS' => $content));
		
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/FancyBox/templates/fancyBox_scripts_link.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JQUERY FANCYBOX JS' => $content));
	}	
}
?>