<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class job
{
	private $job_id;
	private $job_control_number;
	private $title;
	private $description;
	private $is_published;
	private $date_published;
	private $last_insert_id;
	private $route_id;	
	private $permalink;	
	//--------------------------------------------------------------------------------------------------------
	
	public function setPermalink($permalink)
	{
		$this->permalink = $permalink;
	}
	
	public function getPermalink()
	{
		if($this->permalink != null)
		return $this->permalink;
		else
		return false;
	}	
//--------------------------------------------------------------------------------------------------------
	
	public function setJobID($job_id)
	{
		$this->job_id = $job_id;
	}
	
	public function getJobID()
	{
		if($this->job_id != null)
			return $this->job_id;
		else 
			return false;
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function setJobControlNumber($job_control_number)
	{
		$this->job_control_number = $job_control_number;
	}
	
	public function getJobControlNumber()
	{
		if($this->job_control_number != null)
			return $this->job_control_number;
		else
			return false;
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getTitle()
	{
		if($this->title != null)
			return $this->title;
		else
			return false;
	}
	
//--------------------------------------------------------------------------------------------------------
	public function setRouteId($route_id)
	{
		$this->route_id = $route_id;
	}
	
	public function getRouteId()
	{
		if($this->route_id != null)
		return $this->route_id;
		else
		return false;
	}
//--------------------------------------------------------------------------------------------------------
	
	public function setDescription($description)
	{
		$this->description = $description;
	}
	
	public function getDescription()
	{
		if($this->description != null)
			return $this->description;
		else
			return false;
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function setIsPublished($is_published)
	{
		$this->is_published = $is_published;
	}
	
	public function getIsPublished()
	{
		
		if($this->is_published != null)
			return $this->is_published;
		else
			return false;
	}

//--------------------------------------------------------------------------------------------------------
	
	public function setDatePublished($date_published)
	{
		$this->date_published = $date_published;
	}
	
	public function getDatePublished()
	{
		if($this->date_published != null)
			return $this->date_published;
		else
			return false;
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function setLastInsertID($last_insert_id)
	{
		$this->last_insert_id = $last_insert_id;
	}
	
	public function getLastInsertID()
	{
		if($this->last_insert_id != null)
			return $this->last_insert_id;
		else
			return false;
	}
	
//--------------------------------------------------------------------------------------------------------
	
	
	public function insert()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "
						INSERT INTO
							`jobs`
							(
								`route_id`,
								`title`,
								`description`,
								`is_published`
							)
							VALUES
							(
								:route_id,
								:title,
								:description,
								:is_published
							)
					";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':title', $this->title, PDO::PARAM_STR);
			$pdo_statement->bindParam(':route_id', $this->route_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':description', $this->description, PDO::PARAM_STR);
			$pdo_statement->bindParam(':is_published', $this->is_published, PDO::PARAM_STR);
				
			$pdo_statement->execute();
	
			$this->last_insert_id = $pdo_connection->lastInsertId();
	
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function delete()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "										
					DELETE FROM
							jobs
						WHERE
							job_id = :job_id
								";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "SELECT * FROM
						jobs j
					INNER JOIN
						routes r
					ON
						j.route_id = r.route_id	
					WHERE
					(
						job_id	= :job_id
					OR
						permalink	= :permalink
					)	
					";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':permalink', $this->permalink, PDO::PARAM_STR);
			$pdo_statement->execute();
	
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
	
			$this->job_id 				= $result['job_id'];
			$this->route_id 			= $result['route_id'];
			$this->job_control_number 	= $result['job_control_number'];
			$this->title 				= $result['title'];
			$this->description 			= $result['description'];
			$this->is_published			= $result['is_published'];
			$this->date_published		= $result['date_published'];
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	
	}

	
//--------------------------------------------------------------------------------------------------------
	
	public function update()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "UPDATE
						jobs
					SET
						title = :title,
						description = :description,
						date_published = :date_published
					WHERE
						job_id = :job_id
			";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':title', $this->title, PDO::PARAM_STR);
			$pdo_statement->bindParam(':description', $this->description, PDO::PARAM_STR);
			$pdo_statement->bindParam(':date_published', $this->date_published, PDO::PARAM_STR);
			$pdo_statement->execute();
				
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	
//--------------------------------------------------------------------------------------------------------

	public function updateOneColumn($column, $value)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "UPDATE
						jobs
					SET
						$column = '{$value}'
					WHERE
						job_id = :job_id
			";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->execute();
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	
	
	
}

?>