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
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    
    $hashedCurrentPassword = hash('sha256', $currentPassword);
    $hashedNewPassword = hash('sha256', $newPassword);
    
    $verifyPasswordQuery = "SELECT * FROM Informatii WHERE email = '$email' AND password = '$hashedCurrentPassword'";
    $verifyResult = $conn->query($verifyPasswordQuery);
    
    if ($verifyResult->num_rows > 0) {
        // Current password is correct, proceed with password change
        if ($newPassword === $confirmNewPassword) {
            // Update the password in the database
            $updatePasswordQuery = "UPDATE Informatii SET password = '$hashedNewPassword' WHERE email = '$email'";

            if ($conn->query($updatePasswordQuery) === TRUE) {
                // Password change successful
                echo "Password changed successfully!";
            } else {
                // Error in updating password
                echo "Error: " . $updatePasswordQuery . "<br>" . $conn->error;
            }
        } else {
            // New passwords do not match
            echo "Error: New passwords do not match.";
        }
    } else {
        // Incorrect current password
        echo "Error: Incorrect current password.";
    }
}
$conn->close();
?>