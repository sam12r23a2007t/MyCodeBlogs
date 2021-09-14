<?php
$nulldescr = true;
session_start();
include "components/_dbconnect.php";
include "private/function.php";
if($_SESSION['loggedin']!=true){
    header('location: login.php');
}
        $user = $_SESSION['uname'];
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $t = $_POST['title'];
        $d = $_POST['descr'];
        // $t = str_replace(">","&gt;", $t);
        // $t = str_replace("<","&lt;", $t);
        // $d = str_replace(">","&gt;", $d);
        // $d = str_replace("<","&lt;", $d);
        $sql = "INSERT INTO `blogs` (`title`, `descr`, `posted_by`, `posted_on`) VALUES ('$t', '$d', '$user', current_timestamp());";
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
    <style>
        body {
  background-color: white;
  color: black;
}

.dark-mode {
  background-color: #2a2727;
  color: white;
}
    </style>
</head>

<body>
    <?php include "components/_nav.php"?>
    <div class="container-main container">
        <div class="center">
            <img src="img/2.jpg" class="mb-4 c1" alt="img/1.jpg" height="450px" width=90%><br>
            <img src="img/userdefaultimg.png" width="20%" alt="..." class="img-thumbnail abc">
            <h1 class="display-4"><strong>Welcome <em>
                        <?php echo cleancode($user) ?>
                    </em></strong></h1>

            <p class="lead"><br>Your description<br><strong>
                    <?php 
                           $sql = "SELECT * FROM `users` WHERE uname='$user'";
                           $result = mysqli_query($conn, $sql);
                           $noResult = true;
                           while ($row = mysqli_fetch_assoc($result)) {
                               echo cleancode($row['description']);
                           }
                    ?>
                </strong></p> <br> <button class="btn btn-primary center m-4" type="button" data-toggle="collapse"
                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Add
                Post</button> <button class="btn btn-primary center m-4" type="button" data-toggle="collapse"
                data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">Add
                Description</button> <a href="settings.php" class='btn btn-primary m-4'>Settings</a>
                <button type="submit" class="btn btn-primary" onclick="myFunction()">Switch Mode</button>

        </div>

        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form method='POST' action='home.php'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name='title'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name='descr'>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>
        <div class="collapse" id="collapseExample2">
            <div class="card card-body">
                <form method='POST' action='update.php'>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Change Description</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name='cdescr'>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container mb-4 mt-4">
        <h1>My Post</h1>
        <br>
        <?php
        $sql = "SELECT * FROM `blogs` WHERE posted_by='$user'";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
        
            $noResult = false;
            echo '<div class="media m-4" style="font-size:1vw">
            <img src="img/userdefaultimg.png" width="50px" class="mr-3" alt="...">
            <div class="media-body">
              <h5 class="mt-0"><a href="postview.php?sno='. $row['sno'] .'" >'.cleancode(substr($row['title'], 0,60)).'</a></h5>
               <p>'.cleancode(substr( $row['descr'],0,80)).'...</p><a href="deletepost.php?id='. cleancode($row['posted_by']) .'" class="btn btn-primary">Delete</a>
            </div>
          </div>';
        }
        if($noResult){
            echo '<div class="jumbotron">
        <h1 class="display-4">No Posts Found</h1>
        <p class="lead">Post your first post on MyCodeBlogs</p>
      </div>';
        }
        ?>
    </div>

    <?php include "components/_footer.php"?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
    <script>
        function myFunction() {
            var element = document.body;
            element.classList.toggle("dark-mode");
            console.log(75);
        }
    </script>
</body>

</html>