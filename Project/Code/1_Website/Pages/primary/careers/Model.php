<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/modelSuperClass_Core/modelSuperClass_Core.php';

class model extends modelSuperClass_Core
{
	private $array_of_jobs;
	private $file_dir = 'Data/1_Website/Content/Pages/primary/careers';
	private $files = array('position1','position2','position3','position4','position5');	
	
	public function getPositions()
	{
		foreach ($this->files as $file)
		{
			$xml_data = simplexml_load_file($this->file_dir.'/'.$file.'.xml');
			$this->array_of_jobs[] = $xml_data->job_title_element;
		}
		return $this->array_of_jobs;
	}	
}
?>
