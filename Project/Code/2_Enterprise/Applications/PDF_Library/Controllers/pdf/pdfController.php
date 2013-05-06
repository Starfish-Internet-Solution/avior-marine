<?php 
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'pdfModel.php';
require_once 'pdfView.php';
require_once 'Project/Code/System/PDF/pdf.php';
require_once 'Project/Code/System/PDF/pdfs.php';
require_once 'Project/Code/2_Enterprise/Applications/PDF_Library/Modules/fileUpload.php';
require_once 'Project/Code/System/Articles/articles.php';

class pdfController extends applicationsSuperController
{
	public function indexAction()
	{
		$pdfs = new pdfs();
		$array_of_pdfs = $pdfs->selectPDFs();
		
		$view = new pdfView();
		$view->_set('array_of_pdfs', $array_of_pdfs);
		
		$view->getMainLayout();
	}
	
//------------------------------------------------------------------------------------------------------	
	
	public function addAction()
	{
		try
		{
			//set path to save and accepted image types
			$path 			= STAR_SITE_ROOT."/Data/pdf";
			$accepted_types = array(					
					'text/plain',
					'application/pdf',
					'application/msword',
					'application/rtf',
					'application/vnd.ms-excel',
					'application/vnd.ms-powerpoint',
					'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
					'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					'application/vnd.openxmlformats-officedocument.presentationml.presentation');
			$filename  		= $_FILES['file']['name']; 
			$ext 			= strstr($_FILES['file']['name'], '.');
			$pathName		= md5(time().$_FILES['file']['name']).$ext;
			
			$success = fileUpload::upload($_FILES, $path, $pathName, 'file', $accepted_types);
			
			if($success === TRUE)
			{
				$pdf = new pdf();
				$pdf->__set('filename', $filename);
				$pdf->__set('path', $pathName);
				$pdf->insert();
				
				header('location: /'.routes::getInstance()->getCurrentTopLevelURLName().'');
			}
			
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
	
	public function deleteAction()
	{
		
		$delete = pdf::delete($_POST['hidden_file_id']);

		$hidden_path = $_POST['hidden_path'];
		
		if(file_exists("Data/pdf/$hidden_path"))
		{
			unlink("Data/pdf/$hidden_path");
		}
		
		header('location: /'.routes::getInstance()->getCurrentTopLevelURLName().'');
	}
	
	
}
?>