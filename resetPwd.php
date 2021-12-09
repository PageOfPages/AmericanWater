<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');
require_once('PHPMailer/src/Exception.php');

 
// Define variables and initialize with empty values
$email = "";
$email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty($_POST["email"])){
        $email_err = "Please enter a valid email.";
    } else{
        $email = $_POST["email"];
    }
    

    $mail = new PHPMailer\PHPMailer\PHPMailer();    // $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    // $mail->SMTPDebug = 2;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->IsHTML();
    $mail->Username = 'testemailforcodingprojects@gmail.com';
    $mail->Password = 'TestEmail';
    // $mail->SetFrom('no-reply@testEmail.org');   // Gmail does not allow you to change this feild
    $mail->Subject = 'Reset Water America Password';
    $mail->Body = 'Reset Code: GH46jk99';
    $mail->AddAddress($email);


    if(!$mail->Send())
    {
        if ($email_err == "")
        {
            $email_err = "Mailer Error: " . $mail->ErrorInfo;
        }
    }
    else
    {
        header("location: resetPwdCode.php");
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <p>Enter Email Address</p>

        <?php 
        if(!empty($email_err)){
            echo '<div class="alert alert-danger">' . $email_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="text" name="email" class="form-control"> 
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Reset Password">
            </div>
        </form>
    </div>
</body>
</html>


