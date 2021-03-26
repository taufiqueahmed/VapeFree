<?php

include "config.php";





// logout
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}

if (isset($_POST['upload'])) {

    echo '<h3 class="text-success">Images Uploaded Successfully</h3>';
    foreach ($_FILES['doc']['name'] as $key => $val) {
        move_uploaded_file($_FILES['doc']['tmp_name'][$key], "uploads/" . $val);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ucarecdn.com/libs/widget/3.x/uploadcare.full.min.js"></script>






</head>

<body>



    <div class="container-fluid">


        <!---Main header -->
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid ">
                <a class="navbar-brand" href="#">
                    <img src="assets/uni_logo.jpg" alt="" width="95" height="95">
                </a>
                <h3 class="text-center text-danger">UniManagement</h3>
            </div>
        </nav>

        <div class="container text-center ">
            <h6>User Info</h6>
            <h6 class="text-primary">Email: <?php echo $_SESSION["user_email"] ?></h6>
            <h6 class="text-primary">Location:<?php echo $_SESSION['user_password'] ?></h6>
            <form method='post' action="home.php">
                <input class=" btn btn-primary " type="submit" value="Logout" name="logout">
            </form>
        </div>

        <br>
        <br>
        <div class="bg-light">

            <form action="home.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="doc[]" id="file" multiple>
                <input type="submit" value="Upload Image" name="upload">
            </form>
        </div>
        <br>





    </div>




</body>

</html>

<?php

$folder = "uploads/";

if (is_dir($folder)) {

    if ($open = opendir(($folder))) {

        while (($file = readdir($open)) != false) {

            if ($file == '.' || $file == '..') continue;
            echo '<img src="uploads/' . $file . '" width="600" height="600">  ';
        }
        closedir($open);
    }
}

?>