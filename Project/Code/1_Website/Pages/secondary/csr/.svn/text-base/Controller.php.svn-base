<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');
require_once 'Project/Code/System/Articles/articles.php';
require_once 'Project/Code/System/Articles/article.php';


class controller extends controllerSuperClass_Core 
{
	public function indexAction()
	{
		$articles = new articles();
		$article = new article();
		$view = new view();
		
		$permalink = $this->getValueOfURLParameterPair('view');
		
		if(isset($permalink))
		{
			$article->__set('permalink', $permalink);
			$article->select();
			$view->_set('article_details', $article);
		}
		else
		{
			$article->selectFirst(FALSE);
			$view->_set('article_details', $article);
		}
		
		
		
		$articles->selectByCategory(1);
		$view->_set('array_of_articles', $articles->__get('array_of_articles'));
		$view->displayMainTemplate();
	}
}
?>