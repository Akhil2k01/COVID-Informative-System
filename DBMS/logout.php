<?php
    session_start();
    session_unset();
    session_destroy();
    
    echo '<script type="text/javascript">'; 
    echo 'alert("Logged out Successfully");';
    echo 'window.location.href = "index.html";';
    echo '</script>';

    exit();
?>