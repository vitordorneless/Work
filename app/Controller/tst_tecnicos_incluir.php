<?php
session_start();
require '../Model/Tecnicos_Seguranca_Trabalho.php';
require '../Model/TST_Tecnicos.php';
require '../Model/TST_Log.php';
$log = new TST_Log();
$tst = new TST_Tecnicos();
$tst->set_nome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
$tst->set_registro(filter_input(INPUT_POST, 'registro', FILTER_SANITIZE_STRING));
$tst->set_cpf(filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING));
$tst->set_id_cargo(filter_input(INPUT_POST, 'id_cargo', FILTER_SANITIZE_NUMBER_INT));
$confirm = $tst->save_TST_Tecnicos($tst->get_nome(), $tst->get_registro(), $tst->get_cpf(), $tst->get_id_cargo());
$confirm == TRUE ? $log->save_TST_Log('Inclusão do Técnico '.$tst->get_nome(), $_SESSION['user_id'], date('Y-m-d H:i:s'), 1) : $log->save_TST_Log('Inclusão do Técnico', $_SESSION['user_id'], date('Y-m-d H:i:s'), 0);
echo $confirm == TRUE ? '<div class="alert alert-success" role="alert">Técnico Inserido!</div>' : '<div class="alert alert-danger" role="alert">Errou!</div>';