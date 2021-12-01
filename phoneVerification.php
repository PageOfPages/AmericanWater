<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$phone = "";
$phone_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if phone is empty
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter a phone number.";
    } else{
        $phone = trim($_POST["phone"]);
    }
    

    // Validate credentials
    if(empty($phone_err)){
        $justNums = preg_replace("/[^0-9]/", '', $phone);
        if(strlen($justNums) == 10) {
            // $phone is valid
            header("location: accountInfo.php");
        }
        else {
            $phone_err = "Invalid phone.";
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Phone Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <p>Please enter phone number for verification</p>

        <?php 
        if(!empty($phone_err)){
            echo '<div class="alert alert-danger">' . $phone_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control"> 
                <span class="invalid-feedback"><?php echo $phone_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enter">
            </div>
        </form>
    </div>
</body>
</html>


