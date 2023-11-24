<?php

$servername = "sql105.infinityfree.com";
$username = "if0_35351118";
$password = "3z3K3nF60Dr9r7w";
$dbname = "if0_35351118_TruckDriver";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    
    // Hash the password before storing it in the database
    $hashedPassword = hash('sha256', $password);
    
    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM Informatii WHERE email = '$email'";
    $checkResult = $conn->query($checkEmailQuery);
    
    if ($checkResult->num_rows > 0) {
        // Email already exists, handle accordingly (e.g., show an error message)
        echo "Error: This email is already registered.";
    } else {
        // Perform signup logic by inserting data into the database
        $insertQuery = "INSERT INTO Informatii (email, password) VALUES ('$email', '$hashedPassword')";
    
        if ($conn->query($insertQuery) === TRUE) {
            // Signup successful
            // Redirect to index.php after successful signup
            header("Location: index.php");
            exit();
        } else {
            // Error in signup
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
    
    }else {
        // Redirect to the login page if someone tries to access this file directly
        header("Location: login.php");
       
    }

    $conn->close();


?>