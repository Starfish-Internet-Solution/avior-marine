<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');
/**
 * The Main Layout gets all the content for the areas outside the main focus.
 * Eg. if you are on www.MyResort.com/accommodation or even www.MyResort.com, 
 * the focus will be on a page
 * but you have other tasks like header photo, logo, navigation
 * these will be needed on most pages. 
 * 
 */


class mainView extends viewSuperClass_Core
{
	public function __construct()
	{		
		
		//HTML5 SHIV ======================================================================================================
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Main_Layout/templates/html5Shiv.phtml');
		response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('HTML5 SHIV'=>$content),'TOP');
		//Myk placed this here to make older browsers which do not support HTML5 function properly
		
		//JQUERY LIBRARY ==========================================================================================================
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JQuery/templates/jquery_link.phtml');
		response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('JQUERY LIBRARY'=>$content));
			
		//JQUERY AJAX ======================================================================================================	
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/Ajax/templates/jquery_link.phtml');
		response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('JQUERYAJAX'=>$content),'TOP');
			
		//NIVO SLIDER ========================================================================================================	
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JSlider/templates/nivoSlider_link.phtml');
		response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('NIVO SCRIPT'=>$content));
			
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/JSlider/templates/nivoSlider_css_link.phtml');
		response::getInstance()->addContentToStack('css_used_on_every_page',array('NIVO CSS'=>$content));
			
		//Validation ===========================================================================================================
		$content = $this->renderTemplate(FILE_ACCESS_CORE_DESIGN.'/Libraries/Validation/templates/validation_link.phtml');
		response::getInstance()->addContentToStack('javascript_used_on_every_page_bottom',array('VALIDATION SCRIPT'=>$content),'BOTTOM');
								
	}

	public function getMainLayout() 
	{

       	//GLOBAL SCRIPTS / CSS ========================================================================================================
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Main_Layout/templates/global_js_links.phtml');
		//response::getInstance()->addContentToTree(array('GLOBAL_SCRIPTS'=>$content));
		response::getInstance()->addContentToStack('javascript_used_on_every_page_top',array('CUFON'=>$content));
		
		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Main_Layout/templates/global_css_links.phtml");
		response::getInstance()->addContentToStack('css_used_on_every_page',array('MAIN LAYOUT CSS'=>$content));
		
		$content = $this->renderTemplate("Project/Design/".DOMAIN."/Main_Layout/templates/global_inpage_javascript.js");
		response::getInstance()->addContentToStack('inpage_javascript_top',array('MAIN INPAGE JAVASCRIPT'=>$content));
        
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Main_Layout/templates/main.phtml');
		response::getInstance()->addContentToTree(array('TOPLEVEL'=>$content));
		
		// GOOGLE ANALYTICS ===============================================================================================
        $content = $this->google_analytics;
        response::getInstance()->addContentToTree(array('GOOGLE_ANALYTICS'=>$content));
   }
        
	//=================================================================================================
        
	public function setGoogleAnalytics($analytics) { $this->google_analytics = $analytics; }
        
	//=================================================================================================
   

	
}
?>