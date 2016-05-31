<?php

    // configuration
    require("../includes/config.php"); 
    
    // to read Belarusian
    //query("SET NAMES UTF8"); 
     
    // if reached by link    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        
        $result = query("SELECT * FROM news WHERE id = ?", $_GET["newsid"]);
        
        if (count($result) == 1)
        {
            render("edit_form.php", ["hvalue" => $result[0]["header"], "bvalue" => $result[0]["body"], "idvalue" => $result[0]["id"]]);
        }
        else
        {
            redirect("index.php");
        }
    }    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (query("UPDATE news SET header = ?, body = ? WHERE id = ?", $_POST["header"], $_POST["body"], $_POST["id"]) === FALSE)
        {
            apologize("Навіна не была выпраўлена па тэхнічных прычынах.");
        }
        else
        {
            redirect("index.php");  
        }
    }      
    
?>
