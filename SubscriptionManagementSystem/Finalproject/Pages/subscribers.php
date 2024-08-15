<?php
session_start();



include("db.php");

// Fetch user data from the database
$sql = "SELECT name, email, subscription_status FROM Subscribers";
$result = $conn->query($sql);

// HTML code for displaying the user table
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriber List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #b0c4de; /* light slate blue main background */
            color: #000000; /* black font color */
        }
        .navbar {
            background-color: #483d8b; /* dark slate blue navbar */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">PHP Connect</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">About Us</a>
                </li>
            </ul>
        </div>
        <span class="navbar-text" >
        <?php
        //Carbon code start
        require "/Applications/XAMPP/xamppfiles/htdocs/vendor/autoload.php";
        use Carbon\Carbon;
        $userTimezone = "America/New_York";
        $currentTime = Carbon::now($userTimezone);
        echo"". $currentTime->format("F jS Y")."<br>".$currentTime->format("h:i:s");
        //Carbon end
        ?>
        </span>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h2>Subscribers List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subscription Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $subscription_status = ($row["subscription_status"] == 1)? "Yes" :"No";
                        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>".$subscription_status . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No subscribers found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
