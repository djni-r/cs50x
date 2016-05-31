<?php

    // configuration
    require("../includes/config.php"); 
	
	// get the info from database
	$rows = query("SELECT * FROM History WHERE id = ?", $_SESSION["id"]); 		
	if ($rows !== false)
	{
		$positions = []; 
		foreach ($rows as $row) 
		{
		    $positions[] = [
		        "datetime" => $row["datetime"],
		        "transaction" => $row["transaction"],
		        "symbol" => $row["symbol"],
		        "shares" => $row["shares"],
		        "price" => $row["price"],
		        "total" => $row["total"]
	        ];
        }
        // render the template using the info
        render("history_form.php", ["positions" => $positions, "title" => "History"]);
    }
?>
        
