<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/ResultCleaner/resultCleaner.php';
require_once 'article_image.php';

class article
{
	private $article_id;
	private $route_id;
	private $article_title;
	private $intro;
	private $brief;
	private $approach;
	private $what_we_did;
	private $status;
	private $date_created;
	private $date_updated;
	private $permalink;
	private $image_id;
	
	
	private $category_id;
	private $subcategory_id;
	
	private $image_path;
	private $tags;
	private $unix_timestamp;
//-------------------------------------------------------------------------------------------------	

	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function __set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	
//-------------------------------------------------------------------------------------------------

	public static function checkIfExists($article_type, $article_title)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						COUNT(article_title) as count
					FROM
						article a
					WHERE
						article_title = :article_title
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':article_title', $article_title, PDO::PARAM_STR);
				$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));
				
				return $result['count'];
	
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function selectPrevOrNextPostPermalink($order)
	{
		$sign = '<';
		$orderby = 'DESC';
		
		if($order == 'next')
		{
			$sign = '>';
			$orderby = 'ASC';
		}
		
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						permalink
					FROM
						article a
					INNER JOIN
						routes r
					ON
						a.route_id = r.route_id	
					WHERE
						UNIX_TIMESTAMP(date_created) {$sign} {$this->unix_timestamp}
					AND
						article_id <> {$this->article_id}
					ORDER BY
						date_created {$orderby}
					LIMIT 0, 1
					";

				$pdo_statement = $pdo_connection->query($sql);
				//$pdo_statement->bindParam(':article_type', $this->article_type, PDO::PARAM_STR);
				//$pdo_statement->bindParam(':date_created', $this->date_created, PDO::PARAM_INT);
				//$pdo_statement->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
				//$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));

				return $result['permalink'];
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function select()
	{
		
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						article_id,
						article_title,
						status,
						intro,
						image_id,
						date_created,
						permalink,
						r.route_id,
						DATE_FORMAT(date_created, '%M %e, %Y') as date_posted,
						UNIX_TIMESTAMP(date_created) as unix_posted
					FROM
						article a
					INNER JOIN
						routes r
					ON
						a.route_id = r.route_id	
					WHERE
					(
						article_id	= :article_id
					OR
						permalink	= :permalink
					)
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':permalink', $this->permalink, PDO::PARAM_STR);
				$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));

				$this->article_id		= $result['article_id'];
				$this->article_title	= $result['article_title'];
				$this->date_created		= $result['date_created'];
				$this->unix_timestamp	= $result['unix_posted'];
				$this->status			= $result['status'];
				$this->intro			= $result['intro'];
				$this->image_id 		= $result['image_id'];
				$this->permalink 		= $result['permalink'];
				$this->route_id			= $result['route_id'];
				/* 
				$article_image = new article_image();
				
				$image = $article_image->selectThumbnailByType($result['article_id'], 'gallery');
				$this->image_path = $article_image->__get('full_path');
				 */
				$image = new image();
				$image->__set('image_id', $result['image_id']);
				$image->selectFullPath();
				
				$this->image_path = $image->__get('full_path');
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
	//-------------------------------------------------------------------------------------------------
	
//-------------------------------------------------------------------------------------------------

	public function selectByDate($start_date, $end_date)
	{
		
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						article_id,
						article_title,
						status,
						intro,
						image_id,
						date_created,
						DATE_FORMAT(date_created, '%M %e, %Y') as date_posted,
						UNIX_TIMESTAMP(date_created) as unix_posted
					FROM
						article a
					WHERE
						date_created between '$start_date' and '$end_date'
					LIMIT 0,1
					";
			
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
				$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));
				

				$this->article_id		= $result['article_id'];
				$this->article_title	= $result['article_title'];
				$this->date_created		= $result['date_created'];
				$this->unix_timestamp	= $result['unix_posted'];
				$this->status			= $result['status'];
				$this->intro			= $result['intro'];
				$this->image_id 		= $result['image_id'];

				$article_image = new article_image();
				
				$image = $article_image->selectThumbnailByType($result['article_id'], 'gallery');
				$this->image_path = $article_image->__get('full_path');
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
	
