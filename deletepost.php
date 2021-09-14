<?php
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}

$username = $_SESSION['uname'];

$uname = $_GET['id'];
if($uname==$username){
    $sql = "SELECT * FROM `blogs` WHERE posted_by = '$uname'";
    $result = mysqli_query($conn, $sql);
    while($row=mysqli_fetch_assoc($result)){
        $sno = $row['sno'];
        $sql = "DELETE FROM `blogs` WHERE `blogs`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        header('location: home.php');
    }
}
else{
    header('location: logout.php');
}
?>