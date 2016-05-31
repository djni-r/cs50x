<?php
	require("../includes/config.php");
	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
		// get the form up    
		render("buy_form.php", ["title" => "Buy"]);    
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		if (empty($_POST["symbol"]))
		{
			apologize("Please, enter stock symbol to buy");
		}
		else if (empty($_POST["shares"]))
		{
		    apologize("Please, specify a number of shares");
	    }
	    else if (!preg_match("/^\d+$/", $_POST["shares"]))
	    {
	        apologize("Please, enter a whole number of shares");
	    }
	    
	    // if everything is fine lookup the stock and remember time
	    $stock = lookup($_POST["symbol"]);
	    $datetime = date('m/d/y g:i:s A');
	    if ( $stock == false)
        {
            apologize("Please, enter correct symbol");
        }
	    else
	    {
			// get user information
			$user = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);	    
			
			// check whether there is enough money
			$cost = $stock["price"] * $_POST["shares"];
			$cash = $user[0]["cash"];    
			if ($cost > $cash)
			{
			    apologize("You have not enough cash");
		    }
		    // deduce cash
		    else if (query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]) !== false)
			{
	            // enter info into table
	            if (query("INSERT INTO Portfolio (id, symbol, shares) VALUES (?, ?, ?) 
	                    ON DUPLICATE KEY UPDATE shares = shares + VALUES (shares)", 
	                    $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"]) !== false)
                {
                    query("INSERT INTO History (id, datetime, transaction, symbol, shares, price, total)
                            VALUES (?, ?, ?, ?, ?, ?, ?)", $_SESSION["id"], $datetime, "BUY", strtoupper($_POST["symbol"]), $_POST["shares"], $stock["price"], $cost); 
                    
                    sendemail("receipt.php", ["datetime" => $datetime]);

                    render("bought.php", ["datetime" => $datetime, "shares" => $_POST["shares"], "name" => $stock["name"], "symbol" => $stock["symbol"]]);
                }
                else
                {
                    // if didn't manage to update table return the cash
                    query("UPDATE users SET cash = cash + ? WHERE id = ?", $cost, $_SESSION["id"]);
                    apologize("Something went wrong. You haven't bought anything");
                }
            }
            else
            {
                // if didn't manage to deduce cash
                apologize("Something went wrong. Please, try again");
            }
        }
    }
