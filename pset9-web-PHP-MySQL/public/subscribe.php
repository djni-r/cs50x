<?php

    require("../includes/config.php");
    
    if (isset($_POST["email"]))
    {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            apologize("Няправільны імэйл адрас.");
        }
        
        if (query("INSERT INTO subscribers (email) VALUES (?)", $email) !== false)
        {
            if (sendemail($email, "Confirmation", "<p>Шаноўны падпісчык,</p><p>Цяпер Вы падпісаны на навіны парафіі Кірыла і Мятода ў Баранавічах.</p><p>У выпадку, калі адбылася памылка і Вы не падпісваліся, альбо калі Вы больш не хочаце атрымліваць нашыя навіны, Вы можаце адпісацца па гэтай спасылцы: <a href=\"https://ide50-makar-y.cs50.io/unsubscribe.php?q={$email}\">Адпісацца</a></p><p>З павагай,</p><p>Баранавіцкая парафія Святых Кірыла і Мятода</p>") !== false)
            {
                apologize("На Ваш адрас быў адасланы імэйл з пацверджаннем. Дзякуй за падпіску!");
            }
            else
            {
                if (query("DELETE FROM subscribers WHERE email = ?", $email) !== false)
                {
                    apologize("Выбачайце, імэйл з пацвярджэннем не мог быць адасланым, таму Ваш адрас не быў занесены ў спіс. Калі ласка, праверце Ваш адрас і паспрабуйце зноў.");
                }
            }
        }
        else
        {
            apologize("Выбачайце, альбо Вы ўжо падпісаны, альбо імэйл не быў дададзены па тэхнічных прычынах. Калі ласка, паспрабуйце пазней!");   
        }
    }
?>
