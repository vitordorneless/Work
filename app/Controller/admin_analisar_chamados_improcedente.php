<?php

session_start();
require '../Model/Chamado.php';
require '../Model/Chamados.php';
require '../Model/Chamados_Improcedentes.php';
require '../Model/Mail.php';
require '../Model/Email.php';
include '../../class/ayuadame.php';

$id_chamado = filter_input(INPUT_POST, 'id_chamado', FILTER_SANITIZE_NUMBER_INT);
$protocolo = filter_input(INPUT_POST, 'protocolo', FILTER_SANITIZE_NUMBER_INT);
$executante = filter_input(INPUT_POST, 'executante', FILTER_SANITIZE_NUMBER_INT);
$data_ultima_alteracao = filter_input(INPUT_POST, 'data_ultima_alteracao', FILTER_SANITIZE_STRING);
$merge = filter_input(INPUT_POST, 'merge', FILTER_SANITIZE_STRING);
$obs = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);

$chamado = new Chamados_Improcedentes();
$chamado->set_id_chamado($id_chamado);
$chamado->set_protocolo($protocolo);
$chamado->set_data_abertura_chamado($data_ultima_alteracao);
$chamado->set_motivo_encerramento($merge);
$chamado->set_obs($obs);
$chamado->set_usuario_encerramento($_SESSION['user_id']);
$chamado->set_status(3);
$chamado->set_executante($executante);
$confirm = $chamado->save_Chamado_Improcedente($chamado->get_id_chamado(), $chamado->get_protocolo(), 
        $chamado->get_motivo_encerramento(), $chamado->get_obs(), $chamado->get_usuario_encerramento(), 
        $chamado->get_data_abertura_chamado());

if ($confirm === TRUE) {
    $chamado_aberto = new Chamados();
    $chamado_aberto->edit_status_Chamado($chamado->get_id_chamado(), $chamado->get_status(), $chamado->get_executante());
    $mail = new Email();
    $email_user = $_SESSION['email'];
    $body2 = "<h1>Chamado Improcedente gravado com Sucesso</h1>
              <p>Olá Seu chamado foi gravado em nosso sistema.</p>              
              <p>Motivo da improcedencia: <strong>$merge</strong></p>    
              <p>Observação da improcedencia: $obs</p>    
              <p>Protocolo número:<strong> $protocolo</strong></p>";
    $body = beginHTML() . $body2 . endHTML() . assinatura_HTML();
    $subject = "Chamado Improcedente - Protocolo: " . $protocolo;
    $file = FALSE;
    $mail->EnviarEmail($email_user, $subject, $body, $file);
    echo '<div class="alert alert-success" role="alert">Chamado Improcedente Gravado com Sucesso!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}