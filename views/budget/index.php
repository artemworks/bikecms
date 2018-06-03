<div class="row">
	<div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 order-lg-1 order-md-1 order-sm-12">

		<p>
			<form>
				<div class="form-row align-items-center">
					<label for="selectMonth" class="col-sm-3 col-form-label">Choose month:</label>
					<div class="col-sm-9">
					<select name="month" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
						<option value="">Select...</option>
					  <?php
					    foreach ($m_list as $el) {
					      echo "<option value='" . DIR_URL . "budget/" . date( 'm-Y', strtotime($el) ) . "'>" . $el . "</option>";
					    }
					  ?>
					</select>
					</div>
				</div>
		</form>
		</p>

		<p>
			Total household expenses for <b><?= $monthStr . ", " . $year ?> </b>: $
			<b><span class="badge badge-secondary" style="font-size: 1.1em;"><?= number_format($sum_amount, 2, ".", ",") ?></span></b>, incl. HST: $
			<b><span class="badge badge-secondary" style="font-size: 1.1em;"><?=number_format($sum_tax, 2, ".", ",") ?></span></b>
		</p>


		<table class="table-budget table-bordered table-hover">
		<thead>
			<tr class="table-secondary">
				<td>Date</td>
				<td>Store</td>
				<td>Category</td>
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
						$transaction["store"] . "</td><td><small>" . $purchase_cat->getCatById( $transaction["cat_id"] )["cat_title"]. "</small>" .
						"</td><td class='text-right'>" .
						number_format($transaction["amount"], 2, ".", ",") .
						"</td><td class='text-right'>" .
						number_format($transaction["tax"], 2, ".", ",") .
						"</td><td class='text-center'>";
						if($transaction["dropbox_url"] !== ""){
										echo "<a href='" . $transaction["dropbox_url"] . "' target='_blank'><i class='far fa-file-alt fa-sm'></i></a>";
								} else {
									echo "<i class='fas fa-times' style='color:Grey'></i>";
								}
						echo "</td></tr>";
				}
			}
		?>

		</table>

	</div>
	<div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 order-lg-12 order-md-12 order-sm-1">
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
		      labels: {
		      	inner: {
		      		hideWhenLessThanPercentage: 3
		      	},
		      	percentage: {
							color: "#ffffff",
							decimalPlaces: 0
						}
		      },
		      data: {
		        content: <?= json_encode($pie1, JSON_NUMERIC_CHECK) ?>
		      },
		      tooltips: {
		      	enabled: true,
		      	type: "placeholder",
		      	string: "{label}, $ {value}"
		      }
		    });
		    var pie2 = new d3pie("myPie2", {
		      header: {
		        title: {
		          text: "Breakdown by Category"
		        }
		      },
		      labels: {
		      	inner: {
		      		hideWhenLessThanPercentage: 3
		      	},
		      	percentage: {
							color: "#ffffff",
							decimalPlaces: 0
						}
		      },
		      data: {
		        content: <?= json_encode($pie2, JSON_NUMERIC_CHECK) ?>
		      },
		      tooltips: {
		      	enabled: true,
		      	type: "placeholder",
		      	string: "{label}, $ {value}"
		      }
		    });
		  </script>
	</div>
</div>

