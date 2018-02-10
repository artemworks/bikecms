<?php

class Purchase

{
	private $connection;
	private $table_name = "b_transactions";

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

	public function read()
	{
		$query = "SELECT trans_id, trans_date, store, amount, tax, cat_id, is_active  
					FROM " . $this->table_name . " 
					ORDER BY trans_date DESC";

		$stmt = $this->connection->prepare($query);

		$stmt->execute();

		return $stmt;

	}

}

?>