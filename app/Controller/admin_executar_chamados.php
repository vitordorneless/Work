<?php

session_start();
require '../Model/Chamado.php';
require '../Model/Chamados_Encerrar.php';
require '../Model/Chamados.php';
require '../Model/Chamados_Analise.php';
require '../Model/Mail.php';
require '../Model/Email.php';
require '../Model/Usuario.php';
require '../Model/Usuarios.php';
require '../Model/Status.php';
include '../../class/ayuadame.php';

$chamado_encerrado = new Chamados_Encerrar();
$chamado_encerrado->set_id_chamado(filter_input(INPUT_POST, 'id_chamado', FILTER_SANITIZE_NUMBER_INT));
$chamado_encerrado->set_protocolo(filter_input(INPUT_POST, 'protocolo', FILTER_SANITIZE_NUMBER_INT));
$chamado_encerrado->set_motivo_encerramento(filter_input(INPUT_POST, 'merge', FILTER_SANITIZE_STRING));
$chamado_encerrado->set_obs(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));
$chamado_encerrado->set_anexo(filter_input(INPUT_POST, 'anexo', FILTER_SANITIZE_STRING));
$chamado_encerrado->set_status(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT));
$chamado_encerrado->set_usuario_encerramento($_SESSION['user_id']);
$chamado_encerrado->set_executante(filter_input(INPUT_POST, 'executante', FILTER_SANITIZE_NUMBER_INT));
$chamado_encerrado->set_emergencial(filter_input(INPUT_POST, 'emergencial', FILTER_SANITIZE_NUMBER_INT));

$confirm = $chamado_encerrado->save_Chamado_Encerrar($chamado_encerrado->get_id_chamado(), $chamado_encerrado->get_protocolo(), 
        $chamado_encerrado->get_usuario_encerramento(), $chamado_encerrado->get_obs(), $chamado_encerrado->get_motivo_encerramento(), 
        $chamado_encerrado->get_status(), $chamado_encerrado->get_executante(), $chamado_encerrado->get_emergencial());

if ($confirm === TRUE) {
    $mail = new Email();
    $chamado_aberto = new Chamados();
    $chamado_analise = new Chamados_Analise();
    $status_obj = new Status();
    $user = new Usuarios();

    $encerramento = $chamado_encerrado->get_motivo_encerramento();
    $obs = $chamado_encerrado->get_obs() === 'na' ? 'Não informado' : $chamado_encerrado->get_obs();
    $array_status = $status_obj->Dados_Status($chamado_encerrado->get_status());
    $desc_status = $array_status['desc_status'];
    $email_usuario = $chamado_aberto->Dados_Chamados($chamado_encerrado->get_id_chamado());
    $mail_usuario = $user->Dados_User($email_usuario['id_usuario']);
    $chamado_aberto->edit_status_Chamado($chamado_encerrado->get_id_chamado(), $chamado_encerrado->get_status(), $chamado_encerrado->get_executante());
    $chamado_analise->edit_status_Chamado_Analise($chamado_encerrado->get_id_chamado(), $chamado_encerrado->get_status(), $chamado_encerrado->get_executante());
    $protocolo = $chamado_encerrado->get_protocolo();    
    $email_user = $_SESSION['email'] . ";" . $mail_usuario['email'];

    $body2 = "<h1>Chamado Atendido com Sucesso</h1>
              <p>Olá Seu chamado foi Atendido em nosso sistema.</p>              
              <p>Protocolo número:<strong> $protocolo </strong></p>
              <p>Status:<strong> $desc_status </strong></p>    
              <p>Encerramento:<strong> $encerramento</strong></p>
              <p>Observação:<strong> $obs</strong></p>";
    $body = beginHTML() . $body2 . endHTML() . assinatura_HTML();
    $subject = "Chamado Finalizado com Sucesso - Protocolo: " . $protocolo;
    $file = $chamado_encerrado->get_anexo() == "na" ? FALSE : $chamado_encerrado->get_anexo();
    $mail->EnviarEmail($email_user, $subject, $body, $file);
    echo '<div class="alert alert-success" role="alert">Parabéns!! Chamado Finalizado com Sucesso!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! Contate a TI-AMA...</div>';
}