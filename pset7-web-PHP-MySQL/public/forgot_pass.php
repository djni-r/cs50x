<?php
    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("forgot_pass_form.php", ["title" => "Forgot Password"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["email"]))
        {
            apologize("You must provide your e-mail.");
        }
        else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
        {
            apologize("Please, provide valid email"); 
        }

        // query database for user
        $rows = query("SELECT * FROM users WHERE email = ?", $_POST["email"]);

        // if we found user, send email
        if (count($rows) == 1)
        {
            if (sendemail("pass_reset.php", ["id" => $rows[0]["id"], "address" => $_POST["email"]]))
                render("emailsent.php");
            else
                apologize("The e-mail could not be sent. Please, try again");
        }
        // else apologize
        else
        {
            apologize("User with such e-mail is not registered");
        }
    }

?>
