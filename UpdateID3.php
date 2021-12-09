<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: phoneVerification.php");
//     exit;
// }
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_address = $new_city = $new_zip = $new_state = "";
$new_address_err = $new_city_err = $new_zip_err = $new_state_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if address is empty
    if(empty($_POST["new_address"])){
        $new_address_err = "Please enter a new address.";
    } else{
        $new_address = $_POST["new_address"];
    }
    
    // Check if city is empty
    if(empty($_POST["new_city"])){
        $new_city_err = "Please enter a new city.";
    } else{
        $new_city = $_POST["new_city"];
    }

    // Check if zip is empty
    if(empty($_POST["new_zip"])){
        $new_zip_err = "Please enter a new zip code.";
    } else{
        $new_zip = $_POST["new_zip"];
    }
    
    if(empty($_POST["new_state"])){
        $new_state_err = "Please select a state.";
    } else{
        $new_state = $_POST["new_state"];
    }



    if(empty($new_address_err) && empty($new_city_err) && empty($new_zip_err)){
        // Prepare an update statement
        $sql = "UPDATE accounts SET address = ?, City = ?, State = ?, Zip = ? WHERE id = ?";
        // "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_address, $param_city, $param_state, $param_zip, $param_id);
            
            // Set parameters
            // $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_address = $new_address;
            $param_city = $new_city;
            $param_state = $new_state; 
            $param_zip = $new_zip;
            $param_id = 3;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                header("location: adminSearch.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
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
    <title>Update Address</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- <h2>Login</h2>
        <p>Please fill in your credentials to login.</p> -->

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>New Address</label>
                <input type="text" name="new_address" class="form-control <?php echo (!empty($new_address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_address; ?>">
                <span class="invalid-feedback"><?php echo $new_address_err; ?></span>
            </div>    
            <div class="form-group">
                <label>New City</label>
                <input type="text" name="new_city" class="form-control <?php echo (!empty($new_city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_city; ?>">
                <span class="invalid-feedback"><?php echo $new_city_err; ?></span>
            </div> 
            <div class="form-group">
                <label>New State</label>
                <select class="form-control" name="new_state" <?php echo (!empty($new_state_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_state; ?>">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
                <span class="invalid-feedback"><?php echo $new_state_err; ?></span>
            </div> 
            <div class="form-group">
                <label>New Zip Code</label>
                <input type="text" name="new_zip" class="form-control <?php echo (!empty($new_zip_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_zip; ?>">
                <span class="invalid-feedback"><?php echo $new_zip_err; ?></span>
            </div> 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Confirm Changes">
            </div>
        </form>

    </div>
</body>
</html>


