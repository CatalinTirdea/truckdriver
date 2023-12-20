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
    $password = $_POST['password'];
    $sanitized_userid =   mysqli_real_escape_string($conn, $email); 
    $sanitized_password =  mysqli_real_escape_string($conn, $password); 
    $hashedPassword = hash('sha256', $sanitized_password);  
    
    $sql = "SELECT * FROM Informatii WHERE email = '" 
    . $sanitized_userid . "' AND password = '" 
    . $hashedPassword . "'";     
     
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $deleteAccountQuery = "DELETE FROM Informatii WHERE email = '$sanitized_userid' AND password = '$hashedPassword'";
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
            }}
$conn->close();
?>
