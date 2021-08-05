<?php
    session_start();
    if(!isset($_SESSION["user"]))
    {
        echo "<script>location.replace('login.php');</script>";
    }
    else
    {
        echo "<script>location.replace('dashboard.php');</script>";
    }
?>
