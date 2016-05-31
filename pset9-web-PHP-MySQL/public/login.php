<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render form
        render("login_form.php", ["title" => "Log In"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("Калі ласка, увядзіце логін");
        }
        else if (empty($_POST["password"]))
        {
            apologize("Калі ласка, увядзіце пароль.");
        }

        // query database for user
        $rows = query("SELECT * FROM admin WHERE username = ?", $_POST["username"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (/*crypt(*/$_POST["password"]/*, $row["hash"])*/ == $row["hash"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];

                // redirect to portfolio
                redirect("index.php");
            }
            else
            {
                apologize("Няправільны пароль.");
            }
        }
        // else apologize
        else
        {
        apologize("Няправільны логін.");
        }
    }

?>
