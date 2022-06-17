<?php
	require_once "config.php" ;
	session_start();

	$uadhar = $_GET['uadhar'];

	$query="DELETE FROM uquarantine WHERE uadhar='$uadhar' ";

	$res=mysqli_query($conn,$query);

    if($res)
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Record Deleted Successfully");';
        echo 'window.location.href = "userregs.php";';
        echo '</script>';
    }
	else{
		echo '<script type="text/javascript">'; 
        echo 'alert("Failed to Delete");';
        echo 'window.location.href = "userregs.php";';
        echo '</script>';
	}
?>