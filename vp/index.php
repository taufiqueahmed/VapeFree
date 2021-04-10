<?php

include "config.php";

// Function defnition 
function alert($message)
{

    // Display the alert box  
    echo "<script>alert('$message');</script>";
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        function showMoreDetailsForVapeTracking() {
            if (document.getElementById("showMoreDetailsForVapeTracking").innerHTML == "") {

                document.getElementById("showMoreDetailsForVapeTracking").innerHTML = "- For example, if the difference between the end date and the beginning date in order to finish a 2ml pod is 3 days, we would then suggest to our user to stretch the end date, to make the difference to 5 days.As a result, a user will be encouraged to vape less to reach the goal.<br>";

            } else {
                document.getElementById("showMoreDetailsForVapeTracking").innerHTML = "";
            }

        }

        function showMoreDetailsForVapeGlobalForum() {
            if (document.getElementById("showMoreDetailsForVapeGlobalForum").innerHTML == "") {

                document.getElementById("showMoreDetailsForVapeGlobalForum").innerHTML = "- A global forum can be utilized to share common thoughts. <br>";

            } else {
                document.getElementById("showMoreDetailsForVapeGlobalForum").innerHTML = "";
            }

        }

        function showMoreDetailsForVapeJournal() {
            if (document.getElementById("showMoreDetailsForVapeJournal").innerHTML == "") {

                document.getElementById("showMoreDetailsForVapeJournal").innerHTML = "- For the end users that want to keep their thoughts to themselves, they can use a builtin in journal to write their thoughts. These thoughts should be based on their vaping experiences.They can be positive or negative thoughts.<br>";

            } else {
                document.getElementById("showMoreDetailsForVapeJournal").innerHTML = "";
            }

        }
    </script>



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



        <div class="container shadow-lg  ">
            <h1 class="display-6"> What is VapeFree?</h1>

            <svg class="bounce " xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />

            </svg>
            <span class="" style=" margin-left: 40px;">An Application that allows the user to keep track and give them feedback on their vape usage</span>
        </div>
        <br>

        <div class="container shadow-lg  ">
            <h1 class="display-6"> How do we keep track of vape usage?</h1>

            <svg class="bounce " xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />

            </svg>
            <span class="" style=" margin-left: 40px;">( 1 ) VapeFree will request the user to input the beginning and end date of a nicotine pod.<br></span>
            <span class="" style=" margin-left: 75px;">( 2 ) The time lapse would be an index of their vaping usage.<br></span>
            <br>

        </div>

        <br>

        <div class="container shadow-lg  ">
            <h1 class="display-6"> How do we provide feedback for vape usage?</h1>

            <svg class="bounce " xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />

            </svg>
            <span class="" style=" margin-left: 40px;">( 1 ) VapeFree will utilize the user's time lapse data to suggest and stretch a new end date for the next pod consumption.<button class="btn btn-link " onclick="showMoreDetailsForVapeTracking()">More Details</button> <br></span>
            <div class="container border border-primary shadow-lg" id="showMoreDetailsForVapeTracking"></div>


            <span class="" style=" margin-left: 75px;">( 2 ) VapeFree will allow users to share their thoughts in a global forum.<button class="btn btn-link " onclick="showMoreDetailsForVapeGlobalForum()">More Details</button><br></span>
            <div class="container border border-primary shadow-lg" id="showMoreDetailsForVapeGlobalForum"></div>
            <span class="" style=" margin-left: 75px;">( 3 ) VapeFree will allow users to journal their thoughts.<button class="btn btn-link " onclick="showMoreDetailsForVapeJournal()">More Details</button><br></span>
            <div class="container border border-primary shadow-lg" id="showMoreDetailsForVapeJournal"></div>
            <br>

        </div>

        <br>
        <div class="container shadow-lg  ">
            <h1 class="display-6"> Join VapeFree?</h1>


            <span class="" style=" margin-left: 40px;">
                <form action="index.php" method="post">
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </form>
            </span>
        </div>

        <br>


        <div class="d-flex justify-content-evenly shadow-lg">


            <form action="index.php" method="post" style="display: inline-block;">
                <div class="mb-3">
                    <h3 class="display-6">Existing User</h3>
                    <br>
                    <br>
                    <label class="form-label text-dark fw-bold display-8">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-dark fw-bold display-8">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-primary" name="login">Login</button>
            </form>

        </div>

        <br>
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

    </div>
    <br>




</body>

</html>