<?php

class Purchase
{

	private $connection;
	private $db_table = "b_transactions";

	public $trans_id;
  public $dropbox_url;
	public $trans_date;
	public $store;
	public $amount;
	public $tax;
	public $cat_id;
	public $is_active;

	public function __construct($db)
	{
		$this->connection = $db;
	}

	public function readAll()
	{
		$query = "SELECT * FROM " . $this->db_table .
				 " ORDER BY trans_id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

  public function readSortedByMonthYear($monthNum, $year)
  {
    $query = "SELECT * FROM " . $this->db_table .
         " WHERE MONTH(trans_date) = :mth AND YEAR(trans_date) = :yer
         ORDER BY trans_date DESC";
    $stmt = $this->connection->prepare($query);
    $stmt->execute(array(':mth' => $monthNum, ':yer' => $year));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

	public function sumAllInMonthYear($column, $monthNum, $year)
	{
		$query = "SELECT SUM(" . $column . ") as " . $column .
          " FROM " . $this->db_table .
          " WHERE MONTH(trans_date) = :mth AND YEAR(trans_date) = :yer";
		$stmt = $this->connection->prepare($query);
		$stmt->execute(array(':mth' => $monthNum, ':yer' => $year));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row["{$column}"];
	}

  public function getAllMonthAndYear()
  {
    $query = 'SELECT DATE_FORMAT(trans_date, "%M %Y") FROM b_transactions GROUP BY DATE_FORMAT(trans_date, "%M %Y") ORDER BY trans_date DESC';
    $stmt = $this->connection->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $arr = [];
    foreach ($result as $row) {
      foreach ($row as $key=>$value) {
        $arr[] = $value;
      }
    }
    return $arr;
  }

	public function getTransById($trans_id)
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE trans_id = :tid LIMIT 1");
		$stmt->execute(array(':tid' => $trans_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getCatById($trans_id)
	{
		$stmt = $this->connection->prepare("SELECT *
			FROM " . $this->db_table . "
			LEFT JOIN b_categories
			ON b_transactions.cat_id=b_categories.cat_id
			WHERE trans_id = :tid");
		$stmt->execute(array(':tid' => $trans_id));
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function addTransaction($dropbox_url, $trans_date, $store, $amount, $tax, $cat_id, $is_active){

        $stmt = $this->connection->prepare("INSERT INTO " . $this->db_table . " (dropbox_url, trans_date, store, amount, tax, cat_id, is_active)
                                VALUES (:dbu, :tdt, :str, :amt, :tax, :cid, :isa)");

        $stmt->execute(array(
                      ':dbu' => $dropbox_url,
                      ':tdt' => $trans_date,
                      ':str' => $store,
                      ':amt' => $amount,
                      ':tax' => $tax,
                      ':cid' => $cat_id,
                      ':isa' => $is_active)
                        );

        $trans_id = $this->connection->lastInsertId();

		return $trans_id;
	}

	public function delTransaction($trans_id){

  		$stmt = $this->connection->prepare("DELETE FROM " . $this->db_table . " WHERE trans_id = :tid");

		if( $stmt->execute(array( ':tid' => $trans_id )) )
		{
			return true;
		}

		return false;
	}


	public function updateTransaction($dropbox_url, $trans_date, $store, $amount, $tax, $cat_id, $is_active, $trans_id)
	{

        $stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET
                         dropbox_url = :dbu,
                         trans_date = :tdt,
                         store = :str,
                         amount = :amt,
                         tax = :tax,
                         cat_id = :cid,
                         is_active = :isa
                         WHERE trans_id = :tid");

		if( $stmt->execute(array(':dbu' => $dropbox_url, ':tdt' => $trans_date, ':str' => $store, ':amt' => $amount, ':tax' => $tax, ':cid' => $cat_id, ':isa' => $is_active, ':tid' => $trans_id)) )
		{
			return true;
		}
		return false;
	}


/*
  API Functions
*/



public function readByPage($from_record_num, $records_per_page){

    $query = "SELECT *
          FROM " . $this->db_table . "
          ORDER BY trans_date DESC
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

/*

  public function create()
  {
    $query = "INSERT INTO " . $this->table_name . "
          SET
          trans_date=:tdt, store=:str, amount=:amt, tax=:tax, cat_id=:cid, is_active=:isa
          ";

    $stmt = $this->connection->prepare($query);

    $this->trans_date=htmlspecialchars(strip_tags($this->trans_date));
    $this->store=htmlspecialchars(strip_tags($this->store));
    $this->amount=htmlspecialchars(strip_tags($this->amount));
    $this->tax=htmlspecialchars(strip_tags($this->tax));
    $this->cat_id=htmlspecialchars(strip_tags($this->cat_id));
    $this->is_active=htmlspecialchars(strip_tags($this->is_active));

    $stmt->bindParam(":tdt", $this->trans_date);
    $stmt->bindParam(":str", $this->store);
    $stmt->bindParam(":amt", $this->amount);
    $stmt->bindParam(":tax", $this->tax);
    $stmt->bindParam(":cid", $this->cat_id);
    $stmt->bindParam(":isa", $this->is_active);

    if( $stmt->execute() )
    {
      return true;
    }

    return false;

  }

  public function update()
  {
    $query = "UPDATE " . $this->table_name . "
          SET
          trans_date=:tdt, store=:str, amount=:amt, tax=:tax, cat_id=:cid, is_active=:isa
          WHERE
          trans_id = :tid";

    $stmt = $this->connection->prepare($query);

    $this->trans_id=htmlspecialchars(strip_tags($this->trans_id));
    $this->trans_date=htmlspecialchars(strip_tags($this->trans_date));
    $this->store=htmlspecialchars(strip_tags($this->store));
    $this->amount=htmlspecialchars(strip_tags($this->amount));
    $this->tax=htmlspecialchars(strip_tags($this->tax));
    $this->cat_id=htmlspecialchars(strip_tags($this->cat_id));
    $this->is_active=htmlspecialchars(strip_tags($this->is_active));

    $stmt->bindParam(":tid", $this->trans_id);
    $stmt->bindParam(":tdt", $this->trans_date);
    $stmt->bindParam(":str", $this->store);
    $stmt->bindParam(":amt", $this->amount);
    $stmt->bindParam(":tax", $this->tax);
    $stmt->bindParam(":cid", $this->cat_id);
    $stmt->bindParam(":isa", $this->is_active);

    if( $stmt->execute() )
    {
      return true;
    }

    return false;

  }

  public function delete()
  {
    $query = "DELETE FROM " . $this->table_name . " WHERE trans_id = ?";

    $stmt = $this->connection->prepare($query);

    $this->trans_id = htmlspecialchars(strip_tags($this->trans_id));

    $stmt->bindParam(1, $this->trans_id);

    if( $stmt->execute() )
    {
      return true;
    }

    return false;

  }



*/


}
?>