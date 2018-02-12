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

	function getTransById($trans_id) 
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE trans_id = :tid LIMIT 1");
		$stmt->execute(array(':tid' => $trans_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

}

?>