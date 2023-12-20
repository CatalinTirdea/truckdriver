<?php
session_set_cookie_params(['HttpOnly' => true, 'Secure' => true]);
session_start();


session_destroy();
header("Location: login.php");

?>
