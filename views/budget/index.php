<p>
	Total expenses: $ 
	<b><?= number_format($sum_amount, 2, ".", " ") ?></b>
	total HST: $ 
	<b> <?=number_format($sum_tax, 2, ".", " ") ?></b>
</p>

<p>
	Transactions:
</p>

<table class="table-bordered">

<?php
	foreach($transactions as $transaction) 
	{
		echo "<tr><td>" .
			DateTime::createFromFormat('Y-m-d H:i:s', $transaction["trans_date"])->format('M, d Y') . 
			"</td><td>" . 
			$transaction["store"] . 
			"</td><td>" . 
			$transaction["amount"] . 
			"</td><td>" . 
			$transaction["tax"] . 
			"</td></tr>";
	}
?>

</table>