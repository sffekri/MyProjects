<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $subscription_status = isset($_POST["subscription"]) ? 1:0;

    $sql="delete FROM Subscribers WHERE email=?";
    $stmt = $conn ->prepare($sql);
    $stmt->bind_param("s", $email);
    if ($stmt->execute()){
        $stmt->close();
        header("location:index.php");
        exit();
    }else{
        echo "Error deleting subscription: " . $conn->error;
    }
    
} else{
    echo "Invalid request";
}
