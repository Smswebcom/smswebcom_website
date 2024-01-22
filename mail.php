<?php
//Import PHPMailer classes into the global name space
//There must be at the top of the script not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exeption;

//Load composer's autoloader
require_once __DIR__ . '/vendor/autoload.php';

//create an instance; passing.'true'
$errors = [];
$errorMessage = '';
$secret =('');

if (!empty($_POST)) {
    $sendername = $_POST['sender name'];
    $cc = $_POST['cc'];
    $bcc = $_POST['bcc'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}";
    $verify = json_decode(file_get_contents($recaptchaUrl));

    if (empty($sendername)) {
        $errors[] = 'Sendername is empty';
    }

    if (empty($cc)) {
        $errors[] = 'cc is empty';
    } else if (!filter_var($cc, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }
    
    if (empty($bcc)) {
        $errors[] = 'bcc is empty';
    }

    if (empty($subject)) {
        $errors[]='subject';
    }


    if (empty($message)) {
        $errors[] = 'Message is empty';
    }

    if (!empty($errors)) {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    } else {
    
        $toEmail = 'example@example.com';
        $emailSubject = 'New email from smswecom';
        $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];

        $bodyParagraphs = ["Sendername: {$sendername}", "CC: {$cc}","BCC: {$bcc}","Subject: {$suject}", "Message:", $message];
        $body = join(PHP_EOL, $bodyParagraphs);

        if (mail($toEmail, $emailSubject, $body, $headers)) {
            header('Location: thank-you.html');
        } else {
            $errorMessage = "<p style='color: red;'>Oops, something went wrong. Please try again later</p>";
        }
    }
}

$resultMessage = '';

if (!empty($_FILES["attachment"])) {
  // create a new object
  $mail = new PHPMailer();


       // specify SMTP credentials


        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'smtp.example.com';
        $mail->Password = 'secret';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;
        $mail->setFrom($email, 'Mailtrap Website');
        $mail->addAddress('example@example.com', 'Me');
        $mail->Subject = 'New message from your website';$mail->setFrom('address.from@example.com', 'Address from');
        $mail->addAddress('address.to@example.com', 'Address to');
        $mail->Subject = 'Email with attachment';
        $mail->isHTML(true);
        
      
        $mail->AddAttachment($_FILES["attachment"]["tmp_name"], $_FILES["attachment"]["name"]);
      
       if($mail->send()) {
          $resultMessage = 'Message has been sent';
        } else {
          $resultMessage = 'Message could not be sent.';
        }
      
      }



        // Enable HTML if needed
        $mail->isHTML(true);
        $bodyParagraphs = ["Sender name: {$sendername}", "CC: {$cc}", "BCC:{$bcc}", "Subject: {$subject}", "Message: {$message}"];
        $body = join('<br />', $bodyParagraphs);
        $mail->Body = $body;
        echo $body;

        if ($mail->send()) {
            header('Location: thank-you.html'); // Redirect to 'thank you' page. Make sure you have it
        } else {

            $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $mail->ErrorInfo;
        }


        //Recipients
        $mail->setFrom('from@example.com','Mailer');
        $mailer->addAddress('Joe@example.com');         //Add a recipient
        $mailer->addAddress('Ellen@example.com');       //Optional name
        $mailer->addReplyTo('info@example.com','Information');
        $mailer->addCC('cc@example.com');
        $mailer->addBCC('bcc@example.com');
        @mail($email_to, $emaial_sendername, $email_subject, $email_message, $heasers);

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar..gz');    //Add attachment
        $mail->addAttachment('/tmp/image.jpg','new.jpg','pdf','doc','docx','png','jpeg')

         if ($mail->send()) {
            $resultMessage = 'Message has been sent';
          } else{
            $resultMessage = 'Message could not be sent';
          }
           
        
?>




  

