<?php 
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';
class pdfView extends applicationsSuperView
{
	
	private $array_of_pdfs;
	private $array_of_pdf_used;
	
	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
	
		else return NULL;
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function _set($field, $value) {
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
	
	//-------------------------------------------------------------------------------------------------
	
	
	
	
	public function getMainLayout()
	{
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/_Common/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('COMMON_CS_JS'=>$content));
		
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/PDF_Library/Controllers/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('PDF_CS_JS'=>$content));
		
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/PDF_Library/Controllers/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
		
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/PDF_Library/Controllers/templates/upload_file_dialog.phtml');
		response::getInstance()->addContentToTree(array('UPLOAD_DIALOG'=>$content));
		
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/PDF_Library/Controllers/templates/delete_file_dialog.phtml');
		response::getInstance()->addContentToTree(array('DELETE_DIALOG'=>$content));
		
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/PDF_Library/Controllers/templates/pdf_listing.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
		
	}
}

?>