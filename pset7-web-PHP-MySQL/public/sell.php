<?php
	require("../includes/config.php");
	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
		// get the form up    
		render("sell_form.php", ["title" => "Sell"]);    
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		if (empty($_POST["symbol"]))
		{
			apologize("Please, enter stock symbol to sell");
		}
		else
		{
			// look up the stock
			if (!lookup($_POST["symbol"]))
			{
				apologize("Please, enter correct symbol");
			}

			// check whether user owns this stock
			$rows = query("SELECT * FROM Portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
			if (!$rows)
			{
				apologize("You do not own this stock");
			}
			else
			{
				// do the "selling"
				$stock = lookup($_POST["symbol"]);
				$datetime = date('m/d/y g:i:s A');
				$cash_add = $stock["price"] * $rows[0]["shares"]; 				
				if (query("UPDATE users SET cash = cash + ? WHERE id = ?", $cash_add, $_SESSION["id"]) !== false)
				{				
					// update the myphpadmin table
					if (query("DELETE FROM Portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]) !== false)
					{						
						query("INSERT INTO History (id, datetime, transaction, symbol, shares, price, total)
                            VALUES (?, ?, ?, ?, ?, ?, ?)", $_SESSION["id"], $datetime , "SELL", strtoupper($_POST["symbol"]), $rows[0]["shares"], $stock["price"], $cash_add); 
						sendemail("receipt.php", ["datetime" => $datetime]);
						render("sold.php", ["name" => $stock["name"], "symbol" => $_POST["symbol"]]);				
					}
					else
					{
					    // if didn't manage to update the table return the cash
						query("UPDATE users SET cash = cash - ? WHERE id = ?", $cash_add, $_SESSION["id"]);
						apologize("Something went wrong. Please, try again.");
					}				
				}
				else
				{
					apologize("Something went wrong. Please, try again.");
				}
			}
		}
	}	

?>
