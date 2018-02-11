<?php

class Article

{
	private $connection;
	private $table_name = "article";

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
	
	public function __construct($db)
	{
		$this->connection = $db;
	}

	public function read()
	{
		$query = "SELECT *   
					FROM " . $this->table_name . " 
					ORDER BY article_id DESC";

		$stmt = $this->connection->prepare($query);

		$stmt->execute();

		return $stmt;

	}

	public function readByPage($from_record_num, $records_per_page){
	 
		$query = "SELECT *   
					FROM " . $this->table_name . " 
					ORDER BY article_id DESC
	                LIMIT ?, ?";
	 
	    $stmt = $this->connection->prepare($query);
	 
	    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
	    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
	 
	    $stmt->execute();
	 
	    return $stmt;
	}

	public function count()
	{
	    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
	 
	    $stmt = $this->connection->prepare($query);
	    $stmt->execute();
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
	    return $row['total_rows'];
	}

}

?>