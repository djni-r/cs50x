<?php

    // configuration
    require("../includes/config.php"); 
	
	$rows = query("SELECT * FROM Portfolio WHERE id = ?", $_SESSION["id"]); 		
	if ($rows !== false)
	{
		$positions = []; 
		foreach ($rows as $row) 
		{
			$stock = lookup($row["symbol"]); 
			if ($stock !== false) 
			{
			    $positions[] = [
		        	"name" => $stock["name"],
		        	"price" => $stock["price"],
		        	"shares" => $row["shares"],
		    		"symbol" => $row["symbol"],
					"total" => $stock["price"]*$row["shares"]
			 	]; 
			}
		}
		$cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"])[0]["cash"];
		
		// render portfolio
		render("portfolio.php", ["positions" => $positions, "cash" => $cash, "title" => "Portfolio"]);
	}
?>
