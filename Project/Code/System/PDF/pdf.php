<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class pdf
{
	private $pdf_id;
	private $filename;
	private $path;
	private $date_created;
	private $is_used;
	//-------------------------------------------------------------------------------------------------
	
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
	
	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
						*
					FROM
						pdf
					WHERE
						pdf_id = :pdf_id
					";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':pdf_id', $this->pdf_id, PDO::PARAM_INT);
			$pdo_statement->execute();
				
			$results = $pdo_statement->fetch(PDO::FETCH_ASSOC);
		
			foreach($results as $result => $value)
				$this->__set($result, $value);
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function insert()
	{
		try
		{
			$con = starfishDatabase::getConnection();
			$sql = "INSERT INTO
						pdf
					(
						`filename`,
						`path`
					)
					VALUES
					(
						:filename,
						:path
					)
			";
			
			$pdo_statement = $con->prepare($sql);
			$pdo_statement->bindParam(':filename', $this->filename, PDO::PARAM_STR);
			$pdo_statement->bindParam(':path', $this->path, PDO::PARAM_STR);
			$pdo_statement->execute();
			
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
	
	//-------------------------------------------------------------------------------------------------
	
	
	public static function delete($pdf_id)
	{
		try
		{
			$con = starfishDatabase::getConnection();
			$sql = "DELETE FROM
						pdf
					WHERE
						pdf_id = :pdf_id 
					";
			$pdo_statement = $con->prepare($sql);
			$pdo_statement->bindParam(':pdf_id', $pdf_id, PDO::PARAM_INT);
			return $pdo_statement->execute();
			
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
	
	//-------------------------------------------------------------------------------------------------
	
	public function updateOneColumn($column, $value)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "UPDATE
						pdf
					SET
						$column = $value
					WHERE
						pdf_id = :pdf_id
					";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':pdf_id', $this->pdf_id, PDO::PARAM_INT);
			$pdo_statement->execute();
	
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	
}
?>