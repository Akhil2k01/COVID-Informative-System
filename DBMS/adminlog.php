<?php
    require_once "config.php";
    

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $hid = $_POST["hos"];
        $aid = $_POST["admin"];
        $password = $_POST["password"];

        $query= "SELECT hos_id from hospital WHERE hos_id = '$hid' ";
		$res=mysqli_query($conn,$query);

		if(mysqli_num_rows($res)==1)
		{

        $query = "SELECT * FROM admi WHERE a_id = '$aid' ";
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {   

            $rows = mysqli_fetch_assoc($res);         
            $pass = $rows['a_password'];  
            if($pass == $password)
            {
                session_start();    
                $_SESSION['a_id'] = $aid;    

                echo '<script type="text/javascript">'; 
                echo 'alert("Logged In Successfully");';
                echo "window.location.href = 'adminsession.php?id=$aid ;'";
                echo '</script>';  
                         
            }
            else
            {   
                echo '<script type="text/javascript">'; 
                echo 'alert("Incorrect Password");';
                echo 'window.location.href = "adminlog.html";';
                echo '</script>';
            }
        }
        else
        {
            echo '<script type="text/javascript">'; 
            echo 'alert("Admin is not registered");';
            echo 'window.location.href = "hospitalreg.html";';
            echo '</script>';
        }
    }
    else{
        echo '<script type="text/javascript">'; 
        echo 'alert("Hospital ID not found");';
        echo 'window.location.href = "adminlog.html";';
        echo '</script>';
    }
    }
    else
    {
    	echo "Server Connection Failed";
    }
?>