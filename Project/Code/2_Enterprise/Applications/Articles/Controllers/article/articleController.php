<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'articleView.php';

require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'Project/Code/System/Articles/article.php';
require_once 'Project/Code/System/Articles/articles.php';
require_once 'Project/Code/System/Articles/article_image.php';
require_once 'Project/Code/System/Articles/article_images.php';
require_once 'Project/Code/System/Products/product_image.php';

require_once 'Project/Code/System/Routes/route.php';

class articleController extends applicationsSuperController
{
	private $url_parameter;
	public function __construct()
	{
		parent::__construct();
	}
	
	public function indexAction()
	{
		
		//note: articles, csr, seafarers are using Article aplication
		//articles is distinguish by its category_id of being null
		//csr is distinguish by its category_id of 1 and sefarers categody_id is 2
		
		$article = new article();
		$product_image = new product_image();
	
		
		//if not articles in the url.. 
		if(routes::getInstance()->getCurrentTopLevelURLName() != 'articles')
		{
			$article->selectFirst(FALSE);
		}
		else
		{
			//check if we selectBYdate or the generic selectfirst
			if($this->getValueOfURLParameterPair('year'))
			{
				//check if there is a month in url parameter pair.
				if($this->getValueOfURLParameterPair('month'))
				{
					$month = date('m', strtotime($this->getValueOfURLParameterPair('month')));
					$year = $this->getValueOfURLParameterPair('year');
			
					$start_date = "$year-$month-01";
					$lastday = date('t',strtotime($start_date));
					$end_date   = "$year-$month-$lastday";
				}
				else
				{
					$year = $this->getValueOfURLParameterPair('year');
					$start_date = "$year-01-01";
					$end_date   = "$year-12-31";
				}
					
				//select articles by archive
				$article->selectByDate($start_date, $end_date);
				$thumbnail_path = $product_image->selectThumbnailPath($article->__get('image_id'));
			}
			else
			$article->selectFirst(TRUE);
		}
	
		
		
		
		$this->editAction($article->__get('article_id'), $select_first = TRUE);
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function addAction()
	{
		$route			= new route();
		$article		= new article();
		
		if(isset($_POST['title']) && isset($_POST['add_article']))
		{
			//start SQL transaction
			/* NOTE: SQL transactions should be used when a combination of insert, update
			 * and delete commands is executed
			 */
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
			
			//insert routing details
			$route->__set('permalink', $this->replaceChars($_POST['title']));
			$route->insert();
			
			$category_id	= is_numeric($_POST['category_id']) ? $_POST['category_id'] : NULL;
			$subcategory_id = is_numeric($_POST['subcategory_id']) ? $_POST['subcategory_id'] : NULL;
			
			//insert article details
			$article->__set('route_id', $route->__get('route_id'));
			$article->__set('category_id', $category_id);
			$article->__set('subcategory_id',$subcategory_id);
			$article->__set('article_title', $_POST['title']);
			$article->__set('intro', $_POST['intro']);
			$article->insert();
			
			$pdo_connection->commit();
			
			header('Location: /'.routes::getInstance()->getCurrentTopLevelURLName().'/action/edit/'.$article->__get('article_id'));
		}
		
		else
			header('Location: /'.routes::getInstance()->getCurrentTopLevelURLName().'');
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function editAction($article_id = NULL, $select_first = FALSE)
	{
		
		if($article_id === NULL)
			$article_id = $this->getValueOfURLParameterPair('edit');
		
		$article  = new article();
		$product_image = new product_image();
		
		//check if the action is came from indexaction
		if($select_first === TRUE)
		{
			$article->__set('article_id', $article_id);
			$article->select();
			$thumbnail_path = $product_image->selectThumbnailPath($article->__get('image_id'));
		}
		else
		{
			//check if what parameter pair is used
			if($this->getValueOfURLParameterPair('edit'))
			{
				$article_id = $this->getValueOfURLParameterPair('edit');
				$article->__set('article_id', $article_id);
				$article->select();
				$thumbnail_path = $product_image->selectThumbnailPath($article->__get('image_id'));
			}
		}
		
		if(isset($_POST['edit_article']))
		{
			//update article information
			
			$article->__set('date_created', $_POST['date_created']);
			$article->__set('article_title', $_POST['title']);
			$article->__set('intro', $_POST['description']);
			$article->__set('image_id', $_POST['image_id']);
			$article->__set('article_id', $article_id);
			$article->__set('status', $_POST['status']);
				
			$article->update();	
			
			$route = new route();
			$route->__set('route_id', $article->__get('route_id'));
			$route->__set('permalink', $_POST['permalink']);
			$route->update();
			
			header("Location:/".routes::getInstance()->getCurrentTopLevelURLName()."/articles/edit/$article_id");
			
		}
		
		$view = new articleView();
		$view->_set('article', $article);
		$view->_set('thumbnail_path', $thumbnail_path);
		$view->displayArticleEditor();
		
		
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function deleteAction()
	{	
		$article_id = $this->getValueOfURLParameterPair('delete');
		
		if(is_numeric($article_id))
		{
			//start SQL transaction
			/* NOTE: SQL transactions should be used when a combination of insert, update
			 * and delete commands is executed
			 */
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
				
			$route			= new route();
			$article		= new article();
			
			$article->__set('article_id', $article_id);
			$article->select();
			
			//delete routing details
			$route->__set('route_id', $article->__get('route_id'));
			$route->delete();
			
			//delete article details
			article::delete($article_id);
			
			$pdo_connection->commit();
		}
		
		header('Location: /'.routes::getInstance()->getCurrentTopLevelURLName().'');
	}
	
//-------------------------------------------------------------------------------------------------	
	
	private function replaceChars($permalink)
	{
		$characters = array(' ','_',',','\'','.',':',';','?','!');
		
		$string = strtolower(str_replace($characters, '-', $permalink));
		
		return trim($string, '-');
	}
	
//-------------------------------------------------------------------------------------------------	
	
	private function handleImages($article_id, $post_key)
	{
		if(isset($_POST[$post_key]))
		{
			$i = 0;
			
			//delete
			foreach(article_images::selectArticleImageIDs($article_id) as $id)
				if(!in_array($id, $_POST[$post_key]))
					article_image::delete($id);
			
			foreach($_POST[$post_key] as $value)
			{
				if($_POST['image_id'][$i] != '' || $_POST['image_id'][$i] != NULL)
				{
					$article_image	= new article_image();
					$article_image->__set('article_id', $article_id);
					$article_image->__set('image_id', $_POST['image_id'][$i]);
					$article_image->__set('used_for', 'gallery');
		
					//add
					if($value == 0)
						$article_image->insert();
					
					//update
					else
					{
						$article_image->__set('article_image_id', $value);
						$article_image->update();
					}
				}
				//var_dump($article_image);
				
				$i++;
			}
		}
		else
			article_images::deleteByArticleID($article_id);
	}
}


