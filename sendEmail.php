<?php

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) 
    && isset($_POST['email']) 
    && isset($_POST['subject']) 
    && isset($_POST['body'])){

    $name=$_POST['email'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $body=$_POST['body'];

    require_once "PHPMailer/PHPMailer.php"; 
    require_once "PHPMailer/SMTP.php"; 
    require_once "PHPMailer/Exception.php"; 
    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->Username = "youremail@gmail.com";
    $mail->Password = "yourpassword";
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
    

    $mail->isHTML(true);    
    $mail->setFrom($email, $name);
    $mail->addAddress("youremail@gmail.com");    
    $mail->Subject = ("$email ($subject)");    
    $mail->Body = $body;

    if($mail->send()){
        $status = "Success";
        $response = "Email is sent";
    }else{
        $status = "Failed";
        $response = "Something is wrong: <br>". $mail->ErrorInfo;
    }
    exit(json_encode(array("status" => $status, "response" => $response)));
}

?>