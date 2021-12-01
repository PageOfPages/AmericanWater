<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$user_name = $user_address = $user_city = $user_state = $user_zip = "";

$sql = "SELECT id, name, address, City, State, Zip FROM accounts WHERE id = '". $_SESSION["id"]."'";
$result = mysqli_query($link, $sql);

while ($row = $result->fetch_assoc()) {
    $user_name = $row['name'];
    $user_address = $row['address'];
    $user_city = $row['City'];
    $user_state = $row['State'];
    $user_zip = $row['Zip'];
}


// Close connection
mysqli_close($link);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h3>Account Information</h3>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <p><?php echo $user_name;?></p>
            </div>    
            <div class="form-group">
                <p><?php echo $user_address;?></p>
            </div>  
            <div class="form-group">
                <p><?php echo $user_city;?></p>
            </div>  
            <div class="form-group">
                <p><?php echo $user_state;?></p>
            </div>  
            <div class="form-group">
                <p><?php echo $user_zip;?></p>
            </div>  
        </form>

        <form action="createNewAdress.php" method="POST">
            <input type="submit" class="btn btn-primary" value="Edit Address">
        </form>
    </div>
</body>
</html>



<!-- SQL DB for entering accounts -->
<!-- INSERT INTO accounts (id, name, address, City, State, Zip) VALUES (1, 'Sam Jones', '99 W Candy Lane', 'Halloween Town', 'New Jersey', '08109'); -->
<!-- INSERT INTO accounts (id, name, address, City, State, Zip) VALUES (4, 'Santa Claus', '1 N Pole', 'Christmas Town', 'Antartica', '00000'); -->