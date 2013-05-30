<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'Project/Code/System/Applicants/skills/skill.php';


class skills
{
	
	private $array_of_skills = array();
	
	public function getSkills()
	{
		return $this->array_of_skills;
	}
	
	//-----------------------------------------------------------------------------------------
	
	public function select()
	{
		$pdo_connection = starfishDatabase::getConnection();
		$sql = "
				SELECT
					*
				FROM
					skills
				";
		$pdo_statement = $pdo_connection->prepare($sql);
		$pdo_statement->execute();
		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($results as $result)
		{
			$skill = new skill();
			
			$skill->setSkillId($result['skill_id']);
			$skill->setSkillName($result['skill_name']);
			
			$this->array_of_skills[] = $skill;
		}
		
	}

}
?>