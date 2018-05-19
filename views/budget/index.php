<p>
	Total expenses: $
	<b><?= number_format($sum_amount, 2, ".", " ") ?></b>
	total HST: $
	<b> <?=number_format($sum_tax, 2, ".", " ") ?></b>
</p>

<p>
	Transactions:
</p>

<table class="table-budget table-bordered">
<thead>
	<tr>
		<td>Date</td>
		<td>Store</td>
		<td>Amount</td>
		<td>HST</td>
		<td>File</td>
	</tr>
</thead>

<?php
	foreach($transactions as $transaction)
	{
		if ( $transaction["is_active"] )
		{
			echo "<tr><td>" .
				DateTime::createFromFormat('Y-m-d H:i:s', $transaction["trans_date"])->format('M d, Y') .
				"</td><td>" .
				$transaction["store"] .
				"</td><td>" .
				$transaction["amount"] .
				"</td><td>" .
				$transaction["tax"] .
				"</td><td><a href='" .
				$transaction["dropbox_url"] .
				"' target='_blank'><i class='far fa-file-alt fa-sm'></i></a></td></tr>";
		}
	}
?>

</table>