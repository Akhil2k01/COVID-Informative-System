<?php
	require_once "config.php" ;
	session_start();

	$doc_id = $_GET['doc_id'];

	$query="DELETE FROM doctor WHERE doc_id='$doc_id' ";

	$res=mysqli_query($conn,$query);

    if($res)
    {
        echo '<script type="text/javascript">'; 
        echo 'alert("Record Deleted Successfully");';
        echo 'window.location.href = "doc.php";';
        echo '</script>';
    }
	else{
		echo '<script type="text/javascript">'; 
        echo 'alert("Failed to Delete");';
        echo 'window.location.href = "doc.php";';
        echo '</script>';
	}
?>