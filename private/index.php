<?php
session_start();
if(!isset($_SESSION) and $_SESSION['loggedin']==true){
    header('location: ../login.php');
}
    else{
        header('location: ../home.php');
    }
?>