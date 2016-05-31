<?php

    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("upload_form.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $target_file = "uploads/" . basename($_FILES["fileToUpload"]["name"]);
        
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"]))
        {
            if (getimagesize($_FILES["fileToUpload"]["tmp_name"]) === FALSE)
            {
                apologize("Файл не з'яўляецца сапраўднай выявай.");
            }               
        }
        
        // check if file already exists
        if (file_exists($target_file))
        {
            apologize("Файл ужо існуе.");
        }
        // check if file size is ok
        else if ($_FILES["fileToUpload"]["size"] > 500000)
        {
            apologize("Файл занадта вялікі.");
        }
        // Allow certain file formats
        else if ($imageFileType != "jpg" && $imageFileType != "png" && 
            $imageFileType != "jpeg" && $imageFileType != "gif")
        {
            apologize("Файл павінен быць у фармаце jpg, jpeg, png, альбо gif.");
        }
        // try to upload
        else if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            if (chmod($target_file, 0644))
            {
                redirect("gallery.php");    
            }
            else
            {
                apologize("Файл быў дададзены, але ён не атрымаў дазволу для прагляду. Калі ласка, дадайце зноў, альбо звярніцеся да адміністратара.");
            }
        }
        else
        {
            apologize("Адбылася памылка падчас дадавання файлу.");
        }
    }

?>
