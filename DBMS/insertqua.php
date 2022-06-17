<?php 
	require_once "config.php";
	$locid=$locname=$fdate=$tdate="";
    $locid_error=$locname_error=$fdate_error="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
		if(empty(trim($_POST['locname'])))
		{
			$locname_error="Location cannot be empty";
		}
		elseif(empty(trim($_POST['locid'])))
		{
			$locid_error="Dosage cannot be empty";
		}
        elseif(empty(trim($_POST['fdate'])))
		{
			$fdate_error="Location cannot be empty";
		}
		else
		{
            $locname=trim($_POST['locname']);
            $locid=trim($_POST['locid']);
            $fdate=trim($_POST['fdate']);
            $tdate=trim($_POST['tdate']);
		}
        if(empty(trim($_POST['tdate'])))
		{
			$tdate=null;
		}

		if($fdate > $tdate){
            $tdate_error="incorrect";
			echo '<script type="text/javascript">'; 
            echo 'alert("To Date is Incorrect");';
            echo 'window.location.href = "insertqua.html";';
            echo '</script>';
        }

		$query = "SELECT loc_id from aquarantine WHERE loc_id = '$locid' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$docid_error="Location is already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Location is already present");';
            echo 'window.location.href = "insertqua.html";';
            echo '</script>';
		}


		if(empty($locname_error) && empty($locid_error) && empty($fdate_error) && empty($tdate_error))
		{
			$sql = " INSERT INTO aquarantine (loc_name, loc_id, fdate, tdate) VALUES (?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ssss", $param_locname, $param_locid, $param_fdate, $param_tdate);

				$param_locname=$locname;
                $param_locid=$locid;
                $param_fdate=$fdate;
                $param_tdate=$tdate;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "insertqua.html";';
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
            echo 'window.location.href = "insertqua.html";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>