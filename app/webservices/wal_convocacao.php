<?php
require '../Model/Mail.php';
require '../Model/SuperEmail.php';
$mail = new SuperEmail();
$confirm = $mail->EnviarSuperEmail('vitordorneles@hotmail.com', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'teste', 'teste');
echo $confirm == TRUE ? 'aee' : 'errou';