//-------------------------------------------------------------------------------------------------
	
	public function selectFirst($is_article = TRUE)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			if(routes::getInstance()->getCurrentTopLevelURLName() == 'seafarers')
				$category_id = 2;
			elseif(routes::getInstance()->getCurrentTopLevelURLName() == 'csr-manager' || routes::getInstance()->getCurrentTopLevelURLName() == 'csr')
				$category_id = 1;
			elseif(routes::getInstance()->getCurrentTopLevelURLName() == 'faq' || routes::getInstance()->getCurrentTopLevelURLName() == 'frequently-asked-questions')
				$category_id = 3;
			
			if($is_article === TRUE)
				$sql = "SELECT
							article_id,
							a.route_id,
							article_title,
							intro,
							brief,
							approach,
							what_we_did,
							status,
							permalink,
							DATE_FORMAT(date_created, '%M %e, %Y') as date_posted
						FROM
							article a
						INNER JOIN
							routes r
						ON
							a.route_id = r.route_id
						WHERE
							a.category_id is null
						LIMIT 0,1";
			else
				$sql = "SELECT
							article_id,
							a.route_id,
							article_title,
							intro,
							brief,
							approach,
							what_we_did,
							status,
							permalink,
							DATE_FORMAT(date_created, '%M %e, %Y') as date_posted
						FROM
							article a
						INNER JOIN
							routes r
						ON
							a.route_id = r.route_id
						WHERE
							a.category_id = $category_id
						LIMIT 0,1";
			
			
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
				
			$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));
	
			$this->article_id		= $result['article_id'];
			$this->route_id			= $result['route_id'];
			$this->article_title	= $result['article_title'];
			$this->intro			= $result['intro'];
			$this->brief			= $result['brief'];
			$this->approach			= $result['approach'];
			$this->what_we_did		= $result['what_we_did'];
			$this->status			= $result['status'];
			$this->date_created		= $result['date_posted'];
			$this->permalink		= $result['permalink'];

			$article_image = new article_image();
			
			$image = $article_image->selectThumbnailByType($result['article_id'], 'gallery');
			$this->image_path = $article_image->__get('full_path');
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
			
			$sql = "
					INSERT INTO
						`article`
						(
							`route_id`,
							`category_id`,
							`subcategory_id`,
							`article_title`,
							`intro`,
							`status`,
							`date_created`
						)
						VALUES
						(
							:route_id,
							:category_id,
							:subcategory_id,
							:article_title,
							:intro,
							'unpublished',
							NOW()
						)
					";
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':route_id', $this->route_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':subcategory_id', $this->subcategory_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':article_title', $this->article_title, PDO::PARAM_STR);
				$pdo_statement->bindParam(':intro', $this->intro, PDO::PARAM_STR);
				$pdo_statement->execute();
				
				$this->article_id = $pdo_connection->lastInsertId();
				
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
			
			$sql = "
					UPDATE
						article
					SET
						`article_title`	= :article_title,
						`intro`			= :intro,
						`brief`			= :brief,
						`approach`		= :approach,
						`what_we_did`	= :what_we_did,
						`status`		= :status,
						`image_id`		= :image_id,
						`date_created`	= :date_created,
						`date_updated`	= NOW()
					WHERE
						`article_id`	= :article_id
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':article_title', $this->article_title, PDO::PARAM_STR);
				$pdo_statement->bindParam(':intro', $this->intro, PDO::PARAM_STR);
				$pdo_statement->bindParam(':brief', $this->brief, PDO::PARAM_STR);
				$pdo_statement->bindParam(':approach', $this->approach, PDO::PARAM_STR);
				$pdo_statement->bindParam(':what_we_did', $this->what_we_did, PDO::PARAM_STR);
				$pdo_statement->bindParam(':date_created', $this->date_created, PDO::PARAM_STR);
				$pdo_statement->bindParam(':status', $this->status, PDO::PARAM_INT);
				$pdo_statement->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':image_id', $this->image_id, PDO::PARAM_INT);
				
				$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public static function delete($article_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "DELETE FROM
						article
					WHERE
						article_id = :article_id
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':article_id', $article_id, PDO::PARAM_INT);
				$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
}