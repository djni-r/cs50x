
<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Symbol</th>
                <th>Name</th>
                <th>Shares</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
		    <?php foreach ($positions as $position): ?>
			<tr>
				<td><?= strtoupper($position["symbol"]) ?> </td>
 				<td><?= $position["name"] ?> </td>
				<td><?= $position["shares"] ?> </td> 
				<td>$<?= number_format($position["price"], 2) ?> </td>
				<td>$<?= number_format($position["total"], 2) ?> </td>
			</tr>
 		    <?php endforeach ?>
		    <tr>
			    <td><strong>Cash</strong></td><td></td><td></td><td></td>
			    <td><strong>$<?= number_format($cash, 2) ?></strong></td>
		    </tr>
		</tbody>
	</table>
</div>
