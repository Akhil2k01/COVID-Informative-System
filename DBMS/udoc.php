<?php
	require_once "config.php" ;
	session_start();
	$squery="SELECT * FROM doctor";
	$query=mysqli_query($conn,$squery);
    $nums=mysqli_num_rows($query);
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
            <a href="userregs.php" class="sidetxt"><i class="material-icons" style="font-size:20px;color:white;">cloud</i>
                <span>My Registrations</span></a><br><br><br>
            <a href="#" class="sidetxt"><i class="fa fa-hashtag" style="font-size:20px;color: white;"></i>
                <span>Helpline</span></a><br><br><br>
            <a href="#" class="sidetxt"><i class="fa fa-quote-left" style="font-size:20px;color: white;"></i>
                <span>Helpdesk</span></a><br><br><br>
            <a href="logout.php" class="sidetxt"><i class="fa fa-sign-out" style="font-size:20px;color:white;"></i>
                <span>Logout</span></a>

            <div class="content">
                <table>
                    <tr style="background-color: grey;">
                        <th>Doctor ID</th>
                        <th>Doctor Name</th>
                        <th>Hospital Name</th>
                        <th>Designation</th>
                        <th>Qualification</th>
                        <th>Phone Number</th>
                    </tr>
                    <?php
                        while($res=mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $res['doc_id']; ?></td>
                        <td><?php echo $res['doc_name']; ?></td>
                        <td><?php echo $res['hos_name']; ?></td>
                        <td><?php echo $res['designation']; ?></td>
                        <td><?php echo $res['qualification']; ?></td>
                        <td><?php echo $res['phone']; ?></td>
                    </tr>

                    <?php
                        }
                    ?>                
                </table>
            </div>
        </div>
    </body>