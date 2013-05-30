<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'Project/Code/System/Applicants/applicant.php';

class applicants
{
	
	private $array_of_applicants = array();
	
	public function getApplicants()
	{
		return $this->array_of_applicants;
	}
	
	//-----------------------------------------------------------------------------------------
	
	public function select()
	{
		$pdo_connection = starfishDatabase::getConnection();
		$sql = "
				SELECT
					*
				FROM
					applicants
				";
		$pdo_statement = $pdo_connection->prepare($sql);
		$pdo_statement->execute();
		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($results as $result)
		{
			$applicant = new applicant();
			
			$applicant->setApplicantId($result['applicant_id']);
			$applicant->setDateApplied($result['date_applied']);
			
			$this->array_of_applicants = $applicant;
		}
		
	}

}
?>