<?php
    require("../includes/config.php");
    
    if (query("DELETE FROM blog WHERE id=?", $_GET["q"]) === FALSE)
    {
        apologize("Навіна не выдалена па тэхнічных прычынах.");
    }
    else
    {
        redirect("blog.php");
    }
?>