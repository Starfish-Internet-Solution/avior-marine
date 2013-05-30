<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'Project/Code/System/Applicants/certificates/certificate.php';

class certificates
{
	
	private $array_of_certificates = array();
	
	public function getCertificates()
	{
		return $this->array_of_certificates;
	}
	
	//-----------------------------------------------------------------------------------------
	
	public function select()
	{
		$pdo_connection = starfishDatabase::getConnection();
		$sql = "
				SELECT
					*
				FROM
					certificates
				";
		$pdo_statement = $pdo_connection->prepare($sql);
		$pdo_statement->execute();
		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($results as $result)
		{
			$certficate = new certificate();
			
			$certficate->setCertificateId($result['certificate_id']);
			$certficate->setCertficateName($result['certificate_name']);
			
			$this->array_of_certificates[] = $certficate;
		}
		
	}

}
?>