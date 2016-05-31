<?php

    require("../includes/config.php");
    
    $dir = "uploads/";
    
    // Open a directory, and read its contents
    if (is_dir($dir))
    {
        if ($dh = opendir($dir))
        {  
            $images = [];
            for ($i = 0; false !== ($file = readdir($dh));)
            {
                $ffile = $dir . $file;
                if (!is_readable($ffile))
                {
                    continue;
                }
                
                $ftype = mime_content_type($ffile);
                
                if ( $ftype == "image/jpeg" 
                    or $ftype == "image/gif" 
                    or $ftype == "image/png")
                { 
                    $images[$i] = $ffile;
                    $i++;
                }
            }
            closedir($dh);
            

            render("gallery_form.php", ["images" => $images]);

        }
        else
        {
            apologize("Выбачайце, не магу адчыніць галерэю.");
        }
    }
    else
    {
        apologize("Выбачайце, галерэі няма.");
    }
?>
