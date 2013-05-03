<? 
require_once 'pdfChooserBlockModel.php';
require_once 'pdfChooserBlockView.php';
require_once 'Project/Code/System/PDF/pdfs.php';

class pdfChooserBlockController
{
	public function getPdfChooser()
	{
		$pdfChooserBlockView = new pdfChooserBlockView();
		
		$pdfs = new pdfs();
		$array_of_pdfs = $pdfs->selectPDFs();

		
		$pdfChooserBlockView->_set('array_of_pdf', $array_of_pdfs);
		return $pdfChooserBlockView->displayPdfChooser(); 
	}
}
?>