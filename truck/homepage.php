
<?php
session_set_cookie_params(['HttpOnly' => true, 'Secure' => true]);
session_start();

?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="./style.css"> 
    <title>HomePage</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   
  </head>
  <body>
  <div class="navbar">

   <img src="./resources/i03435ra8mhgrbuj87a634bge3.png" alt="Logo" width ="125px" height = "100px" >
   <div class="navbar-links"><a href="./homepage.html">Home</a></div>
   <div class="navbar-links"> <a href="./index.php">About</a></div>
<?php 
if(isset($_SESSION['query'])){
  if($_SESSION['query'] == 'worker'){
echo ' <div class="navbar-links"><a href="./truck.php">Your Truck</a></div>'; 
  }
}
?>   

   <?php
  if(isset($_SESSION['query'])){
    if($_SESSION['query'] == 'admin' OR $_SESSION['query'] == 'Admin'){
      echo '  <div class="navbar-links"><a href="statistics.php">Page Statistics</a></div>';
    }
  }
?> 
   <?php 
    if(isset($_SESSION["loggedin"])){
      echo'<div class="navbar-links" style ="color:white; text-decoration:none;margin:0 15px;">Role: '.$_SESSION['query'] . '</div>';
      echo '<div class="navbar-links" style ="color:white; text-decoration:none;margin:0 15px;"><a href="./logout.php">'.$_SESSION["username"].'</br>Logout</a></div>';
      

}else{
        
      echo  '<div class="navbar-links"><a href="./login.php">Login</a></div>';
     }
      
    ?> 
    </div>
  
    <h1>Informații despre Firmă</h1>

<p>Firma noastră de camioane este dedicată furnizării unor servicii de transport de înaltă calitate. Iată mai multe detalii despre activitatea noastră:</p>

<ul>
    <li>Numărul total de camioane: 50</li>
    <li>Numărul de șoferi angajați: 35</li>
    <li>Tipuri de camioane disponibile: transport de mărfuri generale, camioane frigorifice, camioane cu remorcă, camioane speciale pentru transportul mărfurilor periculoase.</li>
    <li>Acoperire geografică: Oferim servicii de transport în întreaga țară și în țările vecine.</li>
    <li>Politica de siguranță: Suntem angajați în asigurarea siguranței atât a mărfurilor transportate, cât și a personalului nostru.</li>
    <li>Flota noastră este dotată cu cele mai recente tehnologii de urmărire și gestionare a flotelor pentru a asigura o logistică eficientă.</li>
</ul>

<p>Ne străduim să oferim clienților noștri soluții de transport fiabile și eficiente, bazate pe profesionalismul și experiența echipei noastre de șoferi.</p>
<p>Mai jos gasiti cateva informatii generalizate despre noi.(Sursa wikipedia)</p>

<?php
$url = 'https://en.wikipedia.org/wiki/Truck_driver';


$html = file_get_contents($url);

if ($html !== false) {
    // Crează un obiect DOMDocument
    $dom = new DOMDocument();

    // Suprimă erorile XML pentru a evita afișarea lor în timpul parsării
    libxml_use_internal_errors(true);

    // Încarcă conținutul HTML în DOMDocument
    $dom->loadHTML($html);

    // Restaurează afișarea erorilor XML
    libxml_use_internal_errors(false);

    // Obține primul element h1
    $firstHeading = $dom->getElementsByTagName('h1')->item(0);

    // Obține primele două paragrafe de text
    $paragraphs = $dom->getElementsByTagName('p');
    $firstTwoParagraphs = '';
    for ($i = 0; $i < 2 && $i < $paragraphs->length; $i++) {
        $firstTwoParagraphs .= $paragraphs->item($i)->textContent . '<br>';
    }

    // Afișează titlul și primele două paragrafe
    echo '<h1>' . $firstHeading->textContent . '</h1>';
    echo $firstTwoParagraphs;
} else {
    // Afișează un mesaj de eroare în cazul în care nu s-a putut obține conținutul
    echo 'Eroare la obținerea conținutului de la ' . $url;
}
?>

<?php if(isset($_SESSION['loggedin'])){
echo '<div class="contact-form">
    <h2>Contacteaza-ne pentru un job sau alte informatii! </h2>
   <form action="verify_recaptcha.php" method="post">
   <div class="label">Nume:</div>
			<div class="field">
				<input type="text" id="name" name="name" class="required" aria-required="true" required>
			</div>
   <div class="label">Email:</div>
			<div class="field">			
				<input type="text" id="email" name="email" class="required email" aria-required="true" required>
			</div>
   <div class="label">Telefon:</div>
			<div class="field">			
				<input type="text" id="phone" name="phone" class="required phone" aria-required="true" required>
			</div>
    <div class="label">Mesaj:</div>
			<div class="field">			
				<textarea id="comment-content" name="content"></textarea>			
			</div>
    
    <div class="g-recaptcha" data-sitekey="6LdrszUpAAAAAM2B4ciCayhFNrYxjvT1oGRknSrx"></div>
	<input class="btn btn-info" type="submit" name="submit" value="SUBMIT" >
</form>';
}else{
  echo'<h1>Ca sa accesezi formularul trebuie sa te loghezi!</h1>';
}
?>
</div>


  </body>
</html>
