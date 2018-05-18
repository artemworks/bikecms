<?php

class PurchaseCategory 
{

	private $connection;
	private $db_table = "b_categories";

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
				 " ORDER BY cat_id DESC";
		$stmt = $this->connection->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function getCatById($cat_id) 
	{
		$stmt = $this->connection->prepare("SELECT * FROM " . $this->db_table . " WHERE cat_id = :cid LIMIT 1");
		$stmt->execute(array(':cid' => $cat_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

}

?>