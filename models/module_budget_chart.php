<?php

class Chart
{
  function __construct($db)
  {
    $this->connection = $db;
  }

  public function pieChartDataByStore($monthNum, $year)
  {
    $query = "SELECT store,SUM(amount)
              FROM b_transactions
              WHERE MONTH(trans_date) = :mth AND YEAR(trans_date) = :yer
              GROUP BY store";
    $stmt = $this->connection->prepare($query);
    $stmt->execute(array(':mth' => $monthNum, ':yer' => $year));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultMod = [];

    foreach($result as $r){
      $resultMod[] = array("label" => $r["store"],
                      "value" => number_format($r["SUM(amount)"],2,'.',''));
    }
    return $resultMod;
  }
  public function pieChartDataByCategory($monthNum, $year)
  {
    $query = "SELECT b_transactions.cat_id,SUM(b_transactions.amount),b_categories.cat_title
                       FROM b_transactions
                       LEFT JOIN b_categories ON b_transactions.cat_id = b_categories.cat_id
                       WHERE MONTH(trans_date) = :mth AND YEAR(trans_date) = :yer
                       GROUP BY cat_id";
    $stmt = $this->connection->prepare($query);
    $stmt->execute(array(':mth' => $monthNum, ':yer' => $year));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultMod = [];

    foreach($result as $r){
      $resultMod[] = array("label" => $r["cat_title"],
                      "value" => number_format($r["SUM(b_transactions.amount)"],2,'.',''));
    }
    return $resultMod;
  }
}

?>