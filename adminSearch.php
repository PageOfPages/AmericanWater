<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$user_name = $user_address = $user_city = $user_state = $user_zip = "";
$Name_id1 = $Username_id1 = $Password_id1 = $Email_id1 = $Address_id1 = $City_id1 = $State_id1 = $Zip_id1 = $Name_id2= $Username_id2 = $Password_id2 = $Email_id2 = $Address_id2 = $City_id2 = $State_id2 = $Zip_id2 = "";

// format: 0: name, 1: username, 2: password, 3: email, 4: address, 5: city, 6: state, 7: zip
$ID_data1 = array("","","","","","","","");
$ID_data2 = array("","","","","","","","");
$ID_data3 = array("","","","","","","","");
$ID_data4 = array("","","","","","","","");
$ID = array($ID_data1, $ID_data2, $ID_data3, $ID_data4);


$sql = "SELECT id, name, address, City, State, Zip FROM accounts";
$result = mysqli_query($link, $sql);

$i = 0;
while($row = mysqli_fetch_array($result))
{
    $ID[$i][0] = $row['name'];
    $ID[$i][4] = $row['address'];
    $ID[$i][5] = $row['City'];
    $ID[$i][6] = $row['State'];
    $ID[$i][7] = $row['Zip'];

    $i++;
}

$sql = "SELECT id, username, password FROM users";
$result = mysqli_query($link, $sql);

$i = 0;
while($row = mysqli_fetch_array($result))
{
    $ID[$i][1] = $row['username'];
    $ID[$i][2] = $row['password'];
    $ID[$i][3] = "testemailforcodingprojects@gmail.com";

    $i++;
}


// Close connection
mysqli_close($link);

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Accounts</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Zip</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td><a href="UpdateID1.php"><?php echo $ID[0][0];?></td>
                                                <td><?php echo $ID[0][1];?></td>
                                                <td><?php echo $ID[0][2];?></td>
                                                <td><?php echo $ID[0][3];?></td>
                                                <td><?php echo $ID[0][4];?></td>
                                                <td><?php echo $ID[0][5];?></td>
                                                <td><?php echo $ID[0][6];?></td>
                                                <td><?php echo $ID[0][7];?></td>
                                            </tr>
                                            <tr>
                                                <td><a href="UpdateID2.php"><?php echo $ID[1][0];?></td>
                                                <td><?php echo $ID[1][1];?></td>
                                                <td><?php echo $ID[1][2];?></td>
                                                <td><?php echo $ID[1][3];?></td>
                                                <td><?php echo $ID[1][4];?></td>
                                                <td><?php echo $ID[1][5];?></td>
                                                <td><?php echo $ID[1][6];?></td>
                                                <td><?php echo $ID[1][7];?></td>
                                            </tr>
                                            <tr>
                                                <td><a href="UpdateID3.php"><?php echo $ID[2][0];?></td>
                                                <td><?php echo $ID[2][1];?></td>
                                                <td><?php echo $ID[2][2];?></td>
                                                <td><?php echo $ID[2][3];?></td>
                                                <td><?php echo $ID[2][4];?></td>
                                                <td><?php echo $ID[2][5];?></td>
                                                <td><?php echo $ID[2][6];?></td>
                                                <td><?php echo $ID[2][7];?></td>
                                            </tr>
                                            <tr>
                                                <td><a href="UpdateID4.php"><?php echo $ID[3][0];?></td>
                                                <td><?php echo $ID[3][1];?></td>
                                                <td><?php echo $ID[3][2];?></td>
                                                <td><?php echo $ID[3][3];?></td>
                                                <td><?php echo $ID[3][4];?></td>
                                                <td><?php echo $ID[3][5];?></td>
                                                <td><?php echo $ID[3][6];?></td>
                                                <td><?php echo $ID[3][7];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>