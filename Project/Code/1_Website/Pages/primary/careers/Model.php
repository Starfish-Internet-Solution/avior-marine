<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/modelSuperClass_Core/modelSuperClass_Core.php';

class model extends modelSuperClass_Core
{
	private $array_of_jobs;
	private $array_of_images;
	private $file_dir = 'Data/1_Website/Content/Pages/primary/careers/';
	private $files = array('quick_apply','online_application','position1','position2','position3','position4','position5','office_vacancies');
	
	public function getPositions()
	{
		foreach ($this->files as $file)
		{
			if(preg_match('/position/i', $file)){
				$xml_data = simplexml_load_file($this->file_dir.$file.'.xml');
				$this->array_of_jobs[] = strtolower(preg_replace('/ /', '-', $xml_data->job_title_element));
			}
		}
		return $this->array_of_jobs;
	}
	
	public function getImages()
	{
		require_once 'Project/Code/System/Photo_Library/image/image.php';
		$image = new image();
		
		foreach ($this->files as $file)
		{
			$xml_data = simplexml_load_file($this->file_dir.$file.'.xml');
			$image->__set('image_id', $xml_data->image_id);
			$image->selectFullPath();
			
			$this->array_of_images[] = '/Data/Images/'.$image->__get('full_path');
		}
		
		return $this->array_of_images;
	}
}
?>
