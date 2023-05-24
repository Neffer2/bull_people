<?php
namespace App\Traits;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


trait EmailSender {
    // ========== [ Compose Email ] ================
    public function composeEmail($emailSubject,$emailBody,$email_to) {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            // Server settings
	        // $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;                      //Enable verbose debug output
		    $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'localhost';
            $mail->Port = 25; //or 3535 or 80 or 25
            $mail->SMTPAuth = true; //always
            $mail->Username = 'soporte@desarrollobullmarketing.com';   //  sender username
            $mail->Password = '_154hM8YQkLi';       // sender password
            $mail->SMTPAutoTLS = FALSE; //only if using port 465
 
            $mail->setFrom('soporte@desarrollobullmarketing.com', 'Empleo Bull Marketing');
            $mail->addAddress($email_to);
            $mail->addReplyTo('no-reply@mycomp.com','no-reply');	
            // $mail->addAddress($request->emailRecipient);
            // $mail->addCC($request->emailCc);
            // $mail->addBCC($request->emailBcc);

            // $mail->addReplyTo('sender-reply-email', 'sender-reply-name');

            // if(isset($_FILES['emailAttachments'])) {
            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
            //     }
            // }


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $emailSubject;
            $mail->Body    = $emailBody;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return back()->with("success", "Email has been sent.");
            }
        } catch (Exception $e) {
            return back()->withErrors("Message could not be sent.". $e);
        }
    }
}
