<?php

    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("post_blog_form.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        query("SET NAMES UTF8");
        if (query("INSERT blog (header, body, date) VALUES (?, ?, ?)", 
            $_POST["header"], $_POST["body"], date("Y-m-d")) === FALSE)
        {
            apologize("Не дадаў запіс па тэхнічных прычынах");
        }
        else
        {
            redirect("blog.php");
        }
    }


?>
