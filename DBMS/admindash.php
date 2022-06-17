<?php 
	require_once "config.php";
    session_start();
    $aid = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="adstyles.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>

    <body class="bda">
        <div class="bar">
			<h3 class="head">Welcome <span>  Admin</span></h3><br><br>
            <img src="profiledash.png" alt="profile" 
			    style="width: 50%; position: relative; height: 20%; object-fit: contain;left: 20%;"/>
                <br><br><br>
            <a href="advac.php" class="sidetxt"><i class='fas fa-syringe' style='font-size:20px;color:white'></i>
                <span>Vaccines</span></a><br><br><br>
            <a href="advcntd.php" class="sidetxt"><i class='fas fa-band-aid' style='font-size:20px;color: white;'></i></i>
                <span>Vaccinated</span></a><br><br><br>
            <a href="adqua.php" class="sidetxt"><i class="fa fa-hospital-o" style="font-size:20px;color: white;"></i>
                <span>Quarantines</span></a><br><br><br>
            <a href="doc.php" class="sidetxt"><i class='fas fa-heart' style='font-size:20px;color: white;'></i>
                <span>Doctors</span></a><br><br><br>
            <a href="aduserregs.php" class="sidetxt"><i class="material-icons" style="font-size:20px;color:white;">cloud</i>
                <span>Registrations</span></a><br><br><br>
            <a href="#" class="sidetxt"><i class="fa fa-quote-left" style="font-size:20px;color: white;"></i>
                <span>Write us</span></a><br><br><br>
            <a href="logout.php" class="sidetxt"><i class="fa fa-sign-out" style="font-size:20px;color:white;"></i>
                <span>Logout</span></a>
            
            <div class="content">
                <br><br>
                <u><h3><strong>My Details</strong></h3></u>
                <br>
                <?php 
                    $query = "SELECT * FROM admi WHERE a_id = '$aid' ";
                    $res = mysqli_query($conn , $query);

                    if(mysqli_num_rows($res)==1)
                    {
                        $res1=mysqli_fetch_array($res)
                ?>
                    <table>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $res1['a_name']; ?></td>
                        </tr>
                        <tr>
                            <th>ID Number</th>
                            <td><?php echo $res1['a_id']; ?></td>
                        </tr>
                        <tr>
                            <th>Hospital ID</th>
                            <td><?php echo $res1['hos_id']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $res1['a_phone']; ?></td>
                        </tr>
                        <tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="password" id="myInput" class="input-field" value="<?php echo $res1['a_password']; ?>"></td>
                            <td><input type="checkbox" onclick="myFunction()">Show Password</td>
                            <td><a href="upadpass.html"><p style="width: 50%; padding-top: 10px;padding-bottom:10px;
	                            cursor: pointer;
	                            font-style: oblique;
                                text-align: center;
                                display: inline-block;">
                                Change Password</p></a>
                            </td>
                        </tr>
                    </table>
                <?php
                    }
                    else{
                        $query = "SELECT * FROM hospital WHERE hos_id = '$aid' ";
                        $res = mysqli_query($conn , $query);
                        $res1=mysqli_fetch_array($res)
                ?>
                    <table>
                        <tr>
                            <th>Hospital Name</th>
                            <td><?php echo $res1['hos_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Hospital ID Number</th>
                            <td><?php echo $res1['hos_id']; ?></td>
                        </tr>
                        <tr>
                            <th>Hospital Phone Number</th>
                            <td><?php echo $res1['hos_phone']; ?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="password" id="myInput" class="input-field" value="<?php echo $res1['hos_pass']; ?>"></td>
                            <td><input type="checkbox" onclick="myFunction()">Show Password</td>
                            <td><a href="upadpass.html"><p style="width: 50%; padding-top: 10px;padding-bottom:10px;
	                            cursor: pointer;
	                            font-style: oblique;
                                text-align: center;
                                display: inline-block;">
                                Change Password</p></a>
                            </td>
                        </tr>
                    </table>
                <?php
                    }
                ?>
            </div>
        </div>
        <script>
            function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        </script>
    </body>