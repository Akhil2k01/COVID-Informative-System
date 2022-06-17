<?php
    require_once "config.php";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
        $adhar = $_POST["adhar"];
        $password = $_POST["password"];

        $query = "SELECT * FROM user WHERE usr_adhar = '$adhar'"; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
            $rows = mysqli_fetch_assoc($res);         
            $pass = $rows['usr_password'];  
            if($pass == $password)
            {
                session_start();    
                $_SESSION['usr_adhar'] = $adhar;    

                echo '<script type="text/javascript">'; 
                echo 'alert("Logged In Successfully");';
                echo "window.location.href = 'usersession.php?id=$adhar ;'";
                echo '</script>';           
            }
            else
            {   
                echo '<script type="text/javascript">'; 
                echo 'alert("Incorrect Password");';
                echo 'window.location.href = "login.html";';
                echo '</script>';
            }
        }
        else
        {
            echo '<script type="text/javascript">'; 
            echo 'alert("Adhar is not registered");';
            echo 'window.location.href = "register.html";';
            echo '</script>';
        }
    }
    else
    {
    	echo "Server Connection Failed";
    }
?>