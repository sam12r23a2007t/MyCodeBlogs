<?php
$er = false;
include "components/_dbconnect.php";
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $number = $_POST['number'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        // $uname = str_replace(">","&gt;", $uname);
        // $uname = str_replace("<","&lt;", $uname);
        $email = str_replace(">","&gt;", $email);
        $email = str_replace("<","&lt;", $email);
        $address = str_replace(">","&gt;", $address);
        $address = str_replace("<","&lt;", $address);
        $existSQL = "SELECT * FROM `users` WHERE uname='$uname'";
        $result = mysqli_query($conn, $existSQL);
        $numRows = mysqli_num_rows($result);
        if($numRows>0){
            $er = true;
            $Error = "Username Already in use";
        }
        else{
            if($pass==$cpass){
                $pass = str_replace(">","&gt;", $pass);
                $pass = str_replace("<","&lt;", $pass);
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql  = "INSERT INTO `users` (`uname`, `email`, `address`, `phone`, `password`) VALUES ('$uname', '$email', '$address', '$number', '$hash');";
                $result = mysqli_query($conn, $sql);
                header('location: login.php');
            }
            else{
                $er = true;
                $Error = "Passwords not matched";
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
    <?php 
        if($er){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> '. $Error .' - Can not SignUp try again
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    ?>
    <div class="container-main container mt-4 mb-4">
        <form method='post' action=signup.php>
            <h1>SignUp to MyCodeBlogs</h1>
            <div class="form-group">
                <label for="uname">Username</label>
                <input type="text" class="form-control" id="uname" name="uname">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="address">
            </div>
            <div class="form-group">
                <label for="number">Phone Number</label>
                <input type="number" class="form-control" id="number" name="number">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <div class="form-group">
                <label for="cpass">Comfirm Password</label>
                <input type="password" class="form-control" id="cpass" name="cpass">
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
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