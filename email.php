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
$new_address = $new_city = $new_zip = $new_state = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty($_POST["email"])){
        $email_err = "Please enter a valid email.";
    } else{
        $email = $_POST["email"];
    }

    
    if(empty($email_err))
    {
        $account_found = false;

        $sql = "SELECT personID, email FROM emails WHERE personID = '". $_SESSION["id"]."'";
        $result = mysqli_query($link, $sql);

        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $email)
            {
                $account_found = true;
            }

        }
        

        if ($account_found)
        {
            $user_address = $_SESSION["address"];
            $user_city = $_SESSION["city"];
            $user_state = $_SESSION["state"];
            $user_zip = $_SESSION["zip"];

            $message = "Your address has been updated! Please click the following link to confirm the changes below: http://localhost/WaterAmerica/NewAddresslogin.php \n\n\n\nAddress: {$user_address} \n\n\n\nCity: {$user_city} \n\n\n\nState: {$user_state} \n\n\n\nZip Code: {$user_zip}";
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '587';
            $mail->IsHTML();
            $mail->Username = 'testemailforcodingprojects@gmail.com';
            $mail->Password = 'TestEmail';
            $mail->Subject = 'Updated Address Confirmation';
            $mail->Body = $message;
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
                header("location: waitingPage.php");
            }
        }
        else 
        {
            $email_err = "The email you have entered is not recorded in our systems. Please try another email.";
        }
    }
    
    
        
    

    // // Validate credentials
    // $to = $email;
    // $subject = 'Updated Adress Confirmation';
    // $message = 'Your address has been updated'; 
    // $from = 'paige.c.a.arnold@icloud.com';
    
    // // Sending email
    // if(mail($to, $subject, $message)){
    //     header("location: accountInfo.php");
    // } else{
    //     echo 'Unable to send email. Please try again.';
    // }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <p>Enter Email to be sent Confirmation of Changes</p>

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
                <input type="submit" class="btn btn-primary" value="Send Email">
            </div>
        </form>
    </div>
</body>
</html>


