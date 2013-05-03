<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class pdfChooserBlockView  extends applicationsSuperView
{
	private $array_of_pdf;
	
	//-------------------------------------------------------------------------------------------------
	
	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		else return NULL;
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function _set($field, $value)
	{
		if(property_exists($this, $field)) $this->{$field} = $value;
	}

//=================================================================================================
	
	public function displayPdfChooser()
	{
		$content = $this->renderTemplate('Project/Design/2_Enterprise/Applications/PDF_Library/Controllers/templates/pdf_chooser.phtml');
		return $content;	
	}
}
?>