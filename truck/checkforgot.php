<?php
session_set_cookie_params(['HttpOnly' => true, 'Secure' => true]);
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) )
{
  header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
  die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
}


include 'dbconnection.php';

if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secret_key = '6LdrszUpAAAAADCQbhW_3AriTxHjkfm_uhgqriWG';
             
            // reCAPTCHA response verification
            $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
            
            // Decode reCAPTCHA response 
            $verify_response = json_decode($verify_captcha); 
             
            // Check if reCAPTCHA response returns success 
            if($verify_response->success){ 
         
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    
    $sanitized_email =   mysqli_real_escape_string($conn, $email); 
    $sanitized_currentPassword =  mysqli_real_escape_string($conn, $currentPassword); 
    $sanitized_newPassword = mysqli_real_escape_string($conn, $newPassword);
    $santizide_confirmNewPassword = mysqli_real_escape_string($conn, $confirmNewPassword);    
    
    $hashedCurentPassword = hash('sha256', $sanitized_currentPassword);  
    
    $sql = "SELECT * FROM Informatii WHERE email = '" 
    . $sanitized_email . "' AND password = '" 
    . $hashedCurentPassword . "'"; 
          
    $hashedNewPassword = hash('sha256', $sanitized_newPassword);
    
   
    $verifyResult = $conn->query($sql);
    
    if ($verifyResult->num_rows > 0) {
        // Current password is correct, proceed with password change
        if ($sanitized_newPassword === $santizide_confirmNewPassword) {
            // Update the password in the database
            $updatePasswordQuery = "UPDATE Informatii SET password = '$hashedNewPassword' WHERE email = '$email'";

            if ($conn->query($updatePasswordQuery) === TRUE) {
                // Password change successful
                header('Location: login.php');
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
            }
}
$conn->close();
?>
