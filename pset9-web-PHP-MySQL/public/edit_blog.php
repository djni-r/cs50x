<?php

    // configuration
    require("../includes/config.php"); 
    
    // to read Belarusian
    query("SET NAMES UTF8"); 
     
    //var_dump($_SERVER);
    // if reached by link    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $result = query("SELECT * FROM blog WHERE id = ?", $_GET["q"]);
        
        if (count($result) == 1)
        {
            render("edit_blog_form.php", ["hvalue" => $result[0]["header"], "bvalue" => $result[0]["body"], "qvalue" => $result[0]["question"], "idvalue" => $result[0]["id"]]);
        }
        else
        {
            apologize("Выбачайце, здарылася памылка. Паспрабуйце зноў");
        }
    }    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        var_dump($_POST);
        if (query("UPDATE blog SET header = ?, body = ?, question = ? WHERE id = ?", $_POST["header"], $_POST["body"], $_POST["question"], $_POST["id"]) === FALSE)
        {
            apologize("Тэкст не быў выпраўлены па тэхнічных прычынах.");
        }
        else
        {
            redirect("blog.php");  
        }
    }      
    
?>
