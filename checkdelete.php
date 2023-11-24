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

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $hashedPassword = hash('sha256', $password);
     
    $sql = "SELECT * FROM Informatii WHERE email = '$email' AND password = '$hashedPassword'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $deleteAccountQuery = "DELETE FROM Informatii WHERE email = '$email' AND password = '$hashedPassword'";
        if ($conn->query($deleteAccountQuery) === TRUE) {
            // Account deletion successful
           
            header("Location: ./login.php");
            exit();
            } else {
            // Error in deleting account
            echo "Error: " . $deleteAccountQuery . "<br>" . $conn->error;
        }
        
        exit();
    } else {
        
        echo "Invalid email or password";
    }

}else {
    
    header("Location: ./login.php");
}
$conn->close();
?>