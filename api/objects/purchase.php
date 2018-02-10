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

	public function readByPage($from_record_num, $records_per_page){
	 
		$query = "SELECT trans_id, trans_date, store, amount, tax, cat_id, is_active  
					FROM " . $this->table_name . " 
					ORDER BY trans_date DESC
	                LIMIT ?, ?";
	 
	    $stmt = $this->connection->prepare($query);
	 
	    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
	    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
	 
	    $stmt->execute();
	 
	    return $stmt;
	}

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