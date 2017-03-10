<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
require_once('Course.php');
/*
Course::fetchCategoryid();
var_dump(Course::fetchcategoryid());
*/
$to      = 'mohamad.gamal.abdelhay@gmail.com';
$subject = 'Test134';
$message = 'lol';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

var_dump(mail($to, $subject, $message, $headers));
