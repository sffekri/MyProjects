<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);



include("db.php");

$subscription_status = 0;

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ) {
    $email= $_SESSION["email"];

    $sql = "SELECT subscription_status From Subscribers WHERE email=?";
    $stmt = $conn->prepare($sql);   
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($subscription_status);
    $stmt->fetch();
    $stmt->close();
}else{
    $subscription_status = 0;
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News page</title>
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

        .navbar-text {
            color: white; /* White font color */
            margin-right: 20px; /* Adjust the right margin */
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
        <!-- Profile Indicator -->
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
            <span class="navbar-text mr-2 dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>
                <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="updateaccount.php" style="color: #483d8b;">Manage Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php" style="color: #483d8b;">Logout</a>
                </div>
            </span>
        <?php endif; ?>
        
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
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Topic 1
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lorem ipsum</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor iaculis ultricies. Suspendisse ante arcu, aliquam et gravida vel, posuere et turpis.</p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Topic 2
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lorem ipsum</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor iaculis ultricies. Suspendisse ante arcu, aliquam et gravida vel, posuere et turpis.</p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            <?php if($subscription_status == 1) : ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Topic 3
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lorem ipsum</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor iaculis ultricies. Suspendisse ante arcu, aliquam et gravida vel, posuere et turpis.</p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Topic 4
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lorem ipsum</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam porttitor iaculis ultricies. Suspendisse ante arcu, aliquam et gravida vel, posuere et turpis.</p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>