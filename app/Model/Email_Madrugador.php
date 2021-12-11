<?php

class Email_Madrugador extends Mail {

    public function EnviarEmail_Madrugada($to, $subject, $body, $file) {
        include '../../tools/PHPMailer/class.phpmailer.php';
        $dados_email = new Email();
        $dados_email->set_to($to);
        $dados_email->set_subject($subject);
        $dados_email->set_body($body);
        $file == FALSE ? "na" : $dados_email->set_anexo($file);
        $upipi = '../../uploads/chamados/encerramento_anexos/';
        $caminho = $upipi . $dados_email->get_anexo();
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->IsHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $mail->SMTPAuth = true;
        $mail->Host = 'mail.amars.com.br';
        $mail->Port = 587;
        $mail->Username = "web_service@amars.com.br";
        $mail->Password = "ama99730";
        $mail->From = "web_service@amars.com.br";
        $mail->FromName = "Grupo AMA Gestão";
        $mail->AddAddress($dados_email->get_to());
        $mail->AddAddress("sistemas@amars.com.br");
        $mail->AddAddress("web_service@amars.com.br");
        $mail->addCC("vitor@amars.com.br");
        if ($file !== 'na') {
            $mail->AddAttachment($caminho);
        }
        $mail->Subject = $dados_email->get_subject();
        $mail->Body = $dados_email->get_body();
        $sucess = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        return $sucess;
    }
}