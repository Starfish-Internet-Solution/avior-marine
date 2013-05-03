<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/ResultCleaner/resultCleaner.php';

class productsNavigation
{
	private $categories;
	private $subcategories;
	private $products;
	private $active = '';
	private $url_parameters;
	private $current_page;
	
//-------------------------------------------------------------------------------------------------	

	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function __set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	
//-------------------------------------------------------------------------------------------------	

	public function init()
	{
		require_once 'Project/Code/System/Products/categories.php';
		require_once 'Project/Code/System/Products/subcategories.php';
		
		$categories = new categories();
		$categories->select();
		
		$subcategories = new subcategories();
		$subcategories->select();
		
		$this->products = $this->select();
		$this->categories = $categories->__get('array_of_categories');
		$this->url_parameters = routes::getInstance()->_pathInfoArray;
		$this->subcategories = $subcategories->__get('array_of_subcategories');
		$this->current_page = routes::getInstance()->getCurrentTopLevelURLName();
	}
	
	
//-------------------------------------------------------------------------------------------------
	
	public function getNavigationListAsArray()
	{
		$category_li = '';
	
		foreach($this->categories as $category)
		{
			$this->active = '';
			
			$category_id 	= $category->__get('category_id');
			$category_title = $category->__get('category_title');
		
			if($this->current_page == $category->__get('category_title'))
			{
				//add active class
				if (count($this->url_parameters) > 1)
				if(is_numeric($this->url_parameters[3]) && $this->url_parameters[1] == 'category' && $this->url_parameters[3] == $category_id)
				$this->active = 'active';
					
				$category_li .= '
							<li class="clearfix '.$this->active.'">
								<span class="sprite2 addProduct pointer" id="add_product">
									<input type="hidden" name="category_id" value="'.$category_id.'">
								</span>
								'.$this->getSubCategoryList($category_id).'
							</li>
							';
			}
			
		
		}
		
		$category_li .= $this->getProductList(NULL, NULL, FALSE);
		
		if(strlen($category_li) == 0)
			return '
				<div class="pTl pLl pRl" id="heading">
					<h3>'.strtoupper($this->current_page).'</h3>
				</div>
				
				<div class="clearfix" id="sideNavigation">
					<ul class="unstyled clearfix" id="nav_list">'.$category_li.'</ul>
				</div>';
		
		else
			return '
				<div class="pTl pLl pRl" id="heading">
					<h3>'.strtoupper($this->current_page).'</h3>
				</div>
				
				<div class="clearfix" id="sideNavigation">
					<ul class="unstyled clearfix" id="nav_list">'.$category_li.'</ul>
				</div>
			';
		
	}
	
//-------------------------------------------------------------------------------------------------
	
	private function getSubCategoryList($category_id)
	{
		$subcategory_li = '';
		
		foreach($this->subcategories as $subcategory)
		{
			$this->active = '';
			
			$subcategory_id 	= $subcategory->__get('subcategory_id');
			$subcategory_title 	= $subcategory->__get('subcategory_title');
			
			//add active class
			if (count($this->url_parameters) > 1)
			if(is_numeric($this->url_parameters[3]) && $this->url_parameters[1] == 'subcategory' && $this->url_parameters[3] == $subcategory_id)
			$this->active = 'active';
			
			if($subcategory->__get('category_id') == $category_id)
				$subcategory_li .= '
				<li class="clearfix mTm '.$this->active.'">
				
						<span class="nav sub_category_list">
							<a href="/'.$this->current_page.'/subcategory/edit/'.$subcategory_id.'" class="fwB">'.$subcategory_title.'</a>
						</span>
					
						<span class="sprite addProduct pointer" id="add_product">
							<input type="hidden" name="category_id" value="'.$category_id.'">
							<input type="hidden" name="subcategory_id" value="'.$subcategory_id.'">
						</span>
						'.$this->getProductList($category_id, $subcategory_id).'
				</li>';
		}
		
		$subcategory_li .= $this->getProductList($category_id, NULL, FALSE);
		
		if(strlen($subcategory_li) == 0)
			return '';
		
		else
			return '<ul class="clearfix">'.$subcategory_li.'</ul>';
	}
	
//-------------------------------------------------------------------------------------------------
	
	private function getProductList($category_id, $subcategory_id, $with_ul = TRUE)
	{
		$product_li = '';
		
		foreach($this->products as $product)
		{
			$this->active = '';
			
			//add active class
			if (count($this->url_parameters) > 1)
			if(is_numeric($this->url_parameters[3]) && $this->url_parameters[1] == 'product' && $this->url_parameters[3] == $product['product_id'])
			$this->active = 'active';
			
			if($category_id == $product['category_id'] && $subcategory_id == $product['subcategory_id'])
				$product_li .= '
				<li class='.$this->active.'>
					<span class="nav product_list">
						<a href="/'.$this->current_page.'/product/edit/'.$product['product_id'].'">'.$product['product_title'].'</a>
					</span>
				</li>';
		}
		
		if(strlen($product_li) == 0)
			return '';
		
		elseif($with_ul == TRUE)
			return '<ul class="clearfix">'.$product_li.'</ul>';
		
		else
			return $product_li;
	}
	
//-------------------------------------------------------------------------------------------------
	
	private function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						a.category_id,
						category_title,
						a.subcategory_id,
						subcategory_title,
						product_id,
						product_title
					FROM
						products a
					LEFT JOIN
						product_subcategories s
					ON
						a.subcategory_id = s.subcategory_id
					LEFT JOIN
						product_categories c
					ON
						a.category_id = c.category_id
					ORDER BY
						a.category_id DESC, a.subcategory_id DESC
					";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			
			$results = resultCleaner::cleanResults($pdo_statement->fetchAll(PDO::FETCH_ASSOC));
			
			$product_list = array();
			
			foreach($results as $result)
			{
				$product_info = new productsNavigation();
				
				$product_info->__set('category_id', $result['category_id']);
				$product_info->__set('category_title', $result['category_title']);
				$product_info->__set('subcategory_id', $result['subcategory_id']);
				$product_info->__set('subcategory_title', $result['subcategory_title']);
				$product_info->__set('product_id', $result['product_id']);
				$product_info->__set('product_title', $result['product_title']);
				
				$product_list[] = $product_info;
			}
			
			return $results;
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
}
?>