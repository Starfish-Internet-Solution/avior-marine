<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');
require_once('Project/Code/System/Routes/route.php');

class controller extends controllerSuperClass_Core 
{
	public function indexAction() {
		$url_parameters = routes::getInstance()->_pathInfoArray;
		
		if(count($url_parameters) == 1)
			$this->galleryListing();
		
		if (count($url_parameters) == 2)
	    {
			if(route::ifPermalinkExists($url_parameters[1]))
				$this->galleryAlbumImages($url_parameters[1]);
			else 
				$this->galleryListing();
		}
		
		if (count($url_parameters) > 2) 
			header('location: /gallery');
	}
	public function galleryListing() {
		$dataHandler = new dataHandler();
		$view = new view();
		$view->_XMLObj = $dataHandler->loadDataSimpleXML('Data/1_Website/Content/Pages/primary/gallery/data.xml');	
		require_once 'Project/Code/System/Photo_Library/album/albums.php';
		
		$albums = new albums();
		$albums->selectAlbumForGallery();
		
		$view->_set('array_of_albums', $albums->__get('array_of_albums'));
		$view->displayGalleryListing();
	}
	
	public function galleryAlbumImages($permalink) 
	{
		
		$dataHandler = new dataHandler();
		$view = new view();
		$view->_XMLObj = $dataHandler->loadDataSimpleXML('Data/1_Website/Content/Pages/primary/gallery/data.xml');	
		
		require_once 'Project/Code/System/Photo_Library/album/albums.php';
		require_once 'Project/Code/System/Photo_Library/image/images.php';
		
		$routeID = route::selectRouteId($permalink);
		$albumID = album::selectByRouteId($routeID);
		$albumTitle = album::selectAlbumTitleByRouteId($routeID);
		
		$images = new images();
		$images->__set('album_id',$albumID);
			
		$current_page = 1;
			
		if(isset($_GET['page'])) 
		{
			$current_page = $_GET['page'];
		}	
			
		$images->__set('posts_per_page', '16');
		$images->__set('current_page', $current_page);
		$images->selectByAlbum(true);	
			
		$number_of_pages = $images->__get('pages');
		$view->_set('array_of_images', $images->__get('array_of_images'));
		$view->_set('album_title', $albumTitle);
		$view->displayGalleryImages($number_of_pages, $current_page);
	}
}
?>