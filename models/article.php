<?php

class Article
{

	private $connection;
	private $db_table = "article";

	public $article_id;
	public $posted;
	public $archiving;
	public $title;
	public $title_url;
	public $description;
	public $body;
	public $cover;
	public $user_id;
	public $is_active;
	public $views;
	
	function __construct($db)
	{
		$this->connection = $db;
	}

	public function readAll()
	{
		$query = "SELECT * FROM " . $this->db_table . 
				 " ORDER BY posted DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getArticleByUrl($title_url) {
		
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE title_url = :turl LIMIT 1");
		$stmt->execute(array(':turl' => $title_url));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function count_views($views, $article_id) {

		$stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET views = :vw WHERE article_id = :aid");
		if( $stmt->execute(array(':vw' => $views, ':aid' => $article_id)) ){
			return true;
		}
		return false;
	}

}

?>