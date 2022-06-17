<?php 
	require_once "config.php";
    session_start();
    $aid = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>User Dashboard</title>
        <link rel="stylesheet" href="ustyles.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>

    <body class="bda">
        <div class="bar">
			<h3 class="head">Welcome <span>  User</span></h3><br><br>
            <img src="userdash.png" alt="profile" 
			    style="width: 50%; position: relative; height: 20%; object-fit: contain;left: 20%;"/>
                <br><br><br>
            <a href="uservac.php" class="sidetxt"><i class='fas fa-syringe' style='font-size:20px;color:white'></i>
                <span>Vaccination</span></a><br><br><br>
            <a href="userqua.php" class="sidetxt"><i class="fa fa-hospital-o" style="font-size:20px;color: white;"></i>
                <span>Quarantine</span></a><br><br><br>
            <a href="userregs.php" class="sidetxt"><i class="material-icons" style="font-size:20px;color:white;">cloud</i>
                <span>My Registrations</span></a><br><br><br>
            <a href="udoc.php" class="sidetxt"><i class='fas fa-heart' style='font-size:20px;color: white;'></i>
                <span>Doctors</span></a><br><br><br>
            <a href="#" class="sidetxt"><i class="fa fa-hashtag" style="font-size:20px;color: white;"></i>
                <span>Helpline</span></a><br><br><br>
            <a href="#" class="sidetxt"><i class="fa fa-quote-left" style="font-size:20px;color: white;"></i>
                <span>Helpdesk</span></a><br><br><br>
            <a href="logout.php" class="sidetxt"><i class="fa fa-sign-out" style="font-size:20px;color:white;"></i>
                <span>Logout</span></a>
                
            <div class="content">
                <br><br>
                <u><h3><strong>My Details</strong></h3></u>
                <br>
                    <?php 
                    $query = "SELECT * FROM user WHERE usr_adhar = '$aid' ";
                    $res = mysqli_query($conn , $query);

                    if(mysqli_num_rows($res)==1)
                    {
                        $res1=mysqli_fetch_array($res)
                ?>
                    <table>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $res1['usr_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Adhar Number</th>
                            <td><?php echo $res1['usr_adhar']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td><?php echo $res1['usr_phone']; ?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><input type="password" id="myInput" class="input-field" value="<?php echo $res1['usr_password']; ?>"></td>
                            <td><input type="checkbox" onclick="myFunction()">Show Password</td>
                            <td><a href="upuserpass.html"><p style="width: 50%; padding-top: 10px;padding-bottom:10px;
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