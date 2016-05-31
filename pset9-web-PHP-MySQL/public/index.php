<?php

    // configuration
    require("../includes/config.php");
    
    // to read Belarusian
    //query("SET NAMES UTF8");
    
    $rows = [];
    // rows represent id, header, text, date (as [0] through [3])

    if(isset($_GET["newsid"]))
    {
        $rows = query("SELECT * FROM news WHERE id = ?", $_GET["newsid"]);
    }
    else if(isset($_GET["newsdate"]))
    {
        $rows = query("SELECT * FROM news WHERE date = ? ORDER BY id DESC", $_GET["newsdate"]);
    }
    else
    {
        $rows = query("SELECT * FROM news ORDER BY id DESC");   
    }
    
    if ($rows !== FALSE)
    {
        render("news.php", ["positions" => $rows]);
    }
?>
