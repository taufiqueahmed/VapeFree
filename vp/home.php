<?php


include "config.php";

// An alert message can be displayed to the end user
function alert($message)
{ 
    echo "<script>alert('$message');</script>";
}

//Array of suggestions
$vapeSuggestions = array(
    "There’s a strong link between smoking and cardiovascular disease, and between smoking and cancer",
    "Quitting smoking is one of the best things you can do for your health — smoking harms nearly every organ in your body, including your heart.",
    "Talk to your doctor about what smoking cessation program or tools would be best for you."
);

//Print the suggestions randomly
function printVapeSuggestions()
{
    $randomIndex = rand(0, 2); //min=0 and max=2 for now can change based on array items

    global $vapeSuggestions;

    print($vapeSuggestions[$randomIndex]);
}



//store first and last name
$email = $_SESSION['user_email'];
$sql = "SELECT first_name,last_name,user_id FROM user WHERE user_email='$email'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['user_id'] = $row['user_id'];
    }
}

//Printing journal entries
$user_id = $_SESSION['user_id'];
$sql = "SELECT j_id,user_id,entry FROM journal WHERE user_id='$user_id'";
$result = $con->query($sql);


//BUTTONS BEING CLICKED

//If addNewEntry is clicked, then add the journal entry
if (isset($_POST['addNewEntry'])) {


    $newEntry = $_POST['newEntry'];

    $sql = "INSERT INTO journal(user_id,entry) VALUES('$user_id','$newEntry')";

    //check if a connection is made
    if ($con->query($sql) == TRUE) {
        // echo "A new entry was successfully added";

        header('Location: journalSuccessPage.php');
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

//if logout is clicked, then redirect to index page
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@550&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="test.css">

</head>

<body>

    <!---All body contents-->
    <div class="container-fluid">

        <!---Main header -->
        <div id="logo-header" class="text-center">
            <img id="logo" src="assets/vapefree_logo.png" alt="logo">
        </div>

        <!---Navigation bar -->
        <nav class="nav navbar-light  d-flex justify-content-evenly shadow-lg nav-pills text-center glassmorphic-nav">
            <a class="nav-link active" aria-current="page" href="home.php"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                </svg><br>Home</a>
            <a class="nav-link" href="track.php"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z" />
                </svg><br>Tracker</a>
            <a class="nav-link" href="feed.php"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                </svg><br>Global Forum</a>
            <form action="home.php" method="post">
                <button name="logout" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg><br>Logout</button>
            </form>

        </nav>


        <!-- this info should be in a seperate profile page where user can edit their info
        <!-- User Info -->
        <div class="container text-center display-3 glassmorphic">
            <h1 class="display-3">User Info</h1><br>
            <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
            <lord-icon src="https://cdn.lordicon.com/fijnlyfo.json" trigger="loop" delay="1000" colors="primary:#121331,secondary:#1663c7" style="width:100px;height:100px">
            </lord-icon>
            <h6 class="display-6">First Name: <?php print($_SESSION['first_name']) ?></h6>
            <h6 class="display-6">Last Name: <?php print($_SESSION['last_name']) ?></h6>
            <h6 class="display-6">User ID: <?php print($_SESSION['user_id']) ?></h6>
            <h6 class="display-6">Email: <?php print($_SESSION['user_email']) ?></h6>
        </div>


        <!-- healthy suggestions -->
        <div class="container text-center glassmorphic suggestions">
            <h1>Healthy Suggestions</h1>
            <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
            <lord-icon src="https://cdn.lordicon.com/pithnlch.json" trigger="loop" delay="1000" colors="primary:#121331,secondary:#03a1fc" style="width:100px;height:100px">
            </lord-icon><br>
            <?php printVapeSuggestions(); ?>
        </div>

        <!-- Personal Journal -->
        <div class="container text-center glassmorphic journal">
            <h1>
                <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                <lord-icon src="https://cdn.lordicon.com/ufezupnm.json" trigger="loop" delay="1000" colors="primary:#121331,secondary:#2516c7" style="width:50px;height:50px">
                </lord-icon>Personal Journal
            </h1>

            <div class="container text-center ">

                <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
                <lord-icon src="https://cdn.lordicon.com/nblymyuo.json" trigger="loop" delay="1000" colors="primary:#121331,secondary:#1663c7" style="width:150px;height:150px">
                </lord-icon>

                <div class="col border border-warning border-2 shadow-lg">
                    <h5 class="display-7 fst-italic fw-normal">In your personal journal, you will be able to see and write your thoughts any time of the day about your vaping experience. It can help you reflect on your thoughts and see your progress.You got this champ.</h5>
                </div>

            </div>
            <br>

            <!--Adding a new journal entry -->
            <div class="form-group container text-center">
                <form action="home.php" method="post">
                    <label><b>Write a new entry</b></label>
                    <textarea class="form-control" name="newEntry" rows="3" required></textarea>
                    <button id="add-entry" name="addNewEntry" class="btn btn-primary">Add</button>
                </form>
            </div>
            <br>

            <?php
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT j_id,user_id,entry FROM journal WHERE user_id='$user_id' ORDER BY j_id DESC";
            $result = $con->query($sql);
            ?>

            <table class="table table-light table-striped">
                <tr>
                    <th>Entry ID</th>
                    <th>User ID</th>
                    <th>Journal Entry</th>
                </tr>

                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        print("<tr>");
                        print("<td>" . $row['j_id'] . "</td>");
                        print("<td>" . $row['user_id'] . "</td>");
                        print("<td>" . $row['entry'] . "</td>");
                    }
                }

                ?>

                <?php
                print("<tr>");

                print("</table>");

                ?>

        </div>

    </div>
    <br>




</body>

</html>