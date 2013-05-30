<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/modelSuperClass_Core/modelSuperClass_Core.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';


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
				$this->array_of_jobs[] = strtolower($xml_data->job_title_element);
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
			$image->__set('image_id', $xml_data->cover_photo->image_id);
			$image->selectFullPath();
			
			$this->array_of_images[] = '/Data/Images/'.$image->__get('full_path');
		}
		
		return $this->array_of_images;
	}
		
	//---------------------------------------------------------------------------------------------------------------------------------------
	
	private function buildDate($month, $day, $year)
	{
		$date = strtotime($month." ".$day.", ".$year);
		return date('Y-m-d', $date);
	}
	
	//---------------------------------------------------------------------------------------------------------------------------------------

	private function unsetToArray($array_of_keys, $original_array)
	{
		foreach($array_of_keys as $key)
			unset($original_array[$key]);
			
		return $original_array;
	}
	
	//---------------------------------------------------------------------------------------------------------------------------------------
	
	public function insertFirstPhase($applicant_id, $applicants_info)
	{
		
		$date_of_birth = $this->buildDate($applicants_info['month'], $applicants_info['day'], $applicants_info['year']);
		$available_date = $this->buildDate($applicants_info['available_month'], $applicants_info['available_date'], $applicants_info['available_year']);
		$applicants_info['date_of_birth']  = $date_of_birth;
		$applicants_info['available_date'] = $available_date;
		
		$unset_keys = array('phase', 'current_phase', 'month', 'day', 'year', 'action', 'available_month', 'available_year');
		$applicants_info = $this->unsetToArray($unset_keys, $applicants_info);
		
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "
							INSERT INTO
								applicants_info
								(
									applicant_id,
									first_name,
									middle_name,
									last_name,
									date_of_birth,
									place_of_birth,
									nationality,
									civil_status,
									height,
									weight,
									landline_number,
									mobile_number,
									email,
									address_manila,
									address_province,
									college,
									degree,
									year_graduated,
									tin_number,
									sss_number,
									philhealth_number,
									uniform,
									waist,
									shoes,
									rank_applied,
									vessel_type,
									available_date,
									expected_salary,
									comments
								)
							VALUES
								(
									:applicant_id,
									:first_name,
									:middle_name,
									:last_name,
									:date_of_birth,
									:place_of_birth,
									:nationality,
									:civil_status,
									:height,
									:weight,
									:landline_number,
									:mobile_number,
									:email,
									:address_manila,
									:address_province,
									:college,
									:degree,
									:year_graduated,
									:tin_number,
									:sss_number,
									:philhealth_number,
									:uniform,
									:waist,
									:shoes,
									:rank_applied,
									:vessel_type,
									:available_date,
									:expected_salary,
									:comments
								)	
						";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":applicant_id", $applicant_id, PDO::PARAM_INT);

		    foreach($applicants_info as $key => $value)
			{
				${$value} = $value;
				$pdo_statement->bindParam(":$key", ${$value}, PDO::PARAM_STR);
			} 
			
			$pdo_statement->execute();
			
		}
		catch(PDOException $e)
		{
			print $e->getMessage();
		}
	}
	
	public function insertSecondPhase()
	{
	
	}
	
	public function insertThirdPhase()
	{
		
	}
	
	public function insertFourthPhase()
	{
	
	}
	
	public function insertApplicant()
	{
		
	}
	
	public static function getDataType($value)
	{
		
	}
	
	
	
}
?>
