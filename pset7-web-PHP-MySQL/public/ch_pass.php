<?php
    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if ($_SERVER["QUERY_STRING"] != null) 
        {
            if (substr($_SERVER["QUERY_STRING"], 0, strlen(date("YHz"))) != date("YHz"))
            {
                redirect("login.php");
            }
            else
            {
                $keywords = explode(date("YHz"), $_SERVER["QUERY_STRING"]);
                $rows = query("SELECT * FROM users WHERE email = ?", $keywords[1]);
                if (count($rows) == 1 and crypt($rows[0]["id"], $keywords[2]) == $keywords[2])
                {
                    $_SESSION["id"] = $rows[0]["id"];
                }
                else
                {
                    redirect("login.php");
                }
            }
        }
        // else render form
        render("ch_pass_form.php", ["title" => "Change password"]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (empty($_POST["new_password"]))
        {
            apologize("Please, provide new password");
        }
        else if ($_POST["confirmation"] != $_POST["new_password"])
        {
            apologize("Passwords do not match");
        }
        // insert query and check if returned false (the username exists)
        else if (query("UPDATE users set hash = ? WHERE id = ?", crypt($_POST["new_password"]), $_SESSION["id"]) !== false)
        {
            render("changed_pass.php");
        }
        else
        {
            apologize("Could not change password");
        }
    }
