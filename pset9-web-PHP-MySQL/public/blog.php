<?php

    require("../includes/config.php");
    
    query("SET NAMES UTF8");
    $rows = query("SELECT * FROM blog ORDER BY id DESC");
    
    if ($rows === FALSE)
    {
        apologize("Не змог злучыцца з дата-базай.");
    }
    else
    {
        render("blog_form.php", ["rows" => $rows]);
    }
?>
