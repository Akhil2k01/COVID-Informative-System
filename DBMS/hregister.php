<?php 
	require_once "config.php";
	$hos_name=$hos_id=$hos_phone=$hos_password=$hos_confirm_password="";
	$hos_name_err=$hos_id_err=$hos_phone_err=$hos_password_err=$hos_confirm_password_err="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
		
		$hos_id=trim($_POST['hid']);
		
		$query = "SELECT hos_id  from hospital WHERE hos_id ='$hos_id' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$hos_id_err="Hospital already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Hospital already exists");';
            echo 'window.location.href = "hregister.html";';
            echo '</script>';
		}

		if(empty(trim($_POST['password'])))
		{
			$hos_password_err="Password cannot be empty";
		}
		elseif(strlen(trim($_POST['password'])) < 8)
		{
			$hos_password_err="Password should be of 8 character";
		}
		else
		{
			$hos_password=trim($_POST['password']);
		}

		if(trim($_POST['cpassword']) != trim($_POST['password']))
		{
			$hos_password_err="Passwords should match";
		}

		if(empty(trim($_POST['hname'])))
		{
			$hos_name_err="Name field cannot be blank";
		}
		else
		{
			$hos_name=trim($_POST['hname']);
		}

		if(empty(trim($_POST['hphone'])))
		{
			$hos_phone_err="Phone number cannot be blank";
		}
		else
		{
			$hos_phone=trim($_POST['hphone']);
		}	


		if(empty($hos_id_err) && empty($hos_name_err) && empty($hos_password_err) && empty($hos_confirm_password_err) && empty($hos_phone_err))
		{
			$sql = " INSERT INTO hospital (hos_name, hos_id, hos_phone, hos_pass) VALUES (?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ssss", $param_hos_name, $param_hos_id, $param_hos_phone, $param_hos_password);

				$param_hos_name=$hos_name;
				$param_hos_id=$hos_id;
				$param_hos_phone=$hos_phone;
				$param_hos_password=$hos_password;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "hospitallog.html";';
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
            echo 'window.location.href = "hospitalreg.html";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>

