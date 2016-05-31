<?php

    /**
     * functions.php
     *
     * Computer Science 50
     * Final
     *
     * Helper functions.
     */

    require_once("constants.php");

    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Lookup bible readings from carkva-gazeta.by
     */
    function lookup($date_array)
    {
        if ($date_array["0"] < easter_date($date_array["year"]))
        {
            if (date("L", $date_array["0"]))
            {
                $id = (730 - getdate(easter_date($date_array["year"] - 1))["yday"]) % 365;
            }
            else
            {
                $id = (729 - getdate(easter_date($date_array["year"] - 1))["yday"]) % 364;
            }
        }
        else
        {
            $id = $date_array["yday"] - getdate(easter_date($date_array["year"] - 1))["yday"];
        }
        $month = $date_array["mon"];
        $day = $date_array["mday"];
        $year = $date_array["year"];
        $yearday = $date_array["yday"];
        
        $result_str1 = file_get_contents("http://carkva-gazeta.by/chytanne/chytanne.php?sv={$yearday}&year={$year}");
        $result_str1b = explode("<title>", $result_str1);
        $calendar["read_saints"] = explode("</title>", $result_str1b[1])[0];
        $calendar["read_saints"] . "\n";
        $result_str2 = file_get_contents("http://carkva-gazeta.by/chytanne/chytanne.php?id={$id}&year={$month}-{$year}&date={$day}");
        $result_str2b = explode("<title>", $result_str2);
        
        $calendar["read_day"] = explode("</title>", $result_str2b[1])[0];
        
        $calendar["read_day"] . "\n";
        
        $result_str3 = file_get_contents("http://carkva-gazeta.by/chytanne/sviatyja.php?date={$day}&month={$month}");
        $result_str3a = strstr($result_str3, "<meta name=\"title\" content=\"");
        $result_str3b = strstr($result_str3a, "<meta name=\"description\" content", TRUE);
        $calendar["saints"] = substr($result_str3b, 28, -3);
        

        // return stock as an associative array
        return [
            "read_saints" => $calendar["read_saints"],
            "read_day" => $calendar["read_day"],
            "saints" => $calendar["saints"]
        ];
    }
    

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);
            
            // lookup the calendar from web-site carkva-gazeta.by
            $date = getdate();
            $calendar = lookup($date);
            
            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");
            
            // render side
            //require("../templates/sider.php");

            // render footer
            require("../templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }
    
    function sendemail($address, $subject, $body)
    {
        // if template exists, render it
        // if (file_exists("../emails/$email"))
        // {
            // extract variables into local scope
            // extract($values);
            
        require("../includes/PHPMailer-master/PHPMailerAutoload.php");
            
        $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
        
        $mail->IsSMTP(); // telling the class to use SMTP
        
        try 
        {
            $mail->Host       = "mail.gmail.com";       // SMTP server
            $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
            $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
            $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
            $mail->Username   = "makarymalinouski@gmail.com";  // GMAIL username
            $mail->Password   = "AmbelabaK@mu78";            // GMAIL password
            //   $mail->AddReplyTo('name@yourdomain.com', 'First Last');
            $mail->AddAddress($address);
            //   $mail->SetFrom('name@yourdomain.com', 'First Last');
            //   $mail->AddReplyTo('name@yourdomain.com', 'First Last');
            $mail->Subject = $subject;
            // $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
            $mail->MsgHTML($body);
            //$mail->MsgHTML(file_get_contents('contents.html'));
            //   $mail->AddAttachment('images/phpmailer.gif');      // attachment
            //   $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
            $mail->Send();
        } 
        catch (phpmailerException $e) 
        {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }
    
    function translate_month($month)
    {
        $months_by = ["1" => "Студзеня", 
            "2" => "Лютага",
            "3" => "Сакавіка", 
            "4" => "Красавіка", 
            "5" => "Траўня", 
            "6" => "Чэрвеня", 
            "7" => "Ліпеня", 
            "8" => "Жніўня", 
            "9" => "Верасня", 
            "10" => "Кастрычніка", 
            "11" => "Лістапада", 
            "12" => "Снежня"
        ];
        return $months_by[$month];
    }

?>
