<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set("include_path", '/home/wae8911z2q9t/php:' . ini_get("include_path"));
$target_dir = '/home/wae8911z2q9t/TempFormFileDir';
$uploadOk = 1;



if (isset($_POST['submit'])) {
    $to = "create@terrabyte.solutions";
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
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
        require '/home/wae8911z2q9t/PHPMailerTest/vendor/autoload.php';

        //load form

        require '/home/wae8911z2q9t/PHPMailerTest/PHPmailer/src/Exception.php';
        require '/home/wae8911z2q9t/PHPMailerTest/PHPmailer/src/PHPMailer.php';
        require '/home/wae8911z2q9t/PHPMailerTest/PHPmailer/src/SMTP.php';

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
            $mail->addAddress('create@terrabyte.ca', 'TerraByte Solutions');     //Add a recipient
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
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
