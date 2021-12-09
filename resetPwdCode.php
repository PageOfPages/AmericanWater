<?php
// Initialize the session
session_start();
 
// Include config file
require_once "config.php";

 
// Define variables and initialize with empty values
$code = "";
$code_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if code is empty
    if(empty($_POST["code"])){
        $code_err = "Please enter the Reset Code sent to your email account.";
    } else{
        $code = $_POST["code"];
    }
    

    $hardcoded_code = "GH46jk99";
    if($code == $hardcoded_code)
    {
        // header("location: createNewPwd.php");
        header("location: reset-password.php");
    }
    else if (!$code_err == "Please enter the Reset Code sent to your email account.")
    {
        $code_err = "Incorrect Code. Please Try Again.";
    }

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
        <p>Enter Reset Code</p>

        <?php 
        if(!empty($code_err)){
            echo '<div class="alert alert-danger">' . $code_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="text" name="code" class="form-control"> 
                <span class="invalid-feedback"><?php echo $code_err; ?></span>
            </div>    
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enter">
            </div>
        </form>
    </div>
</body>
</html>


