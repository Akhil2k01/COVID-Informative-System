<?php 
	require_once "config.php";

    session_start();
    $aid = $_SESSION['id'];

	$adhar=$vname=$vdose=$locname=$date="";
    $adhar_error=$vname_error=$vdose_error=$locname_error=$date_error="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){

        if(empty(trim($_POST['adhar'])))
		{
			$adhar_error="Adhar cannot be empty";
		}
		elseif(empty(trim($_POST['vname'])))
		{
			$vname_error="vaccine type cannot be empty";
		}
		elseif(empty(trim($_POST['vdose'])))
		{
			$vdose_error="Dosage cannot be empty";
		}
        elseif(empty(trim($_POST['locname'])))
		{
			$locname_error="Location cannot be empty";
		}
		else
		{
            $adhar=trim($_POST['adhar']);
			$vname=trim($_POST['vname']);
            $vdose=trim($_POST['vdose']);
            $locname=trim($_POST['locname']);
		}

        $query = "SELECT * from uvaccine WHERE uadhar = '$adhar' and vaccine_dose = '$vdose' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$adhar_error="Already Registered";
			echo '<script type="text/javascript">'; 
            echo 'alert("Already Registered");';
            echo 'window.location.href = "uservacreg.html";';
            echo '</script>';
		}

		$query = "SELECT * from vaccine WHERE loc_name = '$locname' "; 
        $res = mysqli_query($conn , $query);

		if(mysqli_num_rows($res)==0)
        {
			$locname_error="Location is not present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Location is not present");';
            echo 'window.location.href = "uservacreg.html";';
            echo '</script>';
		}

		$query = "SELECT date from vaccine WHERE loc_name = '$locname' and vaccine_dose = '$vdose' and vaccine_type = '$vname' limit 1 "; 
        $res = mysqli_query($conn , $query);

		if(mysqli_num_rows($res)==0)
        {
			$date_error="Location is not present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Location/Dose/Type is incorrect");';
            echo 'window.location.href = "uservacreg.html";';
            echo '</script>';
		}
		else{
			
			$res1 = mysqli_fetch_array($res);
			$date = $res1['date'];
		}

		if(empty($adhar_error) && empty($vname_error) && empty($vdose_error) && empty($locname_error) && empty($date_error))
		{
			$sql = " INSERT INTO uvaccine (uid, uadhar, vaccine_type, vaccine_dose, loc_name, date) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ssssss", $param_uid, $param_uadhar, $param_vname, $param_vdose, $param_locname, $param_date);

				$param_uid=$aid;
                $param_uadhar=$adhar;
                $param_vname=$vname;
				$param_vdose=$vdose;
				$param_locname=$locname;
                $param_date=$date;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "uservacreg.html";';
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
            echo 'alert("Please fill all the fields");';
            echo 'window.location.href = "uservacreg.html";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>