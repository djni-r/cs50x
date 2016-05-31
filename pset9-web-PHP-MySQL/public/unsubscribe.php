<?php

    require("../includes/config.php");
    
    if (isset($_GET["q"]))
    {
        $email = $_GET["q"];
        
        if (query("DELETE FROM subscribers WHERE email = ?", $email) !== false)
        {
            apologize("Ваш імэйл быў выдалены. Усяго найлепшага!");
        }
        else
        {
            apologize("Выбачайце, альбо імэйл не быў выдалены па тэхнічных прычынах. Калі ласка, паспрабуйце пазней!");   
        }
    }
    else
    {
        apologize("Выбачайце, здарылася памылка. Паспрабуйце зноў.");   
    }
?>
