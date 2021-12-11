<?php

session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Agendamento.php';
require '../Model/TST_Lojas.php';
require '../Model/TST_Log.php';
require '../Model/TST_Turnos.php';
require '../Model/Mail.php';
require '../Model/SuperEmail.php';
require '../Model/Cidades_e_Estados.php';
include '../../class/ayuadame.php';
include '../config/database_mysql.php';

$pdo = Database::connect();
$mail = new SuperEmail();
$convocacao = new TST_Agendamento();
$lojas = new TST_Lojas();
$log = new TST_Log();
$turnos = new TST_Turnos();
$citys_and_states = new Cidades_e_Estados();

$convocacao->set_id(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
$array_agendamento = $convocacao->Dados_TST_Agendamentos($convocacao->get_id());
$array_lojas = $lojas->Dados_TST_Lojass($array_agendamento['id_unidade']);
$array_cidade = $citys_and_states->Dados_Cidades($array_lojas['id_cidade']);
$array_estado = $citys_and_states->Dados_Estados($array_lojas['id_estado']);
$array_turnos = $turnos->Dados($array_agendamento['id_turnos']);
$mail->set_to2(filter_input(INPUT_POST, 'to2', FILTER_SANITIZE_STRING));
$mail->set_to3(filter_input(INPUT_POST, 'to3', FILTER_SANITIZE_STRING));
$mail->set_to4(filter_input(INPUT_POST, 'to4', FILTER_SANITIZE_STRING));
$mail->set_to5(filter_input(INPUT_POST, 'to5', FILTER_SANITIZE_STRING));
$mail->set_to6(filter_input(INPUT_POST, 'to6', FILTER_SANITIZE_STRING));
$mail->set_to7(filter_input(INPUT_POST, 'to7', FILTER_SANITIZE_STRING));
$mail->set_to8(filter_input(INPUT_POST, 'to8', FILTER_SANITIZE_STRING));
$mail->set_to9(filter_input(INPUT_POST, 'to9', FILTER_SANITIZE_STRING));
$hora = date('H');
if (($hora >= 6) and ( $hora <= 12))
    $saudacao = 'Bom dia';
elseif (($hora >= 13) and ( $hora <= 18))
    $saudacao = 'Boa Tarde';
else
    $saudacao = 'Boa Noite';


$sql1 = "select nome, registro from tst_tecnicos where id in (" . $array_agendamento['tecnicos_ids'] . ") and status in (1) order by nome asc";
$nomes = ' ';
foreach ($pdo->query($sql1) as $value) {
    $nomes = $nomes . $value['nome'] . ', Registro: ' . $value['registro'] . ', ';
}

$begin_html = beginHTML();
$end_html = assinatura_TST_HTML() . endHTML();
$subject = 'Comunicado de visita técnica: ' . utf8_encode($array_lojas['nome_unidade']);
$body = '<div class="containerr">';
$body = $body . '<h3>Prezados(as), ' . $saudacao . '</h3>';
$body = $body . '<p>Conforme combinado, comunicamos que estaremos realizando visita para vistoria técnica conforme cronograma abaixo:</p>';
$body = $body . '<p>Técnico(s):' . $nomes . '</p>';
$body = $body . '<p>Cidade:' . utf8_encode($array_cidade['nom_cidade']) . '/' . utf8_encode($array_estado['nom_estado']) . '</p>';
$body = $body . '<p>Data:' . transformaEmDataBrasileira($array_agendamento['data_agendamento']) . '</p>';
$body = $body . '<p>Turno(s):' . $array_turnos['turno'] . '</p>';
$body = $body . '</div>';
$contenido = $begin_html . $body . $end_html;
Database::disconnect();
$to11 = 'vivian.baroni@amars.com.br';
$to10 = 'segurancadotrabalho@amars.com.br';
$confirm = $convocacao->edit_TST_Agendamento_Status($array_agendamento['id']);

if ($confirm === TRUE) {
    $mail->EnviarSuperEmail('na', $mail->get_to2(), $mail->get_to3(), $mail->get_to4(), $mail->get_to5(), $mail->get_to6(), $mail->get_to7(), $mail->get_to8(), $mail->get_to9(), $to10, $to11, $subject, $contenido);
    $log->save_TST_Log('Envio de Convocação via Email da Loja ' . $array_lojas['nome_unidade'], $_SESSION['user_id'], date('Y-m-d H:i:s'), 1);
    echo '<div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<p>Convocação Enviada com Sucesso!!</p></div>';
} else {
    $log->save_TST_Log('Envio de Convocação via Email com erro da Loja  ' . $array_lojas['nome_unidade'], $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
    echo '<div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
Erro!! Contate a TI-AMA...</div>';
}