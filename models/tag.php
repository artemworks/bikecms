<?php

class Tag
{

	private $connection;
	private $db_table = "tag";

	public $tag_id;
	public $name;
	public $is_active;
	
	function __construct($db)
	{
		$this->connection = $db;
	}

	public function readAll()
	{
		$query = "SELECT * FROM " . $this->db_table . " ORDER BY tag_id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getTagById($tag_id) 
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE tag_id = :tid");
		$stmt->execute(array(':tid' => $tag_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getTagIdByUrl($name) 
	{
		$stmt = $this->connection->prepare("SELECT * FROM tag WHERE name = :name LIMIT 1");
		$stmt->execute(array(':name' => htmlspecialchars(strip_tags($name)) ));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function insertTags($article_id) {

		for ($i=0; $i < 9; $i++) { 
		    if ( !isset($_POST['tag_id'.$i]) ) continue;
		    $tag_id = $_POST['tag_id'.$i];

		    $stmt = $this->connection->prepare('INSERT INTO " . $this->db_table . " 
				(article_id, tag_id)
				VALUES (:aid, :tid)
		    	');
		    $stmt->execute(array(
		    	':aid' => $article_id,
		    	':tid' => $tag_id
		    	));
		}
	}

	public function getArticleTags($article_id) 
	{
		$stmt = $this->connection->prepare("SELECT * 
			FROM " . $this->db_table . " 
			LEFT JOIN tags 
			ON tag.tag_id=tags.tag_id 
			WHERE article_id = :aid");
		$stmt->execute(array(':aid' => $article_id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getArticlesForTag($tag_id) 
	{
		$stmt = $this->connection->prepare("SELECT * 
			FROM tags  
			LEFT JOIN article  
			ON tags.article_id=article.article_id 
			WHERE tag_id = :tid");
		$stmt->execute(array(':tid' => $tag_id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function addTag($name, $is_active){
  		
  		$stmt = $this->connection->prepare("INSERT INTO " . $this->db_table . " (name, is_active) VALUES (:nm, :isa) ");
		
		$stmt->execute(array(
                      ':nm' => $name,
                      ':isa' => $is_active)
                      );

		$tag_id = $this->connection->lastInsertId();

		return $tag_id;
	}

	public function delTag($tag_id){
  		
  		$stmt = $this->connection->prepare("DELETE FROM " . $this->db_table . " WHERE tag_id = :tid");

		if( $stmt->execute(array( ':tid' => $tag_id )) )
		{
			return true;
		}
		
		return false;
	}


	public function updateTag($name, $is_active, $tag_id){
  		
    	$stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET name = :nm, is_active = :isa WHERE tag_id = :tid");

		if( $stmt->execute(array( ':nm' => $name, ':isa' => $is_active, ':tid' => $tag_id)) )
		{
			return true;
		}	
		return false;
	}


}

?>