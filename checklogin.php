<?php

// Replace these values with your actual database credentials
$servername = "sql105.infinityfree.com";
$username = "if0_35351118";
$password = "3z3K3nF60Dr9r7w";
$dbname = "if0_35351118_TruckDriver";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which form was submitted
    if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
        // Handle login form
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        // Hash the password (for security, always hash and verify passwords)
        $hashedPassword = hash('sha256', $password);

        // Perform login logic by querying the database
        $sql = "SELECT * FROM Informatii WHERE email = '$email' AND password = '$hashedPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, login successful
            // Redirect to index.php after successful login
            header("Location: ./index.php");
            exit();
        } else {
            // User not found or incorrect password
            echo "Invalid email or password";
        }
    } else {
    // Redirect to the login page if someone tries to access this file directly
    header("Location: login.php");
   
}
}
// Close the database connection
$conn->close();

?>