<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date and Time</th>
                <th>Transaction</th>
                <th>Symbol</th>
                <th>Shares</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
		    <?php foreach ($positions as $position): ?>
			<tr>
			    <td><?= $position["datetime"] ?> </td>
				<td><?= strtoupper($position["transaction"]) ?> </td>
 				<td><?= strtoupper($position["symbol"]) ?> </td>
				<td><?= $position["shares"] ?> </td> 
				<td>$<?= number_format($position["price"], 2) ?> </td>
				<td>$<?= number_format($position["total"], 2) ?> </td>
			</tr>
 		    <?php endforeach ?>
		</tbody>
	</table>
</div>
