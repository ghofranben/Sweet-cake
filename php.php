<?php
$cntDisplay = "none";
// Handle back functionality:
if (isset($_POST['add'])) { 
    $cntDisplay = "grid";
}

//login
    $username = $_POST['username'];
    $password = $_POST['password'];
    //database connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "login";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    if($conn->connect_error){
        die("connection failed: ". $conn->connect_error);
    }

    //validate login
    $query = "SELECT *FROM logintab WHERE username='$username' AND password='$password'";

    $result = $conn->query($query);

    if($result->num_rows == 1){
        header("location: prodact.php");
        exit();
    }else{
        header("location: error.html");
        exit();
    }
    $conn->close();
?>
