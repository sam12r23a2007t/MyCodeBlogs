<?php
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $pass = $_POST['pass'];
    $username = $_SESSION['uname'];
    $sql = "SELECT * from users where uname='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($pass, $row['password'])){ 
                $name = '"'.$_SESSION["username"].'"';
                $sql = "DELETE FROM `users` WHERE `users`.`uname` = '$username'";
                $result = mysqli_query($conn, $sql);
                header('location: logout.php');
            }
        }
    }
}
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
    <div class="container container-main c m-4 p-4">
        <form action="delete.php" method="post">
            <h1 class="text-center">Confirm Password to delete account</h1>
            <div class="form-group">
                <label for="exampleInputPassword1" class="text-center">Password</label>
                <input type="password" class="form-control text-center " id="exampleInputPassword1" name="pass">
            </div>
            <button class="btn btn-success text-center" type="submit">Delete</button>
        </form>
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