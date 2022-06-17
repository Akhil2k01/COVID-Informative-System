<?php 
	require_once "config.php";
    $aid = $_GET['id'];
    session_start();
    $_SESSION['id'] = $aid;
    
    echo '<script type="text/javascript">'; 
    echo 'window.location.href = "userdash.php";';
    echo '</script>';
?>