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
         
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check which form was submitted
    if (isset($_POST['loginEmail']) && isset($_POST['loginPassword'])) {
        // Handle login form
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];
    
    //prevent sql injection 
    $sanitized_userid =   mysqli_real_escape_string($conn, $email); 
    $sanitized_password =  mysqli_real_escape_string($conn, $password); 
    $hashedPassword = hash('sha256', $sanitized_password);  
    
    $sql = "SELECT * FROM Informatii WHERE email = '" 
    . $sanitized_userid . "' AND password = '" 
    . $hashedPassword . "'"; 
        
        
        // Perform login logic by querying the database
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $_SESSION['query'] = $row['role'];
          if($_SESSION['query']  == 'worker' OR $_SESSION['query']  == 'Worker')
          {
            $_SESSION['id']  = $row['ID'];
          }
          $_SESSION['loggedin'] = True;
          $_SESSION['username'] = $email;
            header("Location: ./homepage.php");
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
            }
}
// Close the database connection
$conn->close();

?>

