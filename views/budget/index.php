<?php

	echo "<p>Total expenses: $ <b>" . number_format($sum_amount, 2, ".", " ") . "</b>, ";
	echo "total HST: $ <b>" . number_format($sum_tax, 2, ".", " ") . "</b></p>";

	echo '<table class="table-bordered">';
	while ($row = $transactions->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>" .
			DateTime::createFromFormat('Y-m-d H:i:s', $row["trans_date"])->format('M, d Y') . 
			"</td><td>" . 
			$row["store"] . 
			"</td><td>" . 
			$row["amount"] . 
			"</td><td>" . 
			$row["tax"] . 
			"</td></tr>";
	}
	echo '</table>';
?>