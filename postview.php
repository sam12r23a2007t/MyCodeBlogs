<?php
$nocoment = true;
include "components/_dbconnect.php";
include "private/function.php";
session_start();
if($_SESSION['loggedin']!=true){
    header('location: login.php');
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
    <style>
    .b {
        word-wrap: break-word;
    }
    </style>
</head>

<body>
    <?php include "components/_nav.php"?>
    <div class="container container-main mt-4 mb-4">
        <?php
        $sno = $_GET['sno'];
        
        $sql = "SELECT * FROM `blogs` WHERE sno='$sno'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row['title'];
            $descr = $row['descr'];
            $posted_on = $row['posted_on'];
            $posted_by = $row['posted_by'];
            echo '<div class="jumbotron">
            <h1 class="display-4 b">'. cleancode($title) .'</h1>
            <p class="lead b">'. cleancode($descr) .'</p>
            <hr class="my-4">
            <p><strong>Posted on '. $posted_on .'</strong><br> <strong> Posted by <a href="posted_by.php?user='. $posted_by .'">'. cleancode($posted_by).'</a><strong></p>
            <button class="btn btn-primary center m-4"
                    type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false"
                    aria-controls="collapseExample">Add Comment</button>
          </div>';
        }
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $d = $_POST['descr'];
            $sno = $_GET['sno'];
            $user = $_SESSION['uname'];
            // $d = str_replace(">","&gt;", $d);
            // $d = str_replace("<","&lt;", $d);
            $sql = "INSERT INTO `comments` (`descr`, `comented_by`,`con_comment`) VALUES ('$d', '$user', '$sno');";
            $result = mysqli_query($conn, $sql);
        }
        ?>
        <div class="collapse" id="collapseExample2">
            <div class="card card-body">
                <form method='POST' action="postview.php?sno=<?php echo $sno; ?>">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Add comment</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name='descr'>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>
        <div class="container">
            <h1>Comments</h1>
            <?php
        $sql = "SELECT * FROM `comments` WHERE con_comment='$sno'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $nocoment = false;
            $gdescr = $row['descr'];
            $username = $row['comented_by'];
            $comented_on = $row['comented_on'];
            echo '<div class="media m-3 b">
            <img src="img/userdefaultimg.png" width="50px" class="mr-3" alt="...">
            <div class="media-body">
            posted by <em><a href="posted_by.php?user='. $posted_by .'">'. cleancode($username).'</a></em> on ' . $comented_on . '
            <br><p class="b">'. cleancode($gdescr) .'</p>
        </div></div>';
        }
        if($nocoment==true){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-4">No Comments Found</h1>
              <p class="lead">Be the first one to comment</p>
            </div>
          </div>';
        }
        ?>
        </div>

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