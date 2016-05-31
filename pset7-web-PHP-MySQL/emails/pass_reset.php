<?php

    $subject = 'C50 Finance Reset Password';
    $body = 
    "<html>
        <head><title>Reset Password</title></head>
        <body>
            <p>Hello,</p>
            <p>This e-mail has been sent, because CS50 Finance user registered with this e-mail has requested it.</p>
            <p>If you haven't requested it, disregard this e-mail.</p><br>
            <p>Please, follow this link within an hour to reset your password: </p>
            <p><a href=\"http://pset7/ch_pass.php?".date("YHz").$address.date("YHz").crypt($id)."\">Reset Password</a></p><br>
            <p>Best wishes,</p>
            <p>CS50 Finance</p>
        </body>
    </html>"
?>
