<?php
$er = false;
include "components/_dbconnect.php";
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `users` WHERE uname='$uname'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['password'])){
            session_start();
            $_SESSION['loggedin'] = "true";
            $_SESSION['uname'] = $uname;
            $_SESSION['sno'] = $row['sno'];

            header('location: index.php');
        }
        else{
            $er = true;
            $Error = "Incorrect Password";
        }
    }
    else{
        $er = true;
        $Error = "Username not found";
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
    <title>Login</title>
</head>

<body>
    <?php include "components/_nav.php"?>
    <?php
    if($er){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> '. $Error .' - Can not Login try again
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    }
    ?>
    <div class="container-main container mt-4 mb-4">
        <form action='login.php' method='post'>
            <h1>Login</h1>
        <div class="form-group">
                <label for="uname">Username</label>
                <input type="text" class="form-control" id="uname" name="uname">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <small class="text-center">Don't have a account create one click <a href="signup.php">this</a></small>
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