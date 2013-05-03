<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'productView.php';

require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'Project/Code/System/Products/product.php';
require_once 'Project/Code/System/Products/products.php';
require_once 'Project/Code/System/Products/product_image.php';
require_once 'Project/Code/System/Products/product_images.php';
require_once 'Project/Code/System/Routes/route.php';
require_once 'Project/Code/2_Enterprise/Applications/Products/Modules/fileUpload.php';

class productController extends applicationsSuperController
{
	private $url_parameter;
	private $current_page;
	public function __construct()
	{
		parent::__construct();
		$this->current_page = routes::getInstance()->getCurrentTopLevelURLName();
	}
	
	public function indexAction()
	{
		$product = new product();
		$product->__set('current_page', routes::getInstance()->getCurrentTopLevelURLName());
		$product->selectFirst();
		$this->editAction($product->__get('product_id'));
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function addAction()
	{
		$route			= new route();
		$product		= new product();
		
		if(isset($_POST['title']) && isset($_POST['add_product']))
		{
		
				$pdo_connection = starfishDatabase::getConnection();
				$pdo_connection->beginTransaction();
				
				//insert routing details
				$route->__set('permalink', $this->replaceChars($_POST['title']));
				$route->insert();
				
				$category_id	= is_numeric($_POST['category_id']) ? $_POST['category_id'] : NULL;
				$subcategory_id = is_numeric($_POST['subcategory_id']) ? $_POST['subcategory_id'] : NULL;
				
				//insert product details
				$product->__set('route_id', $route->__get('route_id'));
				$product->__set('category_id', $category_id);
				$product->__set('subcategory_id',$subcategory_id);
				$product->__set('product_title', $_POST['title']);
				$product->__set('description', $_POST['intro']);
				$product->insert();
				
				$pdo_connection->commit();
				
				header('Location: /'.$this->current_page.'/product/edit/'.$product->__get('product_id'));
		
				
		}
		
		else
			header('Location: /'.$this->current_page.'');
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function editAction($product_id = NULL)
	{
		if($product_id === NULL)
			$product_id = $this->getValueOfURLParameterPair('edit');
		
		
		if(is_numeric($product_id))
		{	
			$route			= new route();
			$product		= new product();
			$product_image	= new product_images();
			
			//select the product details to be displayed
			$product->__set('product_id', $product_id);
			$product->select();
			
			//check if the save button is click
			if(isset($_POST['edit_product']))
			{
				
				$pdo_connection = starfishDatabase::getConnection();
				$pdo_connection->beginTransaction();
					
				//update routing details
				$route->__set('route_id', $product->__get('route_id'));
				$route->__set('permalink', $this->replaceChars($_POST['permalink']));
				$route->update();
				
				//check 
				if($this->current_page == "links")
				{
					//update product details
					$product->__set('product_title', $_POST['title']);
					$product->__set('url_name', $_POST['url_name']);
					$product->update();
					
					//update images
					$this->handleImages($product_id, 'gallery_image_id');
				}
				else
				{
					
					//set path to save and accepted image types
					$path 			= STAR_SITE_ROOT."/Data/file_manager";
					$accepted_types = array("");
					$filename  		= $_FILES['file']['name'];
					$ext 			= strstr($_FILES['file']['name'], '.');
					$pathName		= md5(time().$_FILES['file']['name']).$ext;
											
					$success = fileUpload::upload($_FILES, $path, $pathName, 'file');
					
					if($success === TRUE)
					{
						//update product details
						$product->__set('product_title', $_POST['title']);
						$product->__set('url_name', $pathName);
						$product->__set('link_title',$filename);
						
						$product->updateFile();
					}
				}
				
					
				$pdo_connection->commit();
				header('Location: /'.routes::getInstance()->getCurrentTopLevelURLName().'/product/edit/'.$product_id);
			
			}
			
			else
			{
				$product_images = product_images::selectThumbnailByType($product_id);
				
				$view = new productView();
				$view->_set('product', $product);
				$view->_set('product_images', $product_images);
				$this->selectEditor($view);
			}
		}
		
		else
		{
			//do this if there is no existing product..it will display "No Product To Dsipaly"
			$view = new productView();
			$product = new product();
			$view->_set('product', $product);
			$this->selectEditor($view);
		}
	}
	
//-------------------------------------------------------------------------------------------------	

	
	public function deleteAction()
	{	
		$product_id = $this->getValueOfURLParameterPair('delete');
		
		if(is_numeric($product_id))
		{
			//start SQL transaction
			/* NOTE: SQL transactions should be used when a combination of insert, update
			 * and delete commands is executed
			 */
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
				
			$route			= new route();
			$product		= new product();
			
			$product->__set('product_id', $product_id);
			$product->select();
			
			//delete routing details
			$route->__set('route_id', $product->__get('route_id'));
			$route->delete();
			
			//delete product details
			product::delete($product_id);
			
			$pdo_connection->commit();
		}
		
		header('Location: /'.$this->current_page.'');
	}
	
	public function viewDownloadableAction()
	{
		//get attachment details
		$product_id = $this->getValueOfURLParameterPair('view');
		$product = new product();
		$product->__set('product_id', $product_id);
		$product->select();

		$path  = STAR_SITE_ROOT."/Data/file_manager";
		$exploded_ext = explode('.', $product->__get('link_title'));
		$extension = $exploded_ext[1];
		
		//load the endcoded path and let the user download it with the original filename.
		header('Content-type: '.$extension);
		header('Content-Disposition: attachment; filename="'.$product->__get('link_title').'"');
		readfile($path.$product->__get('url_name'));
	
		//die is used here so that it stops the execution of the framework
		die;
	}
	
	public function testAction()
	{
		print 'here';
	}
	
//-------------------------------------------------------------------------------------------------	
	
	private function replaceChars($permalink)
	{
		$characters = array(' ','_',',','\'','.',':',';','?','!');
		
		$string = strtolower(str_replace($characters, '-', $permalink));
		
		return trim($string, '-');
	}
	
//-------------------------------------------------------------------------------------------------	
	
	private function handleImages($product_id, $post_key)
	{
		if(isset($_POST[$post_key]))
		{
			$i = 0;
			
			//delete
			foreach(product_images::selectProductImageIDs($product_id) as $id)
				if(!in_array($id, $_POST[$post_key]))
					if($id != 0 )product_image::delete($id);
			
			foreach($_POST[$post_key] as $value)
			{
				if($_POST['image_id'][$i] != '' || $_POST['image_id'][$i] != NULL)
				{
					$product_image	= new product_image();
					$product_image->__set('product_id', $product_id);
					$product_image->__set('image_id', $_POST['image_id'][$i]);
					$product_image->__set('used_for', 'gallery');
					
					//add
					if($value == 0)
						$product_image->insert();
					
					//update
					else
					{
						$product_image->__set('product_image_id', $value);
						$product_image->update();
					}
				}
				$i++;
			}
		}
		else
			product_images::deleteByProductID($product_id);
	}
	
//-------------------------------------------------------------------------------------------------
	
	private function selectEditor($view)
	{
		//check the current page so it must display the right editor
		if(routes::getInstance()->getCurrentTopLevelURLName() == "links")
			return $view->displayProductEditor();
		else
			return $view->displayFileEditor();
	}
	
}


