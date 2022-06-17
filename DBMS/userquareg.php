<?php 
	require_once "config.php";

    session_start();
    $aid = $_SESSION['id'];

	$adhar=$locname=$locid=$test=$testdate=$sdate=$ddate="";
    $adhar_error=$locname_error=$test_error=$testdate_error=$sdate_error="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){

        if(empty(trim($_POST['adhar'])))
		{
			$adhar_error="Adhar cannot be empty";
		}
		elseif(empty(trim($_POST['locname'])))
		{
			$locname_error="Location cannot be empty";
		}
        elseif(empty(trim($_POST['test'])))
		{
			$test_error="Test cannot be empty";
		}
		elseif(empty(trim($_POST['testdate'])))
		{
			$testdate_error="Test Date cannot be empty";
		}
        elseif(empty(trim($_POST['sdate'])))
		{
			$sdate_error="Start date cannot be empty";
		}
		else
		{
            $adhar=trim($_POST['adhar']);
            $locname=trim($_POST['locname']);
            $test=trim($_POST['test']);
            $testdate=trim($_POST['testdate']);
            $sdate=trim($_POST['sdate']);
		}

        

        $date = date_create($sdate);
        date_add($date,date_interval_create_from_date_string("30 days"));
        $ddate = $date->format('Y-m-d');

        $query = "SELECT * from aquarantine WHERE loc_name = '$locname' "; 
        $res = mysqli_query($conn , $query);

		if(mysqli_num_rows($res)==0)
        {
			$locname_error="Location is not present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Location is not present");';
            echo 'window.location.href = "userquareg.html";';
            echo '</script>';
		}
        else{
            $query = "SELECT loc_id,tdate from aquarantine WHERE loc_name = '$locname' limit 1 "; 
            $res = mysqli_query($conn , $query);
            $res1 = mysqli_fetch_array($res);
		    $locid = $res1['loc_id'];
            $tdate = $res1['tdate'];

            if($tdate != NULL){
                $tilldate=$tdate;
            }
            else{
                $tilldate=$sdate;
            }
        }

        
        if($sdate > $tilldate){
            $sdate_error="incorrect";
			echo '<script type="text/javascript">'; 
            echo 'alert("Start date is Incorrect");';
            echo 'window.location.href = "userquareg.html";';
            echo '</script>';
        }

        $query = "SELECT * from uquarantine WHERE uadhar = '$adhar' and loc_name = '$locname' and loc_id = '$locid' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$adhar_error="Already Registered";
			echo '<script type="text/javascript">'; 
            echo 'alert("Already Registered");';
            echo 'window.location.href = "userquareg.html";';
            echo '</script>';
		}

		if(empty($adhar_error) && empty($locname_error) && empty($test_error) && empty($testdate_error) && empty($sdate_error))
		{
			$sql = " INSERT INTO uquarantine (uid, uadhar, loc_name, loc_id, test, test_date, s_date, d_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ssssssss", $param_uid, $param_uadhar, $param_locname, $param_locid, $param_test, $param_test_date, $param_s_date, $param_d_date);

				$param_uid=$aid;
                $param_uadhar=$adhar;
                $param_locname=$locname;
                $param_locid=$locid;
				$param_test=$test;
				$param_test_date=$testdate;
                $param_s_date=$sdate;
                $param_d_date=$ddate;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "userquareg.html";';
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
            echo 'window.location.href = "userquareg.html";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>