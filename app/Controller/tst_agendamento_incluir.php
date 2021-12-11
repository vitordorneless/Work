<?php

session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Agendamento.php';
require '../Model/TST_Log.php';
$log = new TST_Log();
$tst = new TST_Agendamento();
$tst->set_id_tipo_agendamento(filter_input(INPUT_POST, 'id_agendamento', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_unidade(filter_input(INPUT_POST, 'id_unidade', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_turnos(filter_input(INPUT_POST, 'id_turnos', FILTER_SANITIZE_NUMBER_INT));
$tst->set_id_situacao(filter_input(INPUT_POST, 'id_situacao', FILTER_SANITIZE_NUMBER_INT));
$tst->set_data_tarefa(filter_input(INPUT_POST, 'data_agendamento', FILTER_SANITIZE_STRING));
$tst->set_id_tecnicos(filter_input(INPUT_POST, 'id_tecnicos', FILTER_SANITIZE_STRING));
$tst->set_obs(filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING));
$confirm = $tst->save_TST_Agendamento($tst->get_id_tipo_agendamento(), $tst->get_id_unidade(), $tst->get_id_turnos(), $tst->get_id_situacao(), $tst->get_data_tarefa(), $tst->get_id_tecnicos(), $tst->get_obs());
$confirm == TRUE ? $log->save_TST_Log('Inclusão de Agendamento ' . $tst->get_id_unidade(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Inclusão de Agendamento ' . $tst->get_id_unidade(), date('Y-m-d H:i:s'), 0);
echo $confirm == TRUE ? '<div class="alert alert-success" role="alert">Agenda Criada!</div>' : '<div class="alert alert-danger" role="alert">Errou!</div>';