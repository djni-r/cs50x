<?php
    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // validate
        if (empty($_POST["username"]))
        {
            apologize("Please, provide username");
        }
        else if (empty($_POST["email"])) 
        {
            apologize("Please, provide e-mail");
        } 
        // check if e-mail address is well-formed
        else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
        {
            apologize("Please, provide valid email"); 
        }
        else if (empty($_POST["password"]))
        {
            apologize("Please, provide password");
        }
        else if ($_POST["confirmation"] != $_POST["password"])
        {
            apologize("Passwords do not match");
        }
        // insert query and check if returned false (the username exists)
        else if (query("INSERT INTO users (username, email, hash, cash) VALUES(?, ?, ?, 10000.00)", 
            $_POST["username"], $_POST["email"], crypt($_POST["password"])) === false)
        {
            apologize("This username or e-mail already registered");
        }
        // login the new user
        else
        {
            $rows = query("SELECT LAST_INSERT_ID() AS id");
            $_SESSION["id"] = $rows[0]["id"];
            redirect("index.php");
        }
    }
?>
