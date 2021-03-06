<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class route
{
	private $route_id;
	private $permalink;
	private $page_id;
	
//-------------------------------------------------------------------------------------------------	

	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function __set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	
//-------------------------------------------------------------------------------------------------

	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
						*
					FROM
						routes r
					WHERE
						route_id = :route_id
					";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':route_id', $this->route_id, PDO::PARAM_INT);
			$pdo_statement->execute();
				
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
		
			$this->route_id		= $result['route_id'];
			$this->permalink	= $result['permalink'];
			$this->page_id		= $result['page_id'];
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------	
	public static function selectRouteId($permalink)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "SELECT
							route_id
						FROM
							routes r
						WHERE
							permalink = :permalink
						";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':permalink', $permalink, PDO::PARAM_INT);
			$pdo_statement->execute();
			
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
			
			return $result['route_id'];
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
		
//-------------------------------------------------------------------------------------------------

	public static function ifPermalinkExists($permalink)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
						COUNT(permalink) as count
					FROM
						routes r
					WHERE
						permalink = :permalink
					";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':permalink', $permalink, PDO::PARAM_INT);
			$pdo_statement->execute();
				
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
		
			return $result['count'];
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
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "INSERT INTO
						routes
						(
							permalink,
							page_id
						)
					VALUES
						(
							:permalink,
							:page_id
						)
					";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':permalink', $this->permalink, PDO::PARAM_STR);
			$pdo_statement->bindParam(':page_id', $this->page_id, PDO::PARAM_STR);
			$pdo_statement->execute();
				
			$this->route_id = $pdo_connection->lastInsertId();
				
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function update()
	{
		try 
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "UPDATE
						routes
					SET
						permalink	= :permalink
					WHERE
						route_id = :route_id
					";
			$pdo_statement = $pdo_connection->prepare($sql);
			//bindParam is used so that SQL inputs are escaped.
			//This is to prevent SQL injections!
			$pdo_statement->bindParam(':permalink', $this->permalink, PDO::PARAM_STR);
			$pdo_statement->bindParam(':route_id', $this->route_id, PDO::PARAM_STR);
			$pdo_statement->execute();
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function delete()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "DELETE FROM
						routes
					WHERE
						route_id = :route_id
					";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':route_id', $this->route_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
}
?>