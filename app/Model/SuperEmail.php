<?php

class SuperEmail extends Mail{
    public function EnviarSuperEmail($to,$to2,$to3,$to4,$to5,$to6,$to7,$to8,$to9,$to10,$to11,$subject,$body) {
        include '../../tools/PHPMailer/class.phpmailer.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->IsHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true;
        $mail->Host = 'mail.amars.com.br';
        $mail->Port = 587;
        $mail->Username = "sistemas@amars.com.br";
        $mail->Password = "ama@2015";
        $mail->From = "sistemas@amars.com.br";
        $mail->FromName = "Grupo AMA Gestão";
        if($to !== 'na'){$mail->AddAddress($to);}
        if($to2 !== 'na'){$mail->AddAddress($to2);}
        if($to3 !== 'na'){$mail->AddAddress($to3);}
        if($to4 !== 'na'){$mail->AddAddress($to4);}
        if($to5 !== 'na'){$mail->AddAddress($to5);}
        if($to6 !== 'na'){$mail->AddAddress($to6);}
        if($to7 !== 'na'){$mail->AddAddress($to7);}
        if($to8 !== 'na'){$mail->AddAddress($to8);}
        if($to9 !== 'na'){$mail->AddAddress($to9);}
        if($to10 !== 'na'){$mail->AddAddress($to10);}
        if($to11 !== 'na'){$mail->AddAddress($to11);}
        $mail->addCC("sistemas@amars.com.br");
        $mail->addBCC("vitor@amars.com.br");        
        $mail->addBCC("vitorcavalovapor@gmail.com");
        $mail->addBCC("vitordorneles@hotmail.com");
        $mail->Subject = $subject;
        $mail->Body = $body;
        $sucess = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        return $sucess;
    }
}
