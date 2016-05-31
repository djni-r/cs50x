<?php
    require("../includes/config.php");
    
    if(isset($_POST["delete"]))
    {
        unlink($_POST["delete"]);
    }
    redirect("gallery.php");
?>