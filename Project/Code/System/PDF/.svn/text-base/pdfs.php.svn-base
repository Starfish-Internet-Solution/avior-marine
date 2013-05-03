<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'Project/Code/System/PDF/pdf.php';

class pdfs
{
	
	private $array_of_pdfs;
	
	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
	
		else return NULL;
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function __set($field, $value) {
		if(property_exists($this, $field)) $this->{$field} = $value;
	}
	
	//-------------------------------------------------------------------------------------------------
	
	
	public function selectPDFs($restrict = FALSE)
	{
		try
		{
			$con = starfishDatabase::getConnection();
			$sql = "SELECT
						*
					FROM
						pdf
					";
			
			if($restrict)
				$sql .= " WHERE is_used = 1";
			
			
			$pdo_statement = $con->prepare($sql);
			$pdo_statement->execute();
			$results =  $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
			
			$array_of_pdfs = array();
			foreach($results as $result)
			{
				$pdf = new pdf();
				$pdf->__set('date_created', $result['date_created']);
				$pdf->__set('filename', $result['filename']);
				$pdf->__set('path', $result['path']);
				$pdf->__set('pdf_id', $result['pdf_id']);
				$pdf->__set('is_used', $result['is_used']);
				$pdf->__set('pdf_id', $result['pdf_id']);
				
				$array_of_pdfs[] = $pdf;
			}
			
			return $array_of_pdfs;
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
}
?>