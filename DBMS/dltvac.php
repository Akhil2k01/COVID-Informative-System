<?php
	require_once "config.php" ;
	session_start();

	$loc_id = $_GET['loc_id'];

	$query="DELETE FROM vaccine WHERE loc_id='$loc_id' ";

	$res=mysqli_query($conn,$query);

    if($res)
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Record Deleted Successfully");';
        echo 'window.location.href = "advac.php";';
        echo '</script>';
    }
	else{
		echo '<script type="text/javascript">'; 
        echo 'alert("Failed to Delete");';
        echo 'window.location.href = "advac.php";';
        echo '</script>';
	}
?>