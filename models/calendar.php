<?php

class Calendar
{

	private $connection;
	private $db_table = "c_items";

	public $event_id;
	public $event_datetime;
	public $event_title;
	public $event_description;
	public $event_location;
  public $event_link;
	public $cat_id;
	public $is_active;
  public $pageviews;

	public function __construct($db)
	{
		$this->connection = $db;
	}

	public function readAll()
	{
		$query = "SELECT * FROM " . $this->db_table .
				 " ORDER BY event_id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

  public function readByPage($from_record_num, $records_per_page){

    $query = "SELECT *
          FROM " . $this->db_table . "
          ORDER BY event_id DESC
                  LIMIT ?, ?";

      $stmt = $this->connection->prepare($query);

      $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
      $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

      $stmt->execute();

      return $stmt;
  }

	public function sumAll($column)
	{
		$query = "SELECT SUM(" . $column . ") as " . $column . " FROM " . $this->db_table;
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row["{$column}"];
	}

  public function count()
  {
      $query = "SELECT COUNT(*) as total_rows FROM " . $this->db_table . "";

      $stmt = $this->connection->prepare($query);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      return $row['total_rows'];
  }

	public function getEventById($event_id)
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE event_id = :eid LIMIT 1");
		$stmt->execute(array(':eid' => $event_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getCatById($event_id)
	{
		$stmt = $this->connection->prepare("SELECT *
			FROM " . $this->db_table . "
			LEFT JOIN c_categories
			ON c_items.cat_id=c_categories.cat_id
			WHERE event_id = :eid");
		$stmt->execute(array(':eid' => $event_id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

  public function count_views($pageviews, $event_id) {

    $stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET pageviews = :pv WHERE event_id = :eid");
    if( $stmt->execute(array(':pv' => $pageviews, ':eid' => $event_id)) ){
      return true;
    }
    return false;
  }

  public function searchEvent($q)
  {
    $stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE event_title LIKE :searchTerm");
    $stmt->execute(array(':searchTerm' => '%'.htmlspecialchars(strip_tags($q)).'%'));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

	public function addEvent($event_datetime, $event_title, $event_description, $event_location, $event_link, $cat_id, $is_active, $pageviews){

        $stmt = $this->connection->prepare("INSERT INTO " . $this->db_table . " (trans_date, store, amount, tax, cat_id, is_active, pageviews)
                                VALUES (:edt, :ett, :eds, :eloc, :eli, :cid, :isa, :pgv)");

        $stmt->execute(array(
                      ':edt' => $event_datetime,
                      ':ett' => $event_title,
                      ':eds' => $event_description,
                      ':eloc' => $event_location,
                      ':eli' => $event_link,
                      ':cid' => $cat_id,
                      ':isa' => $is_active,
                      ':pgv' => $pageviews)
                        );

        $event_id = $this->connection->lastInsertId();

		return $event_id;
	}

	public function delEvent($event_id){

  		$stmt = $this->connection->prepare("DELETE FROM " . $this->db_table . " WHERE event_id = :eid");

		if( $stmt->execute(array( ':eid' => $event_id )) )
		{
			return true;
		}

		return false;
	}


	public function updateEvent($event_datetime, $event_title, $event_description, $event_location, $event_link, $cat_id, $is_active, $pageviews)
	{

        $stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET
                         event_datetime = :edt,
                         event_title = :ett,
                         event_description = :eds,
                         event_location = :elo,
                         event_link = :eli,
                         cat_id = :cid,
                         is_active = :isa,
                         pageviews = :pgv
                         WHERE event_id = :eid");

		if( $stmt->execute(array(':edt' => $event_datetime, ':ett' => $event_title, ':eds' => $event_description, ':elo' => $event_location, 'eli' => $event_link, ':cid' => $cat_id, ':isa' => $is_active, ':eid' => $event_id, ':pgv' => $pageviews)) )
		{
			return true;
		}
		return false;
	}

}

?>