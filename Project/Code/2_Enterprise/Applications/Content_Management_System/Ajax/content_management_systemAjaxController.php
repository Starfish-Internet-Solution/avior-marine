<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
	 	
class content_management_systemAjaxController extends applicationsSuperController
{
	public function pdfChooserAction()
	{
		require_once 'Project/Code/2_Enterprise/Applications/PDF_Library/Blocks/pdfChooserBlockController.php';
	
		$pdfChooserBlockController = new pdfChooserBlockController();
	
		jQuery('div#pdfChooser')->html($pdfChooserBlockController->getPdfChooser());
		jQuery::getResponse();
	}
}