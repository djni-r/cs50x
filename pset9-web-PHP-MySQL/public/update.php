<?php
    
    require("../includes/config.php");
    
    if (empty($_SESSION["id"]))
    {
        redirect("login.php");
    }
    
    // if page reached from outside by link
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("update_form.php");
    }
    // if page reached after using the post forms
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["header"]))
        {
            apologize("Увядзіце тэму");
        }
        else if (empty($_POST["body"]))
        {
            apologize("Увядзіце тэкст");
        }
        
        // to read Belarusian
        //query("SET NAMES UTF8");

        // insert news into database
        if (query("INSERT INTO news (header, body, date) VALUES (?, ?, ?)", $_POST["header"], $_POST["body"], date("Y-m-d")) === FALSE)
        {
            apologize("Прабачце, але навіна не была дададзена па тэхнічных прычынах");
        }
        else
        {
            redirect("index.php");
        }
    }
?>
