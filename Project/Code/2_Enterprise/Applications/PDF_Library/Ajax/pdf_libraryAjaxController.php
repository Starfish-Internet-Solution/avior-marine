<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
	 	
class pdf_libraryAjaxController extends applicationsSuperController
{
	public function pdfChooserAction()
	{
		require_once 'Project/Code/2_Enterprise/Applications/PDF_Library/Blocks/pdfChooserBlockController.php';
		
		$pdfChooserBlockController = new pdfChooserBlockController();
		
		jQuery('div#pdfChooser')->html($pdfChooserBlockController->getPdfChooser());
		jQuery::getResponse();
	}
	
	public function updateStatusAction()
	{
		require_once 'Project/Code/System/PDF/pdf.php';
		
		$pdf = new pdf();
		$pdf->__set('pdf_id', $_REQUEST['id']);
		$pdf->updateOneColumn('is_used', $_REQUEST['status']);
				
		jQuery::getResponse();
	}
	
}
?>