<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class skill
{
	private $skill_id;
	private $skill_name;
	
	public function getSkillId()
	{
		return $this->skill_id;
	}
	
	public function setSkillId($skill_id)
	{
		$this->skill_id = $skill_id;
	}
	
	//--------------------------------------------------------------------------------------------------
	
	public function getSkillName()
	{
		return $this->skill_name;
	}
	
	public function setSkillName($skill_name) 
	{
		$this->skill_name = $skill_name;
	}
	
	//----------------------------------------------------------------------------------------------------
	
	
}
?>