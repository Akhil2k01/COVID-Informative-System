<?php
	require_once "config.php" ;
	session_start();

	$patient_adhar = $_GET['patient_adhar'];

	$query="DELETE FROM vaccine_details WHERE patient_adhar='$patient_adhar' ";

	$res=mysqli_query($conn,$query);

    if($res)
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Record Deleted Successfully");';
        echo 'window.location.href = "advcntd.php";';
        echo '</script>';
    }
	else{
		echo '<script type="text/javascript">'; 
        echo 'alert("Failed to Delete");';
        echo 'window.location.href = "advcntd.php";';
        echo '</script>';
	}
?>