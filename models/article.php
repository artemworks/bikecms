<?php

class Article
{

	private $connection;
	private $db_table = "articles";

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
		$query = "SELECT * FROM " . $this->db_table . " ORDER BY posted DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

  public function readByPage($from_record_num, $records_per_page){

    $query = "SELECT *
          FROM " . $this->db_table . "
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
      $query = "SELECT COUNT(*) as total_rows FROM " . $this->db_table . "";

      $stmt = $this->connection->prepare($query);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      return $row['total_rows'];
  }

	public function getArticlesSortedIdDesc()
	{
		$query = "SELECT * FROM " . $this->db_table . " ORDER BY article_id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getArticleByUrl($title_url)
	{

		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE title_url = :turl LIMIT 1");
		$stmt->execute(array(':turl' => $title_url));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

  public function getArticlesByDate($date)
  {

    $stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE DATE_FORMAT(posted, '%y-%m-%d') = DATE_FORMAT(:dt,'%y-%m-%d')");
    $stmt->execute(array(':dt' => $date));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

	public function getArticleById($article_id)
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE article_id = :aid LIMIT 1");
		$stmt->execute(array(':aid' => $article_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getLastArticles($number)
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " ORDER BY posted DESC LIMIT :num");
		$stmt->bindParam(':num', $number, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function count_views($views, $article_id) {

		$stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET views = :vw WHERE article_id = :aid");
		if( $stmt->execute(array(':vw' => $views, ':aid' => $article_id)) ){
			return true;
		}
		return false;
	}

	public function searchArticle($q)
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE title LIKE :searchTerm");
		$stmt->execute(array(':searchTerm' => '%'.htmlspecialchars(strip_tags($q)).'%'));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function addArticle($posted, $archiving, $title, $title_url, $description, $body, $cover, $user_id, $is_active)
	{

  		$stmt = $this->connection->prepare("INSERT INTO " . $this->db_table . " (posted, archiving, title, title_url, description, body, cover, user_id, is_active)
                                VALUES (:pos, :arc, :tit, :tiu, :des, :bod, :cov, :use, :ise)");

       $stmt->execute(array(
                      ':pos' => $posted,
                      ':arc' => $archiving,
                      ':tit' => $title,
                      ':tiu' => $title_url,
                      ':des' => $description,
                      ':bod' => $body,
                      ':cov' => $cover,
                      ':use' => $user_id,
                      ':ise' => $is_active)
                        );

		$article_id = $this->connection->lastInsertId();

		return $article_id;
	}

	public function delArticle($article_id){

		$stmt = $this->connection->prepare("DELETE FROM " . $this->db_table . " WHERE article_id = :aid");

		if( $stmt->execute(array( ':aid' => $article_id )) )
		{
			return true;
		}

		return false;
	}

	public function updateArticle($posted, $archiving, $title, $title_url, $description, $body, $cover, $user_id, $is_active, $views, $article_id)
	{

    	$stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET
                         posted = :pos,
                         archiving = :arc,
                         title = :tit,
                         title_url = :tiu,
                         description = :des,
                         body = :bod,
                         cover = :cov,
                         user_id = :uid,
                         is_active = :isa,
                         views = :vw
                         	    WHERE article_id = :aid");

    	if( $stmt->execute(array(
    				  ':pos' => $posted,
                      ':arc' => $archiving,
                      ':tit' => $title,
                      ':tiu' => $title_url,
                      ':des' => $description,
                      ':bod' => $body,
                      ':cov' => $cover,
                      ':uid' => $user_id,
                      ':isa' => $is_active,
                      ':vw' => $views,
                      ':aid' => $article_id)) )
		{
			return true;
		}
		return false;
	}

}

?>