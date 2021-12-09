<?php
// Initialize the session
session_start();
 
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
    


    if(empty($new_address_err) && empty($new_city_err) && empty($new_zip_err))
    {
        $url = "https://secure.shippingapis.com/ShippingAPI.dll?API=Verify&XML=%3CAddressValidateRequest%20USERID=%22553WATER4721%22%3E%3CRevision%3E1%3C/Revision%3E%20%3CAddress%20ID=%220%22%3E%20%3CAddress1%3E{$new_address}%3C/Address1%3E%20%3CAddress2%3E{$new_address}%3C/Address2%3E%20%3CCity/%3E%20%3CState%3E{$new_state}%3C/State%3E%20%3CZip5%3E{$new_zip}%3C/Zip5%3E%20%3CZip4/%3E%20%3C/Address%3E%20%3C/AddressValidateRequest%3E";
        //$url = "https://secure.shippingapis.com/ShippingAPI.dll?API=Verify&XML=%3CAddressValidateRequest%20USERID=%22553WATER4721%22%3E%3CRevision%3E1%3C/Revision%3E%20%3CAddress%20ID=%220%22%3E%20%3CAddress1%3EOLDBAROFSOAP%20K%3C/Address1%3E%20%3CAddress2%3E29851%20ONEWAYTONY%3C/Address2%3E%20%3CCity/%3E%20%3CState%3ECA%3C/State%3E%20%3CZip5%3E92688%3C/Zip5%3E%20%3CZip4/%3E%20%3C/Address%3E%20%3C/AddressValidateRequest%3E";
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $err_found = strpos($curl_response, "Not Found");
        $invalid_found = strpos($curl_response, "Invalid");
        if (($err_found) or ($invalid_found))
        {
            $verification_err = "The adress you have entered is not a verifiable address. Please enter an existing address.";
        }

        if(empty($verification_err))
        {
            $_SESSION["address"] = $new_address;
            $_SESSION["city"]  = $new_city;
            $_SESSION["state"]  = $new_state; 
            $_SESSION["zip"] = $new_zip;
            
            header("location: email.php");
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

        <?php 
        if(!empty($verification_err)){
            echo '<div class="alert alert-danger">' . $verification_err . '</div>';
        }        
        ?> 

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
            <!-- <div class="form-group">
                <input type="checkbox" class="form-check-input" name="check" id="future-date-check">
                <label class="form-check-label" for="future-date-check"> I will be living here at a future date</label>
                <span class="invalid-feedback"><?php echo $check_err; ?></span>
            </div> -->
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Confirm Changes">
            </div>
        </form>

        <!-- <form action="email.php" method="POST">
            <input type="submit" class="btn btn-primary" value="Confirm Changes">
        </form> -->
        
    </div>
</body>
</html>


