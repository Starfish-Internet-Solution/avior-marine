<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/ResultCleaner/resultCleaner.php';

class articlesNavigation
{
	private $categories;
	private $subcategories;
	private $articles;
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
		require_once 'Project/Code/System/Articles/categories.php';
		require_once 'Project/Code/System/Articles/subcategories.php';
		
		$categories = new categories();
		$categories->select();
		
		$subcategories = new subcategories();
		$subcategories->select();
		
		$this->articles = $this->select();
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
		
			//add active class
			if (count($this->url_parameters) > 1)
			if(is_numeric($this->url_parameters[3]) && $this->url_parameters[1] == 'category' && $this->url_parameters[3] == $category_id)
				$this->active = 'active';
			
		}
		
		$category_li .= $this->getArticleList(NULL, NULL, FALSE);
		
		if(strlen($category_li) == 0)
			return '
				<div class="pTl pLl pRl" id="heading">
					<h3>ARTICLES</h3>
					<span class="sprite2 addArticle pointer" id="add_product"></span>
				</div>
				
				<div class="clearfix" id="sideNavigation">
					<ul class="unstyled clearfix newsEnterpriseNav" id="nav_list">'.$category_li.'</ul>
				</div>';
		
		else
			return '
				<div class="pTl pLl pRl" id="heading">
					<h3>ARTICLES</h3>
					<span class="sprite2 addArticle pointer" id="add_product"></span>
				</div>
				
				<div class="clearfix" id="sideNavigation">
					<ul class="unstyled clearfix newsEnterpriseNav" id="nav_list">'.$category_li.'</ul>
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
							<input type="hidden" name="category_id" value="'.$category_id.'">
							<input type="hidden" name="subcategory_id" value="'.$subcategory_id.'">
						</span>
						'.$this->getArticleList($category_id, $subcategory_id).'
				</li>';
		}
		
		$subcategory_li .= $this->getArticleList($category_id, NULL, FALSE);
		
		if(strlen($subcategory_li) == 0)
			return '';
		
		else
			return '<ul class="clearfix">'.$subcategory_li.'</ul>';
	}
	
//-------------------------------------------------------------------------------------------------
	
	private function getArticleList($category_id, $subcategory_id, $with_ul = TRUE)
	{
		$article_li = '';
		
		$article_years_array = array();
		
		foreach($this->articles as $article)
		{
			if(!array_key_exists($article['date_created'], $article_years_array))
			{
				$article_years_array[date("Y", strtotime($article['date_created']))] = array();
			}
		}
		
		foreach($this->articles as $article)
		{
			$month_created = date("F", strtotime($article['date_created']));
			$year_created = date("Y", strtotime($article['date_created']));
			
			foreach($article_years_array as $year_created_key => $month)
			{
				if($year_created_key == $year_created)
				{
					if(!array_key_exists($month_created, $article_years_array[$year_created_key]))
					{
						$article_years_array[$year_created_key][$month_created] = $month_created;
						//print $year_created_key."".$month_created."<br>";
					}
				}
			}
		}
		
		
		foreach($article_years_array as $year => $months)
		{
			//year li
			$article_li .= "<li style='color:black;'> <a href='/articles/articles/year/$year'> $year </a>";
			foreach($months as $m) {
				//month start of ul
				$article_li .= "<ul>";
					$article_li .= "<li>"; //month start of li
						$article_li .= "<a href='/articles/articles/year/$year/month/$m'>$m</a>  <ul>"; //article start of ul
							foreach($this->articles as $article)
							{
								$month_created = date("F", strtotime($article['date_created']));
								$year_created = date("Y", strtotime($article['date_created']));
								if($month_created == $m && $year_created == $year)
								{
									if (count($this->url_parameters) <= 1) {
										$article_li .= "<li class=''><span class='nav article_list'><a href='/articles/articles/edit/{$article['article_id']}'> {$article['article_title']} </a></span> </li>";
									} else {
										if($this->url_parameters[3] == $article['article_id']) {
											$article_li .= "<li class='active'><span class='nav article_list'><a href='/articles/articles/edit/{$article['article_id']}'> {$article['article_title']} </a></span> </li>";
										} else {
											$article_li .= "<li class=''><span class='nav article_list'><a href='/articles/articles/edit/{$article['article_id']}'> {$article['article_title']} </a></span> </li>";
										}										
									}
								}
							}
					$article_li .= "</ul></li>";//end of article ul. end of month li
				$article_li .= "</ul>";//end of month ul
			}
			$article_li .= "</li>";//end of year li
		}
		
		
		
		
		if(strlen($article_li) == 0)
			return '';
		
		elseif($with_ul == TRUE)
			return '<ul class="clearfix">'.$article_li.'</ul>';
		
		else
			return $article_li;
	}
	
//-------------------------------------------------------------------------------------------------
	
	private function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						a.category_id,
						a.date_created,
						category_title,
						a.subcategory_id,
						subcategory_title,
						article_id,
						article_title
					FROM
						article a
					LEFT JOIN
						article_subcategories s
					ON
						a.subcategory_id = s.subcategory_id
					LEFT JOIN
						article_categories c
					ON
						a.category_id = c.category_id
					WHERE
						a.category_id IS null
					ORDER BY
						a.category_id DESC, a.subcategory_id DESC
					";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			
			$results = resultCleaner::cleanResults($pdo_statement->fetchAll(PDO::FETCH_ASSOC));
			
			$article_list = array();
			
			foreach($results as $result)
			{
				$article_info = new articlesNavigation();
				
				$article_info->__set('category_id', $result['category_id']);
				$article_info->__set('category_title', $result['category_title']);
				$article_info->__set('subcategory_id', $result['subcategory_id']);
				$article_info->__set('subcategory_title', $result['subcategory_title']);
				$article_info->__set('article_id', $result['article_id']);
				$article_info->__set('article_title', $result['article_title']);
				
				$article_list[] = $article_info;
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