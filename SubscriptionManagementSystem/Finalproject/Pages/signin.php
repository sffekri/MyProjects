<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

session_start();

// Check if the form is submitted
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both email and password are provided
    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $entered_password = $_POST["password"];

        include("db.php"); 

        //if the email and password match
        $sql = "SELECT id, name, email, password FROM Subscribers WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $email, $stored_password); //$hashed_password);
                    if ($stmt->fetch()) {
                        /// Debugging: Output stored password and entered password
                        //echo "Stored Password: " . $stored_password . "<br>";
                        //echo "Entered Password: " . $entered_password . "<br>";

                        // Verify the entered password against the stored hashed password
                        if ($entered_password === $stored_password){//(password_verify($password, $hashed_password)) {
                            // Password is correct
                            if($email === "Admin@gmail.com" && $entered_password === "admin123"){                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["email"] = $email;
                            header("Location: subscribers.php");
                            exit;
                        } else {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["email"] = $email;
                            header("Location: news.php");
                            exit;
                        }
                        } else {
                            // Password is incorrect
                            $password_err = "The password you entered is incorrect.";
                        }
                        
                    }
                } else {
                    // No account found with that email
                    $email_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
        $conn->close();
    } else {
        // Email or password not provided
        $email_err = "Please enter your email.";
        $password_err = "Please enter your password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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

    <!-- Sign In Form -->
    <div class="container mt-4">
        <h2>Sign In</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
            <p>Don't have an account? <a href="index.php">Sign up now</a>.</p>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
