
<?php


include ("db.php");
session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', 1);



//first check if the user has submitted the form.
if (isset($_POST["submit"])) {
    $name= $_POST['name'];
    $email= $_POST['email'];
    $password = $_POST['password'];
    $subscribe= isset($_POST['subscribe']) ? 1:0 ;

    // Hash the password
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
    $id = 0;
    $sql = "SELECT id From Subscribers WHERE email=?";
    $stmt = $conn->prepare($sql);   
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();


    if(empty($name) || empty($email)){
        echo "Please Enter both your email and name.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invalid email address";
    } elseif($id>0){
        echo "Email address already exists";
    }else{
        $sql= "INSERT INTO Subscribers (name, email,password, subscription_status) VALUES (?, ?, ?,?)";

        $stmt = $conn ->prepare($sql);
        if(!$stmt) {
            echo "Error preparing statement".$conn->error;
        }else{
        $stmt ->bind_param("sssi", $name, $email,$password, $subscribe);


        if($stmt ->execute()){
            $_SESSION["loggedin"] =true;
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            //user as admin condition
            if($name ==="Admin" && $email === "Admin@gmail.com" && $password === "admin123"){
                header("Location: subscribers.php"); // Redirect to subscriber.php
                exit();
            } else {
                header("Location: news.php"); // Redirect to news.php
                exit();
            }
        }else {
            echo "Error: ".$sql."<br>".$conn->error;
        }
        $stmt->close();
        }
    }}

    else{
    header("Location:index.php");
    exit;

}

$conn->close();
?>
