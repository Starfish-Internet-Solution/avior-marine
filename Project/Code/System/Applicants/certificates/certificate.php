<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class certificate
{
	private $certificate_id;
	private $certificate_name;
	
	public function getCertificateId()
	{
		return $this->certificate_id;
	}
	
	public function setCertificateId($certificate_id)
	{
		$this->certificate_id = $certificate_id;
	}
	
	//--------------------------------------------------------------------------------------------------
	
	public function getCertificateName()
	{
		return $this->certificate_name;
	}
	
	public function setCertficateName($certificate_name) 
	{
		$this->certificate_name = $certificate_name;
	}
	
	//----------------------------------------------------------------------------------------------------
	
	
}
?>