<?php 
	require_once "config.php";
	$docid=$docname=$hname=$ddes=$dqual=$dphone="";
    $docid_error=$docname_error=$hname_error=$ddes_error=$dqual_error=$dphone_error="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
		if(empty(trim($_POST['docid'])))
		{
			$docid_error="Doctor ID cannot be empty";
		}
		elseif(empty(trim($_POST['docname'])))
		{
			$docname_error="Doctor name cannot be empty";
		}
        elseif(empty(trim($_POST['hname'])))
		{
			$hname_error="Hospital Name cannot be empty";
		}
        elseif(empty(trim($_POST['ddes'])))
		{
			$ddes_error="Designation cannot be empty";
		}
        elseif(empty(trim($_POST['dqual'])))
		{
			$dqual_error="Qualification cannot be empty";
		}
        elseif(empty(trim($_POST['dphone'])))
		{
			$dphone_error="Qualification cannot be empty";
		}
		else
		{
			$docid=trim($_POST['docid']);
            $docname=trim($_POST['docname']);
            $hname=trim($_POST['hname']);
            $ddes=trim($_POST['ddes']);
            $dqual=trim($_POST['dqual']);
            $dphone=trim($_POST['dphone']);
		}

        $query = "SELECT doc_id from doctor WHERE doc_id = '$docid' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$docid_error="Doctor is already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Doctor is already present");';
            echo 'window.location.href = "insertdoc.html";';
            echo '</script>';
		}

        $query = "SELECT hos_name from hospital WHERE hos_name='$hname' "; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==0)
        {
			$hname_error="Hospital Name is incorrect";
			echo '<script type="text/javascript">'; 
            echo 'alert("Hospital Name is incorrect");';
            echo 'window.location.href = "insertdoc.html";';
            echo '</script>';
		}

		if(empty($docid_error) && empty($docname_error) && empty($hname_error) && empty($ddes_error) && empty($dqual_error) && empty($dphone_error))
		{
			$sql = " INSERT INTO doctor (doc_id, doc_name, hos_name, designation, qualification, phone) VALUES (?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ssssss", $param_docid, $param_docname, $param_hname, $param_ddes, $param_dqual, $param_dphone);

				$param_docid=$docid;
				$param_docname=$docname;
				$param_hname=$hname;
				$param_ddes=$ddes;
                $param_dqual=$dqual;
                $param_dphone=$dphone;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "insertdoc.php";';
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
            echo 'window.location.href = "insertdoc.php";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>