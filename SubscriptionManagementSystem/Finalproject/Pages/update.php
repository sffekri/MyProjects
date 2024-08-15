<?php
include("db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $subscription_status = isset($_POST["subscription"]) ? 1:0;

    $sql="UPDATE Subscribers SET subscription_status = ? WHERE email=?";
    $stmt = $conn ->prepare($sql);
    $stmt->bind_param("is", $subscription_status, $_SESSION["email"]);
    if ($stmt->execute()){
        $_SESSION["subscription_status"] = $subscription_status;
        $stmt->close();
        header("location: news.php");
        exit();
    }else{
        echo "Error updating subscription: " . $conn->error;
    }
    
} else{
    echo "Invalid request";
}