<?php
session_start();

if (isset($_POST['name'])) {
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "appointment";

    $con = mysqli_connect($server, $user, $password, $database);
    if (!$con) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }

    $name = $_POST['name'];
    $number = $_POST['number'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $first = isset($_POST['first']) ? "yes" : "no";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $date = $_POST['date'];
    $time = $_POST['time'];
    $naration = $_POST['naration'];

    $sql = "INSERT INTO `appointment` (`name`, `number`, `city`, `age`, `first`, `gender`, `date`, `time`, `naration`) 
            VALUES ('$name', '$number', '$city', '$age', '$first', '$gender', '$date', '$time', '$naration')";

    if ($con->query($sql) === true) {
        $_SESSION['submitmsg'] = "Response has been Submitted";
    } else {
        $_SESSION['submitmsg'] = "ERROR: $sql <br> $con->error";
    }
    $con->close();

    header("Location: Appointment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <link rel="stylesheet" href="Appointment.css">
</head>
<body>
    <div class="container">
        <div class="body">
            <h1>New Appointment</h1>

            <?php
            if (isset($_SESSION['submitmsg'])) {
                echo "<p class='submitmsg'>" . $_SESSION['submitmsg'] . "</p>";
                unset($_SESSION['submitmsg']);
            }
            ?>

            <form action="Appointment.php" method="post">
                <div class="content">
                    <div class="first">
                        <img src="user.png" alt="user">
                        <input type="text" name="name" placeholder="Enter Name" required>
                        <img src="call.png" alt="phone">
                        <input type="text" name="number" placeholder="Enter Number" required>
                    </div>

                    <div class="second">
                        <img src="location.png" alt="location">
                        <input type="text" name="city" placeholder="Enter City" required>
                        <img src="age.png" alt="age">
                        <input type="number" name="age" placeholder="Enter Age" required>
                    </div>

                    <div class="third">
                        <input type="checkbox" name="first"> First Time
                        <input type="radio" name="gender" value="Male" required> Male
                        <input type="radio" name="gender" value="Female" required> Female
                    </div>

                    <div class="fourth">
                        <img src="age.png" alt="date">
                        <input type="date" name="date" required>
                        <img src="time.png" alt="time">
                        <input type="time" name="time" required>
                    </div>

                    <div>
                        <img src="naration.png" alt="narration">
                        <textarea name="naration" placeholder="Enter narration" required></textarea>
                    </div>

                    <div class="btn">
                        <button type="submit">Book Appointment</button>
                    </div>
                </div>
            </form>
        </div>
        
        <img src="doc.png" class="doc" alt="doctor illustration">
    </div>
</body>
</html>
