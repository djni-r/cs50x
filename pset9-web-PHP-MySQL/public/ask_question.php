<?php
    
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("ask_question_form.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        query("SET NAMES UTF8");
        if(query("INSERT INTO blog (question, date) VALUES (?, ?)", $_POST["question"], date("Y-m-d")) === FALSE)
        {
            apologize("Выбачайце. Тэхнічная памылка - паспрабуйце яшчэ раз.");
        }
        else
        {
            sendemail("makarymalinouski@gmail.com", "Question on the web-site", $_POST["question"]);
            apologize("Ваша пытанне адпраўлена. Заходзьце на блог, каб паглядзець адказ айца.");
        }
    }
    

?>
