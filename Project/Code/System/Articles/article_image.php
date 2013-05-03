<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/ResultCleaner/resultCleaner.php';
require_once 'Project/Code/System/Photo_Library/image/image.php';

class article_image
{
	private $article_image_id;
	private $article_id;
	private $image_id;
	private $used_for;
	
	private $full_path;
	
	public function __construct()
	{
		$this->image_id = 1;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function __set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	
//-------------------------------------------------------------------------------------------------

	public function selectThumbnailByType($article_id, $used_for, $is_thumbnail = FALSE)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
						article_image_id,
						i.image_id,
						album_folder,
						dimensions,
						filename,
						filename_ext,
						used_for
					FROM
						article_images pi
					INNER JOIN
						images i
					ON
						pi.image_id = i.image_id
					INNER JOIN
						album_image_sizes s
					ON
						s.size_id = i.size_id
					INNER JOIN
						albums a
					ON
						s.album_id = a.album_id
					WHERE
						article_id = :article_id
					AND
						used_for = :used_for	
					";
				
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':article_id', $article_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':used_for', $used_for, PDO::PARAM_STR);
				$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));
				
				$thumbnail = '';
				
				if($is_thumbnail) $thumbnail = '_thumb';
				
				$full_path = $result['album_folder'].'/'.$result['dimensions'].$thumbnail.'/'.$result['filename'].$result['filename_ext'];
				
				
				$this->article_image_id	= $result['article_image_id'];
				$this->article_id		= $article_id;
				$this->image_id			= $result['image_id'];
				$this->used_for			= $result['used_for'];
				$this->full_path		= $full_path;
		}
		catch (PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	public function selectThumbnailPath($image_id)
	{
		$con = starfishDatabase::getConnection();
		$sql = "SELECT
						i.filename,
						i.filename_ext,
						a.album_folder,
						ais.dimensions
					FROM
						images i
					INNER JOIN
						albums a
					ON
						i.album_id = a.album_id
					INNER JOIN
						album_image_sizes ais
					ON
						i.size_id = ais.size_id
					WHERE
						i.image_id = :image_id
				";
		$pdo_statement = $con->prepare($sql);
		$pdo_statement->bindParam(":image_id", $image_id, PDO::PARAM_INT);
		$pdo_statement->execute();
		$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
		$thumbnail_path = "/Data/Images/{$result['album_folder']}/{$result['dimensions']}_thumb/{$result['filename']}{$result['filename_ext']}";
		return $thumbnail_path;
	}
	
//-------------------------------------------------------------------------------------------------

	public function insert()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "INSERT INTO
						article_images
						(
							article_id,
							image_id,
							used_for
						)
					VALUES
						(
							:article_id,
							:image_id,
							:used_for
						)
					";
			//var_dump($this); die;
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':article_id', $this->article_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':image_id', $this->image_id, PDO::PARAM_STR);
			$pdo_statement->bindParam(':used_for', $this->used_for, PDO::PARAM_STR);
			$pdo_statement->execute();
				
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
						article_images
					SET
						image_id = :image_id
					WHERE
						article_image_id = :article_image_id
					";
			$pdo_statement = $pdo_connection->prepare($sql);
			//bindParam is used so that SQL inputs are escaped.
			//This is to prevent SQL injections!
			$pdo_statement->bindParam(':image_id', $this->image_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':article_image_id', $this->article_image_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public static function delete($article_image_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "DELETE FROM
						article_images
					WHERE
						article_image_id = :article_image_id
					";

			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':article_image_id', $article_image_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
}
?>