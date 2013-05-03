<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once "job.php";

class jobs
{
	private $array_of_jobs = array();
	
	public function getArrayOfJobs()
	{
		if(count($this->array_of_jobs) > 0)
			return $this->array_of_jobs;
		else
			return false;
	}
	
	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "
					SELECT 
						`job_id`,
						`title`,
						`job_control_number`,
						`description`,
						`is_published`,
						`date_published`,
						`permalink`
					FROM
						jobs j
					INNER JOIN
						routes r
					ON
						j.route_id = r.route_id 							
			";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			
			$results = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
			
			foreach($results as $result)
			{
				$job = new job();
				$job->setJobID($result->job_id);
				$job->setPermalink($result->permalink);
				$job->setTitle($result->title);
				$job->setJobControlNumber($result->job_control_number);
				$job->setDescription($result->description);
				$job->setIsPublished($result->is_published);
				$job->setDatePublished($result->date_published);
				
				$this->array_of_jobs[] = $job;
			}
			
			
		}
		catch(PDOException $e)
		{
			throw new Exception($e);
		}	
	
	}
	
	public function selectByFilter($like = null, $date = null)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "
						SELECT 
							*
						FROM
							jobs
						WHERE 	
				";
			
			if($like != null && $date != null)
				$sql .= "  $like[0] LIKE '%$like[1]%'   AND  date_format(date_published, '%Y-%m-%d') = date_format('$date', '%Y-%m-%d')";
			elseif($like == null && $date != null)
				$sql .= " date_format(date_published, '%Y-%m-%d') = date_format('$date', '%Y-%m-%d') ";
			elseif($date == null &&  $like != null )
				$sql .= "$like[0] LIKE '%$like[1]%' ";
			
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
				
			$results = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
				
			foreach($results as $result)
			{
				$job = new job();
	
				$job->setJobID($result->job_id);
				$job->setTitle($result->title);
				$job->setJobControlNumber($result->job_control_number);
				$job->setDescription($result->description);
				$job->setIsPublished($result->is_published);
				$job->setDatePublished($result->date_published);
	
				$this->array_of_jobs[] = $job;
			}
				
		}
		catch(PDOException $e)
		{
			throw new Exception($e);
		}
	
	}
	
	
	
}

?>