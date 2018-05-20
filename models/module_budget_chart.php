<?php

class Chart
{
  function __construct($db)
  {
    $this->connection = $db;
  }

  public function pieChartDataByStore()
  {
    $query = "SELECT store,SUM(amount)
              FROM b_transactions
              GROUP BY store";
    $stmt = $this->connection->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultMod = [];

    foreach($result as $r){
      $resultMod[] = array("label" => $r["store"],
                      "value" => number_format($r["SUM(amount)"]));
    }
    return $resultMod;
  }
  public function pieChartDataByCategory()
  {
    $query = "SELECT b_transactions.cat_id,SUM(b_transactions.amount),b_categories.cat_title
                       FROM b_transactions
                       LEFT JOIN b_categories ON b_transactions.cat_id = b_categories.cat_id
                       GROUP BY cat_id";
    $stmt = $this->connection->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultMod = [];

    foreach($result as $r){
      $resultMod[] = array("label" => $r["cat_title"],
                      "value" => number_format($r["SUM(b_transactions.amount)"]));
    }
    return $resultMod;
  }
}

?>