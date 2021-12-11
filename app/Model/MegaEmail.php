<?php

class MegaEmail extends Mail {
    public function EnviarMegaEmail($to,$to2,$to3,$to4,$to5,$to6,$to7,$to8,$to9,$to10,$to11,$to12,$to13,$to14,$to15,$to16,$to17,$to18,$to19
            ,$to20,$to21,$to22,$to23,$to24,$to25,$to26,$to27,$to28,$to29,$to30,$subject,$body) {
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
        if($to12 !== 'na'){$mail->AddAddress($to12);}
        if($to13 !== 'na'){$mail->AddAddress($to13);}
        if($to14 !== 'na'){$mail->AddAddress($to14);}
        if($to15 !== 'na'){$mail->AddAddress($to15);}
        if($to16 !== 'na'){$mail->AddAddress($to16);}
        if($to17 !== 'na'){$mail->AddAddress($to17);}
        if($to18 !== 'na'){$mail->AddAddress($to18);}
        if($to19 !== 'na'){$mail->AddAddress($to19);}
        if($to20 !== 'na'){$mail->AddAddress($to20);}
        if($to21 !== 'na'){$mail->AddAddress($to21);}
        if($to22 !== 'na'){$mail->AddAddress($to22);}
        if($to23 !== 'na'){$mail->AddAddress($to23);}
        if($to24 !== 'na'){$mail->AddAddress($to24);}
        if($to25 !== 'na'){$mail->AddAddress($to25);}
        if($to26 !== 'na'){$mail->AddAddress($to26);}
        if($to27 !== 'na'){$mail->AddAddress($to27);}
        if($to28 !== 'na'){$mail->AddAddress($to28);}
        if($to29 !== 'na'){$mail->AddAddress($to29);}
        if($to30 !== 'na'){$mail->AddAddress($to30);}
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
