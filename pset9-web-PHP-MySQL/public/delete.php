<?php
    require("../includes/config.php");
    
    if (query("DELETE FROM news WHERE id=?", $_GET["newsid"]) === FALSE)
    {
        apologize("Навіна не выдалена па тэхнічных прычынах.");
    }
    else
    {
        redirect("index.php");
    }
?>
