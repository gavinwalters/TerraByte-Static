<!-- form script -->

<?php
ini_set("include_path", '/home/wae8911z2q9t/php:' . ini_get("include_path"));

if (isset($_POST['submit'])) {
    $to = "create@terrabyte.solutions";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $file = $_POST['file'];
    $subject = "WebForm submission from " . $name;
    $headers = "From: " . $email;
    $result = mail($to, $subject, $message, $headers);

    if ($result) {
        echo '<script type="text/javascript">alert("Your Message was sent Successfully!");</script>';
        echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
    } else {
        echo '<script type="text/javascript">alert("Sorry! Message was not sent, try again later.");</script>';
        echo '<script type="text/javascript">window.location.href = window.location.href;</script>';
    }
}
