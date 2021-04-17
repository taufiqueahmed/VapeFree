<?php

include "config.php";

// Function defnition 
function alert($message)
{

    // Display the alert box  
    echo "<script>alert('$message');</script>";
}




//BUTTONS BEING CLICKED

if (isset($_POST['addNewForumEntry'])) {

    $newForumEntry = $_POST['newForumEntry'];
    $first_name = $_SESSION['first_name'];

    $sql = "INSERT INTO forum(first_name,forum_entry) VALUES('$first_name','$newForumEntry')";

    //check if a connection is made
    if ($con->query($sql) == TRUE) {
        //echo "A new forum entry was successfully added";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
    header('Location: feed.php');
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
    <title>Feed</title>
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

        <nav class="vape-nav">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="feed.php">FORUM</a></li>
                <li><a href="track.php">TRACKER</a></li>
            </ul>
        </nav>


        <div class="d-flex justify-content-evenly shadow-lg">
            <h1>Welcome to the Feed</h1>
        </div>
        
        <!--Adding a new journal entry -->
        <div class="form-group container text-center glassmorphic journal">
            <form action="feed.php" method="post">
                <label>What's on your mind?</label>
                <textarea class="form-control" name="newForumEntry" rows="3"></textarea>
                <button name="addNewForumEntry" class="btn btn-primary">Add Entry</button>
            </form>
        </div>
        
        <!-- FORUM -->
        <div class="glassmorphic">
            
            <table class="table table-striped">
                <tr class="text-center">
                    <th>Name</th>
                    <th>Entry</th>
                </tr>
                
                <!-- generate forum posts list -->
                <?php
                    $sql = "SELECT first_name,forum_entry FROM forum";
                    $result = mysqli_query($con, $sql);
                
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            print("<tr>");
                            print("<td>" . $row['first_name'] . "</td>");
                            print("<td>" . $row['forum_entry'] . "</td>");
                            print("</tr>");
                        }
                        
                    }
                ?>
            </table>
        </div>
    </div>
</body>

</html>
