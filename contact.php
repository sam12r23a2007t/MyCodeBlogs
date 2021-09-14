<?php
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}
$user = $_SESSION['uname'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $content = $_POST['content'];
    $sql = "INSERT INTO `contact` (`email`, `uname`, `number`, `address`, `content`) VALUES ('$email', '$username', '$number', '$address', '$content');";
    $result = mysqli_query($conn, $sql);
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
    <div class="container-main container">
        <div class="m-4">
            <h1>Contact Us</h1>
            <h2>Enter details to submit</h2>
            <form action="contact.php" method='POST'>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">Username</label>
                        <input type="text" class="form-control" id="inputPassword4" name="username">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCity">Phone Number</label>
                        <input type="number" class="form-control" id="inputCity" name="number">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" name="address">
                </div>
                <div class="form-group">
                    <label for="inputAddress">Content</label><br>
                    <textarea name="content" id="content" cols="150" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
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