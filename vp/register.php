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
    echo "First Name: " . $first_name;
    echo "Last Name: " . $last_name;
    echo "email: " . $email;
    echo "password: " . $password;

    //Sql queries for inserting new user
    $sql = "INSERT INTO user (user_email,user_password,first_name,last_name)
    VALUES('$email','$password','$first_name','$last_name')";

    //check if a connection is made
    if ($con->query($sql) == TRUE) {
        echo "You have successfully Registered.Please login in";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}

// if (isset($_POST['login'])) {

//     $validUser = false;



//     // Store the submitted data sent 
//     // via POST method, stored  
//     // Temporarily in $_POST structure. 
//     $_SESSION['user_email'] = $_POST['email'];
//     // echo $_SESSION['user_email'];

//     $_SESSION['user_password'] = $_POST['password'];
//     // echo $_SESSION['user_password'];

//     $sql = "SELECT user_id,user_email,user_password FROM user";
//     $result = $con->query($sql);

//     //check for valid users
//     while ($row = $result->fetch_assoc()) {
//         if ($_SESSION["user_email"] == $row["user_email"] && $_SESSION["user_password"] == $row["user_password"]) {
//             $validUser = true;
//             break;
//         }
//         // echo "user_id: " . $row["user_id"] . " - user_email: " . $row["user_email"] . " " . $row["user_password"] . "<br>";
//     }

//     if ($validUser) {
//         if ($_SESSION['user_email'] == "admin@uni.ca") {
//             header('Location: admin_view.php');
//         } else if ($_SESSION['user_email'] == "nd@uni.ca") {

//             header('Location: nd_view.php');
//         } else if ($_SESSION['user_email'] == "sd@uni.ca") {

//             header('Location: sd_view.php');
//         } else if ($_SESSION['user_email'] == "verdun@uni.ca") {

//             header('Location: verdun_view.php');
//         } else {
//             header('Location: italy_view.php');
//         }
//     } else {
//         alert("Invalid email and password! Please contact your manager for correct credentials");
//     }
//     $con->close();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- <!-- <link rel="stylesheet" type="text/css" href="css/util.css"> -->
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

    <div></div>

    <div class="container-fluid">


        <!---Main header -->
        <nav class="navbar navbar-light bg-light shadow-lg">
            <div class="container-fluid ">
                <a class="navbar-brand" href="#">
                    <img src="assets/vapefree_logo.png" alt="" width="90" height="90">
                </a>
                <h3 class="text-center text-primary">VapeFree</h3>
            </div>
        </nav>

        <br>


        <br>


        <div class="d-flex justify-content-evenly shadow-lg">


            <form action="register.php" method="post" style="display: inline-block;">
                <h1>Registeration</h1>
                <h3 class="display-6">Fill in the form</h3>
                <br>
                <br>
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
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark fw-bold display-8">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-success" name="register">Register</button>

            </form>

            <form action="register.php" method="post">
                <button type="submit" class="btn btn-primary" name="home">Home</button>
            </form>

        </div>

        <br>
        <br>

        <nav class="navbar navbar-light bg-light d-flex justify-content-evenly shadow-lg">
            <div class="card ">
                <div class="card-header">
                    Quote
                </div>
                <div class="card-body ">
                    <blockquote class="blockquote mb-0">
                        <p>Spread Smiles, Spread Love and Triumph Together.</p>
                        <footer class="blockquote-footer">Created by <cite title="Source Title">Taufique Ahmed</cite></footer>
                    </blockquote>
                </div>
            </div>
        </nav>

        <br>



    </div>
    <br>




</body>

</html>