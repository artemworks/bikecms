<?php

class Section
{

	private $connection;
	private $db_table = "section";

	public $section_id;
	public $name;
	public $page;
	public $title;
	public $description;
	public $rank;
	public $is_active;
	
	function __construct($db)
	{
		$this->connection = $db;
	}

	public function readAll()
	{
		$query = "SELECT * FROM " . $this->db_table . 
				 " ORDER BY rank ASC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getSectionById($section_id) 
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE section_id = :sid");
		$stmt->execute(array(':sid' => $section_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function insertSections($article_id) 
	{
		for ($i=0; $i < 9; $i++) { 
		    if ( !isset($_POST['section_id'.$i]) ) continue;
		    $section_id = $_POST['section_id'.$i];

		    $stmt = $this->connection->prepare('INSERT INTO " . $this->db_table . " 
				(article_id, section_id)
				VALUES (:aid, :sid)
		    	');
		    $stmt->execute(array(
		    	':aid' => $article_id,
		    	':sid' => $section_id
		    	));
		}
	}

	public function getArticleSections($article_id) 
	{
		$stmt = $this->connection->prepare("SELECT * 
			FROM " . $this->db_table . " 
			LEFT JOIN sections 
			ON section.section_id=sections.section_id 
			WHERE article_id = :aid");
		$stmt->execute(array(':aid' => $article_id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getArticlesForSection($section_id) 
	{
		$stmt = $this->connection->prepare("SELECT * 
			FROM sections 
			LEFT JOIN article  
			ON sections.article_id=article.article_id 
			WHERE section_id = :sid");
		$stmt->execute(array(':sid' => $section_id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

}

?>