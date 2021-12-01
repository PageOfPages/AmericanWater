<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";

 
// Define variables and initialize with empty values
$pwd = $conf_pwd = "";
$pwd_err = $conf_pwd_err = $match_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if new password is empty
    if(empty(trim($_POST["pwd"]))){
        $pwd_err = "Please enter a New Password.";
    } else{
        $pwd = trim($_POST["pwd"]);
    }

    // Check if confirm new password is empty
    if(empty(trim($_POST["conf_pwd"]))){
        $conf_pwd_err = "Please confirm your New Password.";
    } else{
        $conf_pwd = trim($_POST["conf_pwd"]);
    }
    
    if(($pwd == $conf_pwd) && ($pwd != ""))
    {
        header("location: login.php");
    }
    else if ($pwd != "" && $conf_pwd != "")
    {
        $match_err = "Passwords do not match. Please make sure that both passwords are the same.";
    }

    //need to update password in database

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

        <?php 
        if(!empty($match_err)){
            echo '<div class="alert alert-danger">' . $match_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Enter New Password</label>
                <input type="text" name="pwd" class="form-control <?php echo (!empty($pwd_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $pwd_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="conf_pwd" class="form-control <?php echo (!empty($conf_pwd_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $conf_pwd_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Reset Password">
            </div>
        </form>
    </div>
</body>
</html>


