<?php
    
    session_start();

    session_unset();

    session_destroy();

    echo "you are logout succesfully";

    header("location: index.php");
?>