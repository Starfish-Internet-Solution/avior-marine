<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');

require_once 'Project/Code/System/Products/product.php';
require_once 'Project/Code/System/Products/products.php';
require_once 'Project/Code/System/PDF/pdfs.php';

class controller extends controllerSuperClass_Core 
{
	public function indexAction() 
	{
		$view = new view();
		$products = new products();
		$product = new product();
		
		$products->__set('category_id', 1);
		$products->selectByCategoryID();
		
		$permalink = $this->getValueOfURLParameterPair('view');
		$url_link = routes::getInstance()->_pathInfoArray;
		
		//check first if permalink is set
 		if(isset($permalink))
 		{
 			//check if the permalink is downloadables if so get all downloadbles needed else get article details needed
 			if($permalink == 'downloadables')
 			{
 				$pdfs = new pdfs();
 				$array_of_downloadables = $pdfs->selectPDFs(TRUE);
 				$view->_set('array_of_downloadables', $array_of_downloadables);
 			}
 			else
 			{
	 			$product->__set('permalink', $permalink);
	 			$product->select();
	 			$view->_set('article_details', $product);
 			}
 		}
 		else
 		{
 			$product->selectFirstLink();
 			$view->_set('article_details', $product);
 		}

		
		$view->_set('link_nav_listing', $products->__get('array_of_products'));
		$view->displayMainTemplate();
	}
	
	public function viewDownloadablesAction()
	{
		require_once 'Project/Code/System/PDF/pdf.php';
		
		$pdf = new pdf();
		$pdf_id = $this->getValueOfURLParameterPair('file_id');
		$pdf->__set('pdf_id', $pdf_id);
		$pdf->select();
		
		$ext = explode('.', $pdf->__get('filename'));
		$filename_ext = $ext[count($ext) - 1];

		$path = STAR_SITE_ROOT."/Data/pdf/";
		header('Content-type: application/'.$filename_ext.'');
		header('Content-Disposition: attachment; filename="'.$pdf->__get('filename').'"');
		readfile($path.$pdf->__get('filename'));
		
	}
	
}
?>