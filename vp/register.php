<?php

include "config.php";

// Function defnition 
function alert($message)
{
    // Display the alert box  
    echo "<script>alert('$message');</script>";
}

if (isset($_POST['home'])) {
    header('Location: index.php');
}

if (isset($_POST['register'])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    //Debugging
    // echo "First Name: " . $first_name;
    // echo "Last Name: " . $last_name;
    // echo "email: " . $email;
    // echo "password: " . $password;

    //Sql queries for inserting new user
    $sql = "INSERT INTO user (user_email,user_password,first_name,last_name)
    VALUES('$email','$password','$first_name','$last_name')";

    //check if a connection is made
    if ($con->query($sql) == TRUE) {
        // echo "You have successfully Registered.Please login in";
        alert("You have successfully Registered.Please login in");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@550&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- <!-- <link rel="stylesheet" type="text/css" href="css/util.css"> -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container-fluid">

        <!---Main header -->
        <div id="logo-header" class="text-center">
            <img id="logo" src="assets/vapefree_logo.png" alt="logo">
        </div>

        <nav class="glassmorphic-nav ">
            <ul class="navbar container">
                <li><a class="btn btn-outline-primary" href="index.php">Login</a></li>
                <li><a class="btn btn-outline-primary " href="register.php">Register</a></li>
                <li><a class="btn btn-outline-primary" href="about.html">About</a></li>
            </ul>
        </nav>

        <div id="register-block" class="glassmorphic">
            <form class="login-form" action="register.php" method="post">

                <h1 class="h3 text-center login-signup-title">CREATE AN ACCOUNT</h1>

                <div class="mb-3">
                    <label class="form-label text-dark fw-bold display-8">First Name</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark fw-bold display-8">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark fw-bold display-8">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark fw-bold display-8">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </div>




            </form>
        </div>
    </div>
    <br>




</body>

</html>