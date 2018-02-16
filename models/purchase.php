<?php

class Purchase 
{

	private $connection;
	private $db_table = "b_transactions";

	public $trans_id;
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

	public function sumAll($column)
	{
		$query = "SELECT SUM(" . $column . ") as " . $column . " FROM " . $this->db_table;
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row["{$column}"];
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

	public function addTransaction($trans_date, $store, $amount, $tax, $cat_id, $is_active){
  		
        $stmt = $this->connection->prepare("INSERT INTO " . $this->db_table . " (trans_date, store, amount, tax, cat_id, is_active) 
                                VALUES (:tdt, :str, :amt, :tax, :cid, :isa)");

        $stmt->execute(array(
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


	public function updateTransaction($trans_date, $store, $amount, $tax, $cat_id, $is_active, $trans_id)
	{

        $stmt = $this->connection->prepare("UPDATE " . $this->db_table . " SET 
                         trans_date = :tdt, 
                         store = :str, 
                         amount = :amt, 
                         tax = :tax, 
                         cat_id = :cid, 
                         is_active = :isa 
                               WHERE trans_id = :tid");
  		
		if( $stmt->execute(array(':tdt' => $trans_date, ':str' => $store, ':amt' => $amount, ':tax' => $tax, ':cid' => $cat_id, ':isa' => $is_active, ':tid' => $trans_id)) )
		{
			return true;
		}	
		return false;
	}

}

?>