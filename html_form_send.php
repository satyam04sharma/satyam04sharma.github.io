<?php
if(isset($_POST['contactForm'])) {
    $email_to = "satyam04sharma@gmail.com";
     
    $email_subject = "Website html form submissions";
     
     
    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $contactName = $_POST['name']; 
    $contactEmail = $_POST['email'];
    $contactSubject = $_POST['subject'];
    $contactMessage = $_POST['message'];
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$contactEmail)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$contactName)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$contactSubject)) {
    $error_message .= 'The Subject you entered does not appear to be valid.<br />';
  }
  if(strlen($contactMessage) < 2) {
    $error_message .= 'The Message you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($contactName)."\n";
    $email_message .= "Email: ".clean_string($contactEmail)."\n";
    $email_message .= "Subject: ".clean_string($contactSubject)."\n";
    $email_message .= "Message: ".clean_string($contactMessage)."\n";
     
     
$headers = 'From: '.$contactEmail."\r\n".
'Reply-To: '.$contactEmail."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
}
die();
?>
