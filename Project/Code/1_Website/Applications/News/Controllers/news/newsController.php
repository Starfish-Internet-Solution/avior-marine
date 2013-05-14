<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/Code/System/Routes/route.php';
require_once 'newsView.php';
require_once 'newsModel.php';


class newsController extends applicationsSuperController
{

	private $url_parameters;
	public function __construct()
	{
		$dataHandler = new dataHandler();
		$articlesView = new articlesView();
				
		parent::__construct();
		$this->url_parameters = routes::getInstance()->_pathInfoArray;
	}
	
	public function indexAction()
	{
		array_shift($this->url_parameters);
		$articlesView = new articlesView();
		
		if(count($this->url_parameters) == 1){
			if(route::ifPermalinkExists($this->url_parameters[0]))
			{
				$this->article_details($this->url_parameters[0]);
			}
			else
			{
				$this->getArticleListing(FALSE);
			}
		}
		elseif(count($this->url_parameters) >= 1)
		{
			//select by archive
			$this->getArticleListing(TRUE);
		}
		else
			$this->getArticleListing(FALSE, TRUE);
		
	
		$articlesView->displayMainContent();
	}
	
	public function getArticleListing($archive = FALSE, $is_latest = FALSE)
	{
		require_once 'Project/Code/System/Articles/articles.php';
		$articles = new articles();
		$articlesView = new articlesView();
	
		if($archive)
		{
			$month			= date('m',strtotime($this->url_parameters[1]));//convert month from string to integer
			$year			= $this->url_parameters[2];
				
			
			$articles->__set('has_category_id', FALSE);
			$articles->selectByArchive($month, $year);
			$articlesView->_set('current_archive_month', $this->url_parameters[1]);
			$articlesView->_set('current_archive_year', $year);
		}
		else
		{
			if($is_latest)
			{
				$articlesView->_set('is_latest', TRUE);
				$articles->__set('has_category_id', FALSE);
				$articles->__set('is_latest', TRUE);
				$articles->select();
			}
			else
			{
				$articles->__set('has_category_id', FALSE);
				$articles->select();
			}
		}
		
		$articlesView->_set('array_of_articles', $articles->__get('array_of_articles'));
		$articlesView->_set('array_of_archives', $articles->selectArchivesList());
		$articlesView->displayArticle();
	}
	
	public function article_details($permalink = NULL)
	{
		require_once 'Project/Code/System/Articles/article.php';
		require_once 'Project/Code/System/Articles/articles.php';
		
		$articles = new articles();
		$article = new article();
		
		$article->__set('permalink', $permalink);
		$article->select();
	
		$articlesView = new articlesView();
		$articlesView->_set('article', $article);
		$articlesView->_set('array_of_archives', $articles->selectArchivesList());
		
		//$articlesView->_set('nextPermalink', $article->selectPrevOrNextPostPermalink('next'));
		//$articlesView->_set('prevPermalink', $article->selectPrevOrNextPostPermalink('prev'));
		$articlesView->displayArticleDetail();
	}
	
}