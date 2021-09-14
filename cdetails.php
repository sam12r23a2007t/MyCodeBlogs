<?php
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}
$user = $_SESSION['uname'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>MyCodeBlogs</title>
</head>

<body>
    <?php include "components/_nav.php"?>
    <div class="container container-main center">
        <div class="m-4"><a href="cemail.php" class="c">Change Email</a></div><br>
        <div class="m-4"><a href="caddress.php" class="c">Change Address</a></div><br>
        <div class="m-4"><a href="cphone.php" class="c">Change Phone Number</a></div><br>
    </div>
    <?php include "components/_footer.php"?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>