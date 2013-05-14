<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class articlesView extends applicationsSuperView
{
	private $array_of_articles 	= array();
	private $array_of_archives 	= array();
	private $article;
	private $current_archive_month;
	private $current_archive_year;
	private $prevPermalink;
	private $nextPermalink;
	private $is_latest;
	
//=================================================================================================

	public function _get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};	else return NULL;
	}
	
//=================================================================================================
	
	public function _set($field, $value) {
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
//=================================================================================================	

	public function displayMainContent()
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Applications/News/Controllers/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('ARTICLES CSS JS LINK'=>$content));
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/News/Controllers/templates/main_template.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
	
	public function displayArticle()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/News/Controllers/templates/article_listing.phtml');
		response::getInstance()->addContentToTree(array('ARTICLE_CONTENT'=>$content));
		$this->displayNavigation();
	}
	
	
	public function displayArticleDetail()
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/News/Controllers/templates/article_details.phtml');
		response::getInstance()->addContentToTree(array('ARTICLE_CONTENT'=>$content));
		$this->displayNavigation();
	}
	
	public function displayArchives()
	{
		$content = '';
		$url_parameter = routes::getInstance()->_pathInfoArray;
		
		$content .= '<li  '.((end($url_parameter) ==  'news') ? 'class="active"' : "").'><a href="/news" class="fwB">LATEST</a></li>';
		
		foreach ($this->array_of_archives as $archive):
			if($this->current_archive_month == strtolower($archive['month']) && $this->current_archive_year == $archive['year'])
			{
				$active = 'class="active"';
			}
			else
				$active = '';
				
				
				$content .= '<li '.$active.'><a href="/news/archive/'.strtolower($archive['month']).'/'.$archive['year'].'"><span class="gray_arrow"></span>'.$archive['month'].' '.$archive['year'].'</a></li>';
				
		endforeach;
		$content .= '<li '.((end($url_parameter) ==  'all') ? 'class="active"' : "").'><a href="/news/all" class="fwB">ALL</a></li>';
		
		return $content;
	}

	
	public function displayNavigation() 
	{
		$content = $this->renderTemplate('Project/Design/1_Website/Applications/News/Controllers/templates/article_navigation.phtml');
		response::getInstance()->addContentToTree(array('TOPIC_LIST'=>$content));
	}
	
	/* 
	public function displayPrevNextButton()
	{
		$content = '<span class="fright">';
		if ($this->_get('prevPermalink') != ''):
			$content .= '<a class="fwB mRxl fleft" href="/news/'.$this->prevPermalink.'">&lt; previous post</a>';
		endif;
		if ($this->_get('nextPermalink') != ''):
			$content .= '<a class="fwB fright" href="/news/'.$this->nextPermalink.'">next post &gt;</a>';
		endif;
		$content .= '</span>';
		
		return $content;
	}
	*/
}