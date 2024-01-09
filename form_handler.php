<?php
ini_set("include_path", '/home/wae8911z2q9t/php:' . ini_get("include_path"));

// include('index.php');
// phpinfo();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$target_dir = '/home/wae8911z2q9t/TempFormFileDir';
$uploadOk = 1;

function sanitize($input)
{
    return htmlspecialchars(trim($input));
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

debug_to_console("Pre-submit statement");
console_log("console_log pre submit");
console_log("submit: " . $_POST['submit']);
console_log("name" . $_POST['name']);
console_log("email" . $_POST['email']);
console_log("mesg" . $_POST['message']);

if (isset($_POST['submit'])) {
    debug_to_console("Post-submit statement");
    console_log("console_log post-submit");
    // Sanitize all the incoming data
    $sanitized = array_map('sanitize', $_POST);
    $to = "create@terrabyte.solutions";
    $name = $sanitized['name'];
    $email = $sanitized['email'];
    $message = $sanitized['message'];
    $subject = "WebForm submission from " . $name;
    $headers = "From: " . $email;
    $result = mail($to, $subject, $message, $headers);

    // Upload attachment file 
    if (!empty($_FILES["attachment"]["name"])) {

        // File path config 
        $fileName = basename($_FILES["attachment"]["name"]);
        $target_file = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        //Load Composer's autoloader
        require '/vendor/autoload.php';

        //load form

        require '/vendor/phpmailer/phpmailer/src/Exception.php';
        require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require '/vendor/phpmailer/phpmailer/src/SMTP.php';

        // Instantiation and passing [ICODE]true[/ICODE] enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'localhost'; //GoDaddy host server
            $mail->Username = 'create@terrabyte.solutions'; // SMTP username
            $mail->Password = '10010'; // SMTP password
            $mail->SMTPAuth   = false;
            $mail->Port = 25; // TCP port to connect to                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($email, (empty($name) ? 'Contact form' : $name));
            $mail->addAddress('create@terrabyte.solutions', 'TerraByte Solutions');     //Add a recipient
            $mail->addReplyTo($email, $name);


            //Attachments
            // Add attachment to email 
            if (!empty($target_file) && file_exists($target_file)) {
                $mail->addAttachment($target_file);         //Add attachments
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();
            $result = 'success';
            debug_to_console('Message has been sent with attachment');
        } catch (Exception $e) {
            debug_to_console("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
        debug_to_console("Post-attachment send");

        echo '<script type="text/javascript">
        window.location = "https://terrabyte.solutions";
        </script>';
        // if ($result) {
        //     echo '<script type="text/javascript">alert("Your Message was sent Successfully!");</script>';
        //     echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
        // } else {
        //     echo '<script type="text/javascript">alert("Sorry! Message was not sent, try again later.");</script>';
        //     echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
        // }
    }
    //mail with no attachment
    else {
        //Load Composer's autoloader
        require '/vendor/autoload.php';

        //load form

        require '/vendor/phpmailer/phpmailer/src/Exception.php';
        require '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require '/vendor/phpmailer/phpmailer/src/SMTP.php';

        // Instantiation and passing [ICODE]true[/ICODE] enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'localhost'; //GoDaddy host server
            $mail->Username = 'create@terrabyte.solutions'; // SMTP username
            $mail->Password = '10010'; // SMTP password
            $mail->SMTPAuth   = false;
            $mail->Port = 25; // TCP port to connect to                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($email, (empty($name) ? 'Contact form' : $name));
            $mail->addAddress('create@terrabyte.solutions', 'TerraByte Solutions');     //Add a recipient
            $mail->addReplyTo($email, $name);


            //Attachments
            // Add attachment to email 
            if (!empty($target_file) && file_exists($target_file)) {
                $mail->addAttachment($target_file);         //Add attachments
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();
            $result = 'success';
            debug_to_console('Message has been sent with no attachment');
        } catch (Exception $e) {
            debug_to_console("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
        debug_to_console("post-nonattachment send");
        echo '<script type="text/javascript">
        window.location = "https://terrabyte.solutions";
        </script>';
        // if ($result) {
        //     echo '<script type="text/javascript">window.location.hostname = window.location.hostname;</script>';
        //     echo '<script type="text/javascript">alert("Your Message was sent Successfully!");</script>';
        // } else {
        //     echo '<script type="text/javascript">window.location.hostname = window.location.hostname;</script>';
        //     echo '<script type="text/javascript">alert("Sorry! Message was not sent, try again later.");</script>';
        // }
    }
}
