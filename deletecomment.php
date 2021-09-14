<?php
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}

$username = $_SESSION['uname'];

$uname = $_GET['id'];
$sno = $_GET['name'];
if($uname==$username){
        $sql = "DELETE FROM `comments` WHERE `comments`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        header('location: home.php');
}
else{
    header('location: logout.php');
}
?>