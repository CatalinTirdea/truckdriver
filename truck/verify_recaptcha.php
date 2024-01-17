<?php
session_set_cookie_params(['HttpOnly' => true, 'Secure' => true]);
session_start();
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) )
{
  header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
  die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
}
?>

<?php 
 
 
if(isset($_POST['submit'])){ 
    
	// Form fields validation check
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])){ 
         
        // reCAPTCHA checkbox validation
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secret_key = '6LdrszUpAAAAADCQbhW_3AriTxHjkfm_uhgqriWG';
             
            // reCAPTCHA response verification
            $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
            
            // Decode reCAPTCHA response 
            $verify_response = json_decode($verify_captcha); 
             
            // Check if reCAPTCHA response returns success 
            if($verify_response->success){ 
                
                $name = $_POST['name']; 
                $email = $_POST['email']; 
                $phone = $_POST['phone'];
				$message = $_POST['content'];
             
                #email Gmail
				require_once('./phpmailer/class.phpmailer.php');
				require_once('./phpmailer/mail_config.php');
				

				$mailBody = "User Name: " . $name . "\n";
				$mailBody .= "User Email: " . $email . "\n";
				$mailBody .= "Phone: " . $phone . "\n";
				$mailBody .= "Message: " . $message . "\n";
				
				$mail = new PHPMailer(true); 

				$mail->IsSMTP();

				try {
				 
				  
 $mail->SMTPDebug  = 0;                     
  $mail->SMTPAuth   = true; 

  $toEmail='tirdea.catalin@gmail.com';
  $nume='Daw Project';

  $mail->SMTPSecure = "ssl";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port       = 465;                   
  $mail->Username   = $username;  			// GMAIL username
  $mail->Password   = $password;            // GMAIL password
  $mail->AddReplyTo('tirdea.catalin@yahoo.com', 'Daw Project');
  $mail->AddAddress($toEmail, $nume);
 $mail->addBcc("tirdea.catalin@gmail.com");
  $mail->SetFrom($email, $name);
  $mail->Subject = 'Formular Contact';
  $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
  $mail->MsgHTML($mailBody);
  $mail->Send();
                         //!!!!!! DACA VREAU SA TRIMIT MAIL TREBUIE DOAR =SA INVERSEZ AddAddress si SetFrom!!!!  
				  
                  $returnMsg = 'Your message has been submitted successfully.'; 
  $nume='Formular Truck Driver';

  $mail->SMTPSecure = "ssl";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port       = 465;                   
  $mail->Username   = $username;  			// GMAIL username
  $mail->Password   = $password;            // GMAIL password
  $mail->AddReplyTo('tirdea.catalin@yahoo.com', 'Daw Project');
  $mail->AddAddress($email, $name);
 $mail->addBcc("tirdea.catalin@gmail.com");
  $mail->SetFrom($toEmail, $nume);
  $mail->Subject = 'Formular Contact';
  $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
  $mail->MsgHTML("Multumim pentru interes. Dorim sa va informam ca formularul a fost trimis cu succes!");
  $mail->Send();

  require_once('./FPDF/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Courier', 'B', 16);

                //$name = $_POST['name']; 
                //$email = $_POST['email']; 
                //$phone = $_POST['phone'];
// $message = $_POST['content'];
$pdf->Cell(40, 10, 'Nume: ' . $name);
$pdf->Ln();
$pdf->Cell(40, 10, 'E-mail: ' . $email);
$pdf->Ln();
$pdf->Cell(40, 10, 'Telefon: ' . $phone);
$pdf->Ln();
$pdf->Cell(40, 10, 'Mesaj: ' . $message);
$name = $message = $message = $phone = '';
// Salvează sau afișează PDF-ul
$pdf->Output('formular.pdf', 'D');

    exit; 
        
        }
                 catch (phpmailerException $e) {
												  echo $e->errorMessage(); //error from PHPMailer
												}
				 
            } 
        }
		  else{ 
            
			$returnMsg = 'Please check the CAPTCHA box.'; 
        } 
    }
	 else
			{ 
				$returnMsg = 'Please fill all the required fields.'; 
			} 
} 
header("Location: ./homepage.php");
?>





