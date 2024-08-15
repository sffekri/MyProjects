
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
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
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <h1>Welcome to PHP Connect</h1>
        <p class="lead">Your gateway to the latest in tech news focusing on PHP and its related fields.</p>
        <!-- Subscription Form -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create an account and subscribe now to stay updated on the newest developments, trends, and innovations in the PHP ecosystem.</h2>
                <form action="subscribe.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" id="subscribe" name="subscribe" class="form-check-input">
                        <label class="form-check-label" for="subscribe">Subscribe to newsletter</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Subscribe</button>

                    <p style="font-size: 11px; margin-top: 10px; " > Already have an account? <a href=signin.php >Sign in<a></p>
                </form>
            </div>
        </div>
    </div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>