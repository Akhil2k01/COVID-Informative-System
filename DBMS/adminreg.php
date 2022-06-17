<?php 
	require_once "config.php";
	$ad_name=$ad_id=$hosid=$ad_phone=$ad_password=$ad_confirm_password="";
	$ad_name_err=$ad_id_err=$hos_id_err=$ad_phone_err=$ad_password_err=$ad_confirm_password_err="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
		
		$ad_id=trim($_POST['aid']);

		$query = "SELECT a_id  from admi WHERE a_id = '$ad_id' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$ad_id_err="Admin already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Admin already exists");';
            echo 'window.location.href = "adminreg.html";';
            echo '</script>';
		}

        $hosid=$_POST['hid'];

		$sql= "SELECT hos_id from hospital WHERE hos_id = '$ad_id' ";
		$res=mysqli_query($conn,$sql);

		if(mysqli_num_rows($res)==1)
		{
			$ad_id_err="Admin already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Admin already exists");';
            echo 'window.location.href = "adminreg.html";';
            echo '</script>';
		}

        $sql= "SELECT hos_id from hospital WHERE hos_id = '$hosid' ";
		$res=mysqli_query($conn,$sql);

		if(mysqli_num_rows($res)==1)
		{
			
			if(empty(trim($_POST['password'])))
			{
				$ad_password_err="Password cannot be empty";
			}
			elseif(strlen(trim($_POST['password'])) < 8)
			{
				$ad_password_err="Password should be of 8 character";
			}
			else
			{
				$ad_password=trim($_POST['password']);
			}
		
			if(trim($_POST['cpassword']) != trim($_POST['password']))
			{
				$ad_password_err="Passwords should match";
			}

			if(empty(trim($_POST['aname'])))
			{
				$ad_name_err="Name field cannot be blank";
			}
			else
			{
				$ad_name=trim($_POST['aname']);
			}
		
			if(empty(trim($_POST['aphone'])))
			{
				$ad_phone_err="Phone number cannot be blank";
			}
			else
			{
				$ad_phone=trim($_POST['aphone']);
			}	


			if(empty($ad_id_err) && empty($ad_name_err) && empty($hos_id_err) && empty($ad_password_err) && empty($ad_confirm_password_err) && empty($ad_phone_err))
			{
				$sql = " INSERT INTO admi (a_name, a_id ,hos_id, a_phone, a_password) VALUES (?, ?, ?, ?, ?)";
				$stmt = mysqli_prepare($conn, $sql);
				if($stmt)
				{
					mysqli_stmt_bind_param($stmt, "sssss", $param_admin_name, $param_admin_id, $param_hos_id, $param_admin_phone, $param_admin_password);
				
					$param_admin_name=$ad_name;
					$param_admin_id=$ad_id;
    	            $param_hos_id=$hosid;
					$param_admin_phone=$ad_phone;
					$param_admin_password=$ad_password;

					if(mysqli_stmt_execute($stmt))
					{
						echo '<script type="text/javascript">'; 
    	            	echo 'alert("Registration Successfull");';
    	            	echo 'window.location.href = "adminlog.html";';
    	            	echo '</script>';
					}
					else
					{	
						echo "Something went wrong......cannot redirect!";
					}
				
				}
				mysqli_stmt_close($stmt);
			
			}
			else{
				echo '<script type="text/javascript">'; 
    	        echo 'alert("Entered data are Incorrect");';
    	        echo 'window.location.href = "adminreg.html";';
    	        echo '</script>';
			}

    	}
    	else{
    	    echo '<script type="text/javascript">'; 
    	    echo 'alert("Hospital ID not found");';
    	    echo 'window.location.href = "index.html";';
    	    echo '</script>';
    	}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
	
?>

