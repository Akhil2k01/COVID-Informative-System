<?php 
	require_once "config.php";
    session_start();
    $aid = $_SESSION['id'];
    $opass=$npass=$cpass="";
    $opass_error=$npass_error=$cpass_error="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
        if(empty(trim($_POST['opass'])))
		{
			$opass_error="Old Password cannot be empty";
		}
		elseif(empty(trim($_POST['npass'])))
		{
			$npass_error="New Password cannot be empty";
		}
        elseif(empty(trim($_POST['cpass'])))
		{
			$cpass_error="Confirm Password cannot be empty";
		}
        else
		{
			$opass=trim($_POST['opass']);
            $npass=trim($_POST['npass']);
            $cpass=trim($_POST['cpass']);
		}
        
        $query = "SELECT * FROM admi WHERE a_id = '$aid' ";
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
            $query = "SELECT * from admi WHERE a_password = '$opass' and a_id = '$aid' "; 
            $res = mysqli_query($conn , $query);
        }
        else{
            $query = "SELECT * FROM hospital WHERE hos_pass = '$opass' and hos_id = '$aid' ";
            $res = mysqli_query($conn , $query);
        }

        if(mysqli_num_rows($res)==0)
        {
			$opass_error="Old password didn't match";
			echo '<script type="text/javascript">'; 
            echo 'alert("Old password did not match");';
            echo 'window.location.href = "upadpass.html";';
            echo '</script>';
		}
        elseif(trim($_POST['opass']) == trim($_POST['npass']))
		{
			$cpass_error="Passwords match";
            echo '<script type="text/javascript">'; 
            echo 'alert("Old and New Password cannot be same");';
            echo 'window.location.href = "upadpass.html";';
            echo '</script>';
		}
        elseif(trim($_POST['cpass']) != trim($_POST['npass']))
		{
			$cpass_error="Passwords should match";
            echo '<script type="text/javascript">'; 
            echo 'alert("New Password did not match");';
            echo 'window.location.href = "upadpass.html";';
            echo '</script>';
		}
        else{
            $query="UPDATE admi SET a_password='$npass' WHERE a_password = '$opass' and a_id = '$aid' ";
            $res=mysqli_query($conn,$query);

            if($res)
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Password changed Successfully");';
                echo 'window.location.href = "admindash.php";';
                echo '</script>';
            }
        }
    }