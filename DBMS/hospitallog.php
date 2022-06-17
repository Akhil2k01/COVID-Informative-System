<?php
    require_once "config.php";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
        $id = $_POST["hos"];
        $password = $_POST["password"];

        $query = "SELECT * FROM hospital WHERE hos_id = '$id' ";
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {   

            $rows = mysqli_fetch_assoc($res);         
            $pass = $rows['hos_pass'];  
            if($pass == $password)
            {
                session_start();    
                $_SESSION['hos_id'] = $id;    

                echo '<script type="text/javascript">'; 
                echo 'alert("Logged In Successfully");';
                echo "window.location.href = 'adminsession.php?id=$id ;'";
                echo '</script>';           
            }
            else
            {   
                echo '<script type="text/javascript">'; 
                echo 'alert("Incorrect Password");';
                echo 'window.location.href = "hospitallog.html";';
                echo '</script>';
            }
        }
        else
        {
            echo '<script type="text/javascript">'; 
            echo 'alert("Hospital is not registered");';
            echo 'window.location.href = "hospitalreg.html";';
            echo '</script>';
        }
    }
    else
    {
    	echo "Server Connection Failed";
    }
?>