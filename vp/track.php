<?php

include "config.php";

// Function defnition 
function alert($message)
{
    // Display the alert box  
    echo "<script>alert('$message');</script>";
}



//Line Graph
$dataPoints = array(
    array("y" => 0, "label" => "0 ATTEMPT"),
);


function drawGraph()
{
    global $con, $dataPoints;
    $user = $_SESSION['user_id'];

    $sql = "SELECT attempt,duration FROM trackhistory WHERE user_id='$user'";
    $result = $con->query($sql);


    if ($result->num_rows > 0) {

        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $duration = $row['duration'];
            $attempt = $row['attempt'];

            $tempArray = array("y" => $duration, "label" => $attempt);
            array_push($dataPoints, $tempArray);
        }
    }
}





drawGraph();



$startDate = "";
$endDate = "";

//BUTTONS BEING CLICKED

if (isset($_POST['addNewEntry'])) {

    $newEntry = $_POST['newEntry'];

    $sql = "INSERT INTO journal(user_id,entry) VALUES('$user_id','$newEntry')";

    //check if a connection is made with the given query/check query
    if ($con->query($sql) == TRUE) {
        echo "A new entry was successfully added";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

if (isset($_POST['startDate'])) {
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    global $startDate;
    $startDate = $year . "/" . $month . "/" . $day;
    echo $startDate;

    $attempt = "";
    $previousDuration = "";

    $user_id = $_SESSION['user_id'];

    //CHECK IF USER DATA EXISTS IN THE VAPETRACK TABLE
    $userDataExists = false;
    $sql = "SELECT user_id,attempt,previousDuration FROM vapetrack WHERE user_id='$user_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) { //atleast 1 user
        $userDataExists = true;
    }





    if ($userDataExists == false) { //First Time using tracking

        $sql = "INSERT INTO vapetrack(currentStartDate,user_id) VALUES('$startDate','$user_id')";
        $con->query($sql);


        alert("A new start date" . $startDate . "was successfully entered!");
    } else {

        //values already exists for the user, then update data
        $sql = "UPDATE vapetrack SET currentStartDate='$startDate',currentEndDate=null WHERE user_id='$user_id'";
        $con->query($sql);

        alert("A new startdate " . $startDate . " was successfully updated!");
    }
}

if (isset($_POST['endDate'])) {

    global $startDate, $endDate;
    $attempt = "";
    $previousDuration = "";

    //Fetch the currentStartDate
    $user_id = $_SESSION['user_id'];



    $sql = "SELECT currentStartDate,attempt FROM vapetrack WHERE user_id='$user_id'";

    //check if a connection is made with the given query/check query
    if ($con->query($sql) == TRUE) {

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $startDate = $row['currentStartDate'];
                $attempt = $row['attempt'];
                $attempt++;
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];



    $endDate = $year . "/" . $month . "/" . $day;
    // echo "START DATE: " . $startDate;
    // echo "END DATE: " . $endDate;

    $date1 = date_create($startDate);
    $date2 = date_create($endDate);
    $diff = date_diff($date1, $date2);
    $duration = (int)$diff->format("%a");


    $newDuration = 1 + (int)$duration;



    $sql = "INSERT INTO trackhistory(user_id,attempt,duration) VALUES('$user_id','$attempt','$duration')";
    $con->query($sql);

    //set the duration and suggest duration/difference + 1 days to the user
    $sql = "UPDATE vapetrack SET currentStartDate=null, currentEndDate='$endDate',previousDuration='$duration',currentDuration='$newDuration',attempt='$attempt' WHERE user_id='$user_id'";
    $con->query($sql);


    alert("Good Job.Your vaping duration lasted " . $duration . " days . Try to make the next duration " . $newDuration . ". ");
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
    <title>Track</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- <!-- <link rel="stylesheet" type="text/css" href="css/util.css"> -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Vaping Duration in days per tracking attempt"
                },
                axisY: {
                    title: "Number of day(s) of vaping"
                },
                axisX: {
                    title: "Tracking Attempt"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

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


        <div class="d-flex justify-content-evenly shadow-lg">
            <h1>Welcome to the Vape Pod Tracking</h1>
        </div>



        <br>
        <br>

        <div class="container">
            <div class="row justify-content-md-center text-center"">
                <div class=" col border border-dark shadow">
                <h6 class="">ICON</h6>
                <svg xmlns=" http://www.w3.org/2000/svg" width="50" height="50" fill="blue" class="bi bi-droplet-half" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.21.8C7.69.295 8 0 8 0c.109.363.234.708.371 1.038.812 1.946 2.073 3.35 3.197 4.6C12.878 7.096 14 8.345 14 10a6 6 0 0 1-12 0C2 6.668 5.58 2.517 7.21.8zm.413 1.021A31.25 31.25 0 0 0 5.794 3.99c-.726.95-1.436 2.008-1.96 3.07C3.304 8.133 3 9.138 3 10c0 0 2.5 1.5 5 .5s5-.5 5-.5c0-1.201-.796-2.157-2.181-3.7l-.03-.032C9.75 5.11 8.5 3.72 7.623 1.82z" />
                    <path fill-rule="evenodd" d="M4.553 7.776c.82-1.641 1.717-2.753 2.093-3.13l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448z" />
                </svg>
            </div>
            <?php
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT currentStartDate FROM vapetrack WHERE user_id='$user_id'";
            $result = $con->query($sql);

            $startDateAlreadyExists = "";
            $startDate = "";

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if ($row['currentStartDate'] == null) {
                        $startDateAlreadyExists = false;
                    } else {
                        $startDateAlreadyExists = true;
                        $startDate = $row['currentStartDate'];
                    }
                }
            }
            ?>
            <?php if ($startDateAlreadyExists == false) { ?>
                <div class="col border border-dark shadow">
                    <h6>Step 1: Enter Start Date of a new pod</h6>
                    <form action="track.php" method="post">
                        <label>Day:</label>
                        <input type="number" placeholder="DD" name="day" min="1" max="31" required><br>
                        <label>Month:</label>
                        <input type="number" placeholder="MM" name="month" min="01" max="12" required><br>
                        <label>Year:</label>
                        <input type="number" placeholder="YY" name="year" min="2021" max="2021" value="2021" required><br>
                        <button type="submit" class="btn btn-success" name="startDate">Enter Start Date</button>
                    </form>
                </div>
            <?php } else { ?>
                <div class="col border border-dark shadow">
                    <h6>Current Start Date: </h6>
                    <form action="track.php" method="post">
                        <h5><?php echo "START DATE: " . $startDate; ?> </h5>
                    </form>
                </div>
            <?php

            } ?>



            <div class="col border border-dark shadow">
                <h6>Step 2: Enter End Date once pod is empty</h6>
                <form action="track.php" method="post">
                    <label>Day:</label>
                    <input type="text" placeholder="DD" name="day"><br>
                    <label>Month:</label>
                    <input type="number" placeholder="MM" name="month"><br>
                    <label>Year:</label>
                    <input type=" number" placeholder="YY" name="year" min="2021" max="2021" value="2021"><br>
                    <button type="submit" class="btn btn-danger" name="endDate" <?php if ($startDate == null) { ?>disabled<?php } ?>>Enter End Date</button>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>



    <br>
    <br>


    <h1 class="text-center text-primary">Consumption Graph</h1>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>


    <br>
    <br>

    <nav class="nav navbar-light bg-light d-flex justify-content-evenly shadow-lg nav-pills">
        <a class="nav-link" aria-current="page" href="home.php"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg><br>Home</a>
        <a class="nav-link active" href="track.php"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z" />
            </svg><br>Track</a>
        <a class="nav-link" href="feed.php"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
            </svg><br>Feed</a>

    </nav>

    <br>



    </div>
    <br>


    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</body>

</html>