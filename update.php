<?php
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}
$user = $_SESSION['uname'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $cd = $_POST['cdescr'];
    // $cd = str_replace(">","&gt;", $cd);
    // $cd = str_replace("<","&lt;", $cd);
    $sql = "UPDATE `users` SET `description` = '$cd' WHERE `users`.`uname` = '$user';";
    $result = mysqli_query($conn, $sql);
    header('location: home.php');
}
?>