<div class="row">
	<div class="col-md-6 col-xs-12">
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
						"</td>";
						if($transaction["dropbox_url"] !== ""){
										echo "<td><a href='" . $transaction["dropbox_url"] . "' target='_blank'><i class='far fa-file-alt fa-sm'></i></a></td>";
								} else {
									echo "<td style='color:Grey'><i class='fas fa-times'></i></td>";
								}
						echo "</tr>";
				}
			}
		?>

		</table>
	</div>
	<div class="col-md-6 col-xs-12">
		  <div id="myPie1"></div>
		  <div id="myPie2"></div>
		  <script src="<?= DIR_URL ?>assets/js/d3.min.js"></script>
		  <script src="<?= DIR_URL ?>assets/js/d3pie.min.js"></script>
		  <script type="text/javascript">
		    var pie1 = new d3pie("myPie1", {
		      header: {
		        title: {
		          text: "Breakdown by Store"
		        }
		      },
		      data: {
		        content: <?= json_encode($pie1, JSON_NUMERIC_CHECK) ?>
		      }
		    });
		    var pie2 = new d3pie("myPie2", {
		      header: {
		        title: {
		          text: "Breakdown by Category"
		        }
		      },
		      data: {
		        content: <?= json_encode($pie2, JSON_NUMERIC_CHECK) ?>
		      }
		    });
		  </script>
	</div>
</div>