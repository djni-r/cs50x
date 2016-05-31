<?php
    require("../includes/config.php");
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
		// get the form up    
		render("submit_stock_form.php", ["title" => "Quote"]);    
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		if (empty($_POST["symbol"]))
		{
			apologize("Please, enter stock symbol");
			redirect("quotes.php");
		}
		else
		{
			// look-up the the quote and return the result into stock
			$stock = lookup($_POST["symbol"]);
	
			if ($stock == false)
			{
				apologize("Symbol is incorrect, please try again.");
			}
			else
			{
				render("display_stock_form.php", ["name" => $stock["name"], "symb" => $stock["symbol"], "price" => $stock["price"]]);
			}
		}
	}
?>
