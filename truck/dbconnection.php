<?php 
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) )
{
  header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
  die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
}

$servername = "sql105.infinityfree.com";
$username = "if0_35351118";
$password = "3z3K3nF60Dr9r7w";
$dbname = "if0_35351118_TruckDriver";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
