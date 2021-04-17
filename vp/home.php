<?php

include "config.php";

// Function defnition 
function alert($message)
{

    // Display the alert box  
    echo "<script>alert('$message');</script>";
}

$vapeSuggestions = array(
    "There’s a strong link between smoking and cardiovascular disease, and between smoking and cancer",
    "Quitting smoking is one of the best things you can do for your health — smoking harms nearly every organ in your body, including your heart.",
    "Talk to your doctor about what smoking cessation program or tools would be best for you."
);

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

if (isset($_POST['addNewEntry'])) {

    $newEntry = $_POST['newEntry'];

    $sql = "INSERT INTO journal(user_id,entry) VALUES('$user_id','$newEntry')";

    //check if a connection is made
    if ($con->query($sql) == TRUE) {
        echo "A new entry was successfully added";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}


if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
}


// $con->close();


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

    <!-- <!-- <link rel="stylesheet" type="text/css" href="css/util.css"> -->
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

    <div class="container-fluid">

        <!---Main header -->
        <div id="logo-header" class="text-center">
            <img id="logo" src="assets/vapefree_logo.png" alt="logo">
        </div>

        <nav class="glassmorphic-nav">
            <ul class="navbar">
                <li><a href="home.php">JOURNAL</a></li>
                <li><a href="track.php">TRACKER</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="index.php">LOGOUT</a></li>
            </ul>    
        </nav>
        
        <!--
        <div class="glassmorphic text-center">
            <h1>Welcome, <?php echo($_SESSION['first_name']) ?></h1>

            <form action="home.php" method="post" class="text-center">
                <button name="logout" class="btn btn-primary">Logout</button>
            </form>
        </div>
        -->
        
        <!-- this info should be in a seperate profile page where user can edit their info
        <!-- User Info
        <div class="container text-center display-3">
            <h1 class="display-3">User Info</h1><br>
            <h1 class="display-6">First Name: <?php print($_SESSION['first_name']) ?></h1>
            <h1 class="display-6">Last Name: <?php print($_SESSION['last_name']) ?></h1>
            <h1 class="display-6">Email: <?php print($_SESSION['user_email']) ?></h1>
        </div>
        -->
        
        <!-- healthy suggestions -->
        <div class="container text-center glassmorphic suggestions">
            <h1>Healthy Suggestions</h1>
            <?php printVapeSuggestions(); ?>
        </div>

        <!-- Personal Journal -->
        <div class="container text-center glassmorphic journal">
            <h1>Personal Journal</h1>

            <!--Adding a new journal entry -->
            <div class="form-group container text-center">
                <form action="home.php" method="post">
                    <label>Write a new entry</label>
                    <textarea class="form-control" name="newEntry" rows="3"></textarea>
                    <button id="add-entry" name="addNewEntry" class="btn btn-primary">Add</button>
                </form>
            </div>
            
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT j_id,user_id,entry FROM journal WHERE user_id='$user_id' ORDER BY j_id DESC";
        $result = $con->query($sql);
        ?>
            
        <table class="table table-striped">
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
