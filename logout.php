<?php
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}
session_unset();
session_destroy();
header('location: login.php');
?>