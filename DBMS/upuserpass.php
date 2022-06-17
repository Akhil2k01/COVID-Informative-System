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
        
        $query = "SELECT * from user WHERE usr_password = '$opass' and usr_adhar = '$aid' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==0)
        {
			$opass_error="Old password didn't match";
			echo '<script type="text/javascript">'; 
            echo 'alert("Old password did not match");';
            echo 'window.location.href = "upuserpass.html";';
            echo '</script>';
		}
        elseif(trim($_POST['opass']) == trim($_POST['npass']))
		{
			$cpass_error="Passwords match";
            echo '<script type="text/javascript">'; 
            echo 'alert("Old and New Password cannot be same");';
            echo 'window.location.href = "upuserpass.html";';
            echo '</script>';
		}
        elseif(trim($_POST['cpass']) != trim($_POST['npass']))
		{
			$cpass_error="Passwords should match";
            echo '<script type="text/javascript">'; 
            echo 'alert("New Password did not match");';
            echo 'window.location.href = "upuserpass.html";';
            echo '</script>';
		}
        else{
            $query="UPDATE user SET usr_password='$npass' WHERE usr_password = '$opass' and usr_adhar = '$aid' ";
            $res=mysqli_query($conn,$query);

            if($res)
            {
                echo '<script type="text/javascript">'; 
                echo 'alert("Password changed Successfully");';
                echo 'window.location.href = "userdash.php";';
                echo '</script>';
            }
        }
    }