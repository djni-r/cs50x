<?php
    
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("parish_list_form.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["last-name"]))
        {
            apologize("Поле з прозвішчам абавязковае.");
        }
        else if (empty($_POST["first-name"]))
        {
            apologize("Поле з імём абавязковае.");
        }
        else if (empty($_POST["address"]))
        {
            apologize("Поле з адрасам абавязковае.");
        }
        
        query("SET NAMES UTF8");
        if (query("INSERT INTO parish (last_name, first_name, email, dob, address, phone1, phone2) VALUES (?, ?, ?, ?, ?, ?, ?)", 
            $_POST["last-name"], $_POST["first-name"], $_POST["email"], $_POST["dob"], $_POST["address"], $_POST["phone1"], $_POST["phone2"]) === FALSE)
        {
            apologize("Выбачайце, Ваша інфармацыя не дададзена па тэхнічных прычынах. Паспрабуйце яшчэ раз.");
        }
        else
        {
            redirect("index.php");
        }
    }

?>
