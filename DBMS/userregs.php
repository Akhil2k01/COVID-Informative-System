<?php
	require_once "config.php" ;
	session_start();
    $aid = $_SESSION['id'];

	$vquery="SELECT * FROM uvaccine WHERE uid='$aid'";
	$vvquery=mysqli_query($conn,$vquery);
    $vnums=mysqli_num_rows($vvquery);

    $qquery="SELECT * FROM uquarantine WHERE uid='$aid'";
	$qqquery=mysqli_query($conn,$qquery);
    $qnums=mysqli_num_rows($qqquery);
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
            <a href="userdash.php" class="sidetxt"><i class="fa fa-dashboard" style="font: size 20px; color: white;"></i>
                <span>Dashboard</span></a><br><br><br>
            <a href="uservac.php" class="sidetxt"><i class='fas fa-syringe' style='font-size:20px;color:white'></i>
                <span>Vaccination</span></a><br><br><br>
            <a href="userqua.php" class="sidetxt"><i class="fa fa-hospital-o" style="font-size:20px;color: white;"></i>
                <span>Quarantine</span></a><br><br><br>
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
                <u><h3><strong>My Vaccination Registrations</strong></h3></u>
                <br>
                <table>
                    <tr style="background-color: grey;">
                        <th>Adhar Number</th>
                        <th>Vaccination Type</th>
                        <th>Vaccination Dose</th>
                        <th>Location Name</th>
                        <th>Date</th>
                        <th>DELETE</th>
                    </tr>
                    <?php
                        while($res=mysqli_fetch_array($vvquery)){
                    ?>
                    <tr>
                        <td><?php echo $res['uadhar']; ?></td>
                        <td><?php echo $res['vaccine_type']; ?></td>
                        <td><?php echo $res['vaccine_dose']; ?></td>
                        <td><?php echo $res['loc_name']; ?></td>
                        <td><?php echo $res['date']; ?></td>
                        <td><a href="userdltvac.php?uadhar=<?php echo $res['uadhar'];?>" data-toggle="tooltip" data-placement="bottom"title="DELETE">
                            <i class="fa fa-trash" ariana-hidden="true"></i>DELETE</a></td>
                    </tr>

                    <?php
                        }
                    ?>                
                </table>
                <br><br>
                <u><h3><strong>My Quarantine Registrations</strong></h3></u>
                <br>
                <table>
                    <tr style="background-color: grey;">
                        <th>Adhar Number</th>
                        <th>Location Name</th>
                        <th>Location ID</th>
                        <th>Start Date</th>
                        <th>Discharge Date</th>
                        <th>DELETE</th>
                    </tr>
                    <?php
                        while($res1=mysqli_fetch_array($qqquery)){
                    ?>
                    <tr>
                        <td><?php echo $res1['uadhar']; ?></td>
                        <td><?php echo $res1['loc_name']; ?></td>
                        <td><?php echo $res1['loc_id']; ?></td>
                        <td><?php echo $res1['s_date']; ?></td>
                        <td><?php echo $res1['d_date']; ?></td>
                        <td><a href="userdltqua.php?uadhar=<?php echo $res1['uadhar'];?>" data-toggle="tooltip" data-placement="bottom"title="DELETE">
                            <i class="fa fa-trash" ariana-hidden="true"></i>DELETE</a></td>
                    </tr>

                    <?php
                        }
                    ?>                
                </table>
            </div>
        </div>
        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip(); 
            });
        </script>     
    </body>