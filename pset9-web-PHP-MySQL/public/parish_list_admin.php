<?php
    
    require("../includes/config.php");
   
    query("SET NAMES UTF8");
    
    $rows = query("SELECT * FROM parish");
    if( $rows === FALSE)
    {
        apologize("Не атрымалася злучыцца з базай.");
    }
    
    render("parish_list_admin_form.php", ["positions" => $rows]);
?>
