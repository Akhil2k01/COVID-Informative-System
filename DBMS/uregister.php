<?php 
	require_once "config.php";
	$usr_name=$usr_adhar=$usr_phone=$usr_password=$usr_confirm_password="";
	$usr_name_err=$usr_adhar_err=$usr_phone_err=$usr_password_err=$usr_confirm_password_err="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
		
		$query = "SELECT usr_adhar from user WHERE usr_adhar = '$usr_adhar'"; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$usr_adhar_err="User is already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("User is already exists");';
            echo 'window.location.href = "register.html";';
            echo '</script>';
		}
		else{
			$usr_adhar=trim($_POST['usr_adhar']);
		}

		if(empty(trim($_POST['usr_password'])))
		{
			$usr_password_err="Password cannot be empty";
		}
		elseif(strlen(trim($_POST['usr_password'])) < 8)
		{
			$usr_password_err="Password should be of 8 character";
		}
		else
		{
			$usr_password=trim($_POST['usr_password']);
		}

		if(trim($_POST['usr_confirm_password']) != trim($_POST['usr_password']))
		{
			$usr_password_err="Passwords should match";
		}

		if(empty(trim($_POST['usr_name'])))
		{
			$usr_name_err="Name field cannot be blank";
		}
		else
		{
			$usr_name=trim($_POST['usr_name']);
		}

		if(empty(trim($_POST['usr_phone'])))
		{
			$usr_phone_err="Phone number cannot be blank";
		}
		else
		{
			$usr_phone=trim($_POST['usr_phone']);
		}	


		if(empty($usr_id_err) && empty($usr_name_err) && empty($usr_password_err) && empty($usr_confirm_password_err) && empty($usr_phone_err))
		{
			$sql = " INSERT INTO user (usr_name, usr_adhar, usr_phone, usr_password) VALUES (?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ssss", $param_usr_name, $param_usr_adhar, $param_usr_phone, $param_usr_password);

				$param_usr_name=$usr_name;
				$param_usr_adhar=$usr_adhar;
				$param_usr_phone=$usr_phone;
				$param_usr_password=$usr_password;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "login.html";';
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
            echo 'window.location.href = "register.html";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>

