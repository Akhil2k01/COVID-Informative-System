<?php 
	require_once "config.php";
	$vname=$vdose=$locid=$locname=$date="";
    $vname_error=$vdose_error=$locid_error=$locname_error=$date_error="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
		if(empty(trim($_POST['vname'])))
		{
			$vname_error="vaccine type cannot be empty";
		}
		elseif(empty(trim($_POST['vdose'])))
		{
			$vdose_error="Dosage cannot be empty";
		}
        elseif(empty(trim($_POST['locid'])))
		{
			$locid_error="Location cannot be empty";
		}
        elseif(empty(trim($_POST['locname'])))
		{
			$locname_error="Location cannot be empty";
		}
        elseif(empty(trim($_POST['date'])))
		{
			$date_error="Date cannot be empty";
		}
		else
		{
			$vname=trim($_POST['vname']);
            $vdose=trim($_POST['vdose']);
            $locid=trim($_POST['locid']);
            $locname=trim($_POST['locname']);
            $date=trim($_POST['date']);
		}

        $query = "SELECT loc_id from vaccine WHERE loc_id = '$locid' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$locid_error="Location is already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Location is already present");';
            echo 'window.location.href = "insertvac.html";';
            echo '</script>';
		}

		if(empty($vname_error) && empty($vdose_error) && empty($locid_error) && empty($locname_error) && empty($date_error))
		{
			$sql = " INSERT INTO vaccine (vaccine_type, vaccine_dose, loc_id, loc_name, date) VALUES (?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "sssss", $param_vname, $param_vdose, $param_locid, $param_locname, $param_date);

				$param_vname=$vname;
				$param_vdose=$vdose;
				$param_locid=$locid;
				$param_locname=$locname;
                $param_date=$date;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "insertvac.html";';
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
            echo 'window.location.href = "insertvac.html";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>