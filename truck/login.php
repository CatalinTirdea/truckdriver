<?php
session_set_cookie_params(['HttpOnly' => true, 'Secure' => true]);
session_start();
if(isset($_SESSION['loggedin'])){
  header('Location: homepage.php');
    
}
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>  
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            color: #007bff;
            margin-top: 10px;
        }

        .error {
            color: #ff0000;
            margin-top: 10px;
        }
    </style>
    <title>Login</title>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <form action="checklogin.php" method="post">
        <label for="loginEmail">Email:</label>
        <input type="email" id="loginEmail" name="loginEmail" required>

        <label for="loginPassword">Password:</label>
        <input type="password" id="loginPassword" name="loginPassword" required>
        <div class="g-recaptcha" data-sitekey="6LdrszUpAAAAAM2B4ciCayhFNrYxjvT1oGRknSrx"></div>

        <button type="submit">Login</button>
    </form>
 <p>Don't want to log in?   <a href = './homepage.php'>Continue as guest</a></p>
    <p>Don't have an account? <a href="./signup.php">Sign Up</a></p>
    <p>Forgot your password? <a href="./forgotpsswd.php">Change password</a></p>
   <p>Want to delete your account? <a href="./deleteacc.php" >Delete Account</a></p>
</div>
</body>
</html>

