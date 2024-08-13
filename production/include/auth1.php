<?php
    session_start();
    if(!isset($_SESSION['lrn_no']) || empty($_SESSION['lrn_no'])){
        header("location: ../index.php");
    }
?>