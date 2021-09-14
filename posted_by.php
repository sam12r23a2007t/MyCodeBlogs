<?php
include "components/_dbconnect.php";
include "private/function.php";
session_start();
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}
$user = $_GET['user'];
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
    <div class="container container-main mt-4 mb-4">
        <div class="center">
        <img src="img/2.jpg" class="mb-4 c1" alt="img/1.jpg" height="450px" width=90%><br>
            <img src="img/userdefaultimg.png" width="20%" alt="..." class="img-thumbnail abc">
            <h1 class="display-4 text-center center"><strong><em><?php echo cleancode($user) ?></em></strong></h1>
            <p class="lead text-center"><br> Description <br> <strong> <?php 
                           $sql = "SELECT * FROM `users` WHERE uname='$user'";
                           $result = mysqli_query($conn, $sql);
                           $noResult = true;
                           while ($row = mysqli_fetch_assoc($result)) {
                               echo cleancode($row['description']);
                           }
                           ?></strong>
        </div>
        <h1> Posts made by <strong><em> <?php echo cleancode($user); ?></em></strong></h1>
        <?php
        $sql = "SELECT * FROM `blogs` WHERE posted_by='$user'";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            
            $noResult = false;
            echo '<div class="media m-4">
            <img src="img/userdefaultimg.png" width="50px" class="mr-3" alt="...">
            <div class="media-body">
              <h5 class="mt-0"><a href="postview.php?sno='. $row['sno'] .'" class="text-dark">'.cleancode(substr($row['title'],0,40)).'</a></h5>
              '.cleancode(substr($row['descr'],0,40)).'
            </div>
          </div>';
        }
        if($noResult){
            echo '<div class="jumbotron">
        <h1 class="display-4">No Posts Found from '. cleancode($user) .'</h1>
        <p class="lead">This account has no post</p>
      </div>';
        }
        ?>
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