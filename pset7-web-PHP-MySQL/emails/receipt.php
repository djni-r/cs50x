<?php
    // configuration

    $hist = query("SELECT * FROM History WHERE id = ? AND datetime = ?", $_SESSION["id"], $datetime);
    $address = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"])[0]["email"];
    
    $subject = 'CS50 Finance RECEIPT';
    $body = 
    "<html><head><title>CS50 Finance RECEIPT</title></head>
    <body>
    <p>---------- Date & Time: " . $hist[0]["datetime"] . "</p>
    <p>---------- Transaction: " . $hist[0]["transaction"] . "</p>
    <p>---------- Stock Symbol: " . $hist[0]["symbol"] . "</p>
    <p>---------- Price: $" . $hist[0]["price"] . "</p>
    <p>---------- Shares: " . $hist[0]["shares"] . "</p>
    <p>---------- Total: $" . $hist[0]["total"] . "</p>
    </body></html>"    
?>
