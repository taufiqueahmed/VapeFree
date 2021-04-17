<?php

include "config.php";

// Function defnition 
function alert($message)
{

    // Display the alert box  
    echo "<script>alert('$message');</script>";
}

function gotoAboutUs()
{
    header('Location:about.html');
}


if (isset($_POST['register'])) {
    header('Location: register.php');
}


if (isset($_POST['login'])) {

    $validUser = false;



    // Store the submitted data sent 
    // via POST method, stored  
    // Temporarily in $_POST structure. 
    $_SESSION['user_email'] = $_POST['email'];
    $_SESSION['user_password'] = $_POST['password'];


    $sql = "SELECT user_id,user_email,user_password FROM user";
    $result = $con->query($sql);

    //check for valid users
    while ($row = $result->fetch_assoc()) {
        if ($_SESSION["user_email"] == $row["user_email"] && $_SESSION["user_password"] == $row["user_password"]) {
            $validUser = true;

            //store Full Name
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"];
            break;
        }
        // echo "user_id: " . $row["user_id"] . " - user_email: " . $row["user_email"] . " " . $row["user_password"] . "<br>";
    }

    if ($validUser) {

        header('Location: home.php');
    } else {
        alert("Invalid email and password!");
    }
    $con->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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

        <div id="login-signup-block" class="glassmorphic  justify-content-evenly ">

            <h1 class="h3 text-center login-signup-title">ACCESS YOUR ACCOUNT</h1>

            <div class="login-form">
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label class="form-label text-dark fw-bold display-8">
                            <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/rpztpstw.json" trigger="loop" delay="1500" colors="primary:#121331,secondary:#1663c7" style="width:60px;height:60px">
                            </lord-icon> Email
                        </label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark fw-bold display-8">
                            <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/etqwxxml.json" trigger="loop" delay="1500" colors="primary:#121331,secondary:#3080e8" style="width:60px;height:60px">
                            </lord-icon> Password
                        </label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                    </div>

                    <br>
                    <div class="container text-center ">

                        <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/nblymyuo.json" trigger="loop" delay="1000" colors="primary:#121331,secondary:#1663c7" style="width:150px;height:150px">
                        </lord-icon>

                        <div class="col border border-warning border-2  shadow-lg">
                            <h5 class="display-7 fst-italic fw-normal">Hey Champ! Join the Team. You got this.<br><a style="" href="register.php">Don't have an account?</a></h5>
                        </div>

                    </div>



                </form>
            </div>
        </div>

        <div class="card glassmorphic qotd">
            <div class="card-header">
                Quote of the day
            </div>

            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>In the end, we only regret the chances we didn't take.</p>
                    <footer class="blockquote-footer">Application Created by <cite title="Source Title">VapeFree Team</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
    <br>




</body>

</html>