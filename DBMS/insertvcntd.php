<?php 
	require_once "config.php";
	$padhar=$pname=$page=$padd=$vname=$fdate=$sdate=$docid="";
    $padhar_error=$pname_error=$page_error=$padd_error=$vname_error=$fdate_error=$sdate_error=$docid_error="";

    if ($_SERVER['REQUEST_METHOD'] =="POST"){
        if(empty(trim($_POST['padhar'])))
		{
			$padhar_error="Patient Adhar cannot be empty";
		}
		elseif(empty(trim($_POST['pname'])))
		{
			$pname_error="Patient Name cannot be empty";
		}
		elseif(empty(trim($_POST['page'])))
		{
			$page_error="Age cannot be empty";
		}
		elseif(empty(trim($_POST['padd'])))
		{
			$padd_error="Address cannot be empty";
		}
        elseif(empty(trim($_POST['vname'])))
		{
			$vname_error="Vaccine cannot be empty";
		}
        elseif(empty(trim($_POST['fdate'])))
		{
			$fdate_error="Date cannot be empty";
		}
        elseif(empty(trim($_POST['docid'])))
		{
			$docid_error="Doctor id cannot be empty";
		}
		else
		{
            $padhar=trim($_POST['padhar']);
            $pname=trim($_POST['pname']);
            $page=trim($_POST['page']);
            $padd=trim($_POST['padd']);
			$vname=trim($_POST['vname']);
            $fdate=trim($_POST['fdate']);
            $sdate=trim($_POST['sdate']);
            $docid=trim($_POST['docid']);
		}

        if(empty(trim($_POST['sdate'])))
		{
			$sdate=null;
		}

		$query = "SELECT patient_adhar from vaccine_details WHERE patient_adhar = '$padhar'"; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==1)
        {
			$docid_error="Patient is already present";
			echo '<script type="text/javascript">'; 
            echo 'alert("Patient is already present");';
            echo 'window.location.href = "insertvcntd.html";';
            echo '</script>';
		}
        
        $query = "SELECT doc_id from doctor WHERE doc_id = '$docid'"; 
        $res = mysqli_query($conn , $query);

        if(mysqli_num_rows($res)==0)
        {
			$docid_error="Doctor id is not available";
			echo '<script type="text/javascript">'; 
            echo 'alert("Doctor ID is not Available");';
            echo 'window.location.href = "insertvcntd.html";';
            echo '</script>';
		}

		if(empty($padhar_error) && empty($pname_error) && empty($page_error) && empty($padd_error) && empty($vname_error) && empty($fdate_error) && empty($sdate_error) && empty($docid_error))
		{
			$sql = " INSERT INTO vaccine_details (patient_adhar, patient_name, age, address, vaccine_type, first_date, second_date, doc_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn,$sql);
			if($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ssssssss", $param_padhar, $param_pname, $param_page, $param_padd, $param_vname, $param_fdate, $param_sdate, $param_docid);

				$param_padhar=$padhar;
                $param_pname=$pname;
                $param_page=$page;
                $param_padd=$padd;
                $param_vname=$vname;
                $param_fdate=$fdate;
                $param_sdate=$sdate;
                $param_docid=$docid;

				if(mysqli_stmt_execute($stmt))
				{
					echo '<script type="text/javascript">'; 
                	echo 'alert("Registration Successfull");';
                	echo 'window.location.href = "insertvcntd.html";';
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
            echo 'window.location.href = "insertvcntd.html";';
            echo '</script>';
		}
		mysqli_close($conn);
	}
	else{
		echo "Server Connection Failed";
	}
?>