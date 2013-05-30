<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class applicant
{
	private $applicant_id;
	private $date_applied;
	
	public function getApplicantId()
	{
		return $this->applicant_id;
	}
	
	public function setApplicantId($applicant_id)
	{
		$this->applicant_id = $applicant_id;
	}
	
	//--------------------------------------------------------------------------------------------------
	
	public function getDateApplied()
	{
		return $this->date_applied;
	}
	
	public function setDateApplied($date_applied) 
	{
		$this->date_applied = $date_applied;
	}
	
	//--------------------------------------------------------------------------------------------------
	
	public function insert()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "
					INSERT INTO
						applicants
						(
							date_applied
						)
					VALUES
						(
							NOW()
						)	
					";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			$this->applicant_id =  $pdo_connection->lastInsertId();
		}
		catch(PDOException $e)
		{
			print $e->getMessage();
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	
	
}
?